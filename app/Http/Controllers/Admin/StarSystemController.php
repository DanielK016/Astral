<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StarSystem;
use App\Models\Galaxy;

class StarSystemController extends Controller
{
    public function index()
    {
        $items = StarSystem::query()->with('galaxy')->orderBy('id','desc')->paginate(20);
        return view('admin.starsystems.index', compact('items'));
    }

    public function create()
    {
        $galaxies = Galaxy::query()->orderBy('id','desc')->get();
        return view('admin.starsystems.create', compact('galaxies'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $item = StarSystem::query()->create($data);
        return redirect()->route('admin.star-systems.edit', $item)->with('ok', 'Создано');
    }

    public function show(StarSystem $starSystem)
    {
        return view('admin.starsystems.show', ['item' => $starSystem->load('galaxy')]);
    }

    public function edit(StarSystem $starSystem)
    {
        $galaxies = Galaxy::query()->orderBy('id','desc')->get();
        return view('admin.starsystems.edit', ['item' => $starSystem, 'galaxies' => $galaxies]);
    }

    public function update(Request $request, StarSystem $starSystem)
    {
        $data = $this->validateData($request);
        $starSystem->update($data);
        return redirect()->route('admin.star-systems.edit', $starSystem)->with('ok', 'Сохранено');
    }

    public function destroy(StarSystem $starSystem)
    {
        $starSystem->delete();
        return redirect()->route('admin.star-systems.index')->with('ok', 'Удалено');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'galaxy_id' => ['required','exists:galaxies,id'],
            'name' => ['required','string','max:255'],
            'x' => ['required','numeric'],
            'y' => ['required','numeric'],
            'z' => ['required','numeric'],
            'color_hex' => ['required','string','max:12'],
            'temperature' => ['required','integer','min:1000','max:50000'],
            'base_scale' => ['required','numeric','min:0.1','max:10'],
        ]);
    }
}
