<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galaxy;

class GalaxyController extends Controller
{
    public function index()
    {
        $items = Galaxy::query()->orderBy('id','desc')->paginate(20);
        return view('admin.galaxies.index', compact('items'));
    }

    public function create()
    {
        return view('admin.galaxies.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $item = Galaxy::query()->create($data);
        return redirect()->route('admin.galaxies.edit', $item)->with('ok', 'Создано');
    }

    public function show(Galaxy $galaxy)
    {
        return view('admin.galaxies.show', ['item' => $galaxy]);
    }

    public function edit(Galaxy $galaxy)
    {
        return view('admin.galaxies.edit', ['item' => $galaxy]);
    }

    public function update(Request $request, Galaxy $galaxy)
    {
        $data = $this->validateData($request);
        $galaxy->update($data);
        return redirect()->route('admin.galaxies.edit', $galaxy)->with('ok', 'Сохранено');
    }

    public function destroy(Galaxy $galaxy)
    {
        $galaxy->delete();
        return redirect()->route('admin.galaxies.index')->with('ok', 'Удалено');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required','string','max:255'],
            'seed' => ['nullable','integer','min:1'],
            'size' => ['required','integer','min:50','max:1200'],
            'arms' => ['required','integer','min:2','max:8'],
            'notes' => ['nullable','string'],
        ]);
    }
}
