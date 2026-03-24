<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Galaxy;
use App\Services\GalaxyGenerator;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function menu()
    {
        return view('menu.main');
    }

    public function difficulty()
    {
        return view('game.difficulty');
    }

    public function difficultySave(Request $request)
    {
        $data = $request->validate([
            'difficulty' => ['required', 'in:easy,normal,hard'],
        ]);

        session(['new_game.difficulty' => $data['difficulty']]);

        return redirect()->route('new-game.race');
    }

    public function race()
    {
        $races = Race::query()->orderBy('name')->get();
        return view('game.race', compact('races'));
    }

    public function raceSelect(Request $request)
    {
        $data = $request->validate([
            'race_id' => ['required', 'exists:races,id'],
        ]);

        session(['new_game.race_id' => (int)$data['race_id']]);

        return redirect()->route('new-game.race.configure', ['race' => $data['race_id']]);
    }

    public function raceConfigure(Race $race)
    {
        return view('game.race-config', compact('race'));
    }

    public function raceConfigureSave(Request $request, Race $race)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'color_hex' => ['required','string','max:12'],
            'traits_json' => ['nullable','string'], 
        ]);

        $traits = null;
        if (!empty($data['traits_json'])) {
            $decoded = json_decode($data['traits_json'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $traits = $decoded;
            }
        }

        $race->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'color_hex' => $data['color_hex'],
            'traits_json' => $traits,
        ]);

        session(['new_game.race_id' => $race->id]);

        return redirect()->route('new-game.galaxy');
    }

    public function galaxy()
    {
        $difficulty = session('new_game.difficulty', 'normal');
        $raceId = session('new_game.race_id');
        $race = $raceId ? Race::find($raceId) : null;

        return view('game.galaxy', compact('difficulty','race'));
    }

    public function generate(Request $request, GalaxyGenerator $generator)
    {
        $raceId = session('new_game.race_id');
        abort_if(!$raceId, 400, 'Race not selected');

        $race = Race::findOrFail($raceId);

        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'size' => ['required','integer','min:80','max:1200'],
            'arms' => ['required','integer','min:2','max:8'],
            'seed' => ['nullable','integer','min:1','max:4294967295'],
        ]);

        $seed = $data['seed'] ?: random_int(1, 4294967295);

        $galaxy = Galaxy::query()->create([
            'name' => $data['name'],
            'seed' => $seed,
            'size' => $data['size'],
            'arms' => $data['arms'],
            'notes' => 'Generated via New Game wizard',
        ]);

        $result = $generator->generate($galaxy, $seed, $data['size'], $data['arms']);
        $home = $result['homeSystem'];

      
        $race->home_star_system_id = $home->id;
        $race->save();

        session([
            'game.galaxy_id' => $galaxy->id,
            'game.race_id' => $race->id,
        ]);

        return redirect()->route('system.show', ['starSystem' => $home->id]);
    }
}
