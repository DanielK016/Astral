<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planet;
use App\Models\StarSystem;

class PlanetController extends Controller
{
    public function index()
    {
        $items = Planet::query()->with('starSystem')->orderBy('id','desc')->paginate(20);
        return view('admin.planets.index', compact('items'));
    }

    public function create()
    {
        $systems = StarSystem::query()->orderBy('id','desc')->limit(200)->get();
        return view('admin.planets.create', compact('systems'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $item = Planet::query()->create($data);
        return redirect()->route('admin.planets.edit', $item)->with('ok', 'Создано');
    }

    public function show(Planet $planet)
    {
        return view('admin.planets.show', ['item' => $planet->load('starSystem')]);
    }

    public function edit(Planet $planet)
    {
        $systems = StarSystem::query()->orderBy('id','desc')->limit(200)->get();
        return view('admin.planets.edit', ['item' => $planet, 'systems' => $systems]);
    }

    public function update(Request $request, Planet $planet)
    {
        $data = $this->validateData($request);
        $planet->update($data);
        return redirect()->route('admin.planets.edit', $planet)->with('ok', 'Сохранено');
    }

    public function destroy(Planet $planet)
    {
        $planet->delete();
        return redirect()->route('admin.planets.index')->with('ok', 'Удалено');
    }

    private function validateData(Request $request): array
    {
        $data = $request->validate([
            'star_system_id' => ['required','exists:star_systems,id'],
            'name' => ['required','string','max:255'],
            'type' => ['required','in:rock,desert,ocean,ice,gas'],
            'orbit_radius' => ['required','numeric','min:1','max:200'],
            'radius' => ['required','numeric','min:0.1','max:20'],
            'axial_tilt' => ['nullable','numeric','min:-3.14','max:3.14'],
            'rotation_speed' => ['required','numeric','min:0','max:1'],
            'has_rings' => ['nullable','boolean'],
            'meta_json' => ['nullable','string'],
        ]);

        $meta = null;
        if (!empty($data['meta_json'])) {
            $decoded = json_decode($data['meta_json'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $meta = $decoded;
            }
        }
        $data['meta_json'] = $meta;

        return $data;
    }
}
