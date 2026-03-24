<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hyperlane;
use App\Models\Galaxy;
use App\Models\StarSystem;

class HyperlaneController extends Controller
{
    public function index()
    {
        $items = Hyperlane::query()->with(['galaxy','fromStarSystem','toStarSystem'])->orderBy('id','desc')->paginate(20);
        return view('admin.hyperlanes.index', compact('items'));
    }

    public function create()
    {
        $galaxies = Galaxy::query()->orderBy('id','desc')->get();
        $systems = StarSystem::query()->orderBy('id','desc')->limit(400)->get();
        return view('admin.hyperlanes.create', compact('galaxies','systems'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $item = Hyperlane::query()->create($data);
        return redirect()->route('admin.hyperlanes.edit', $item)->with('ok', 'Создано');
    }

    public function show(Hyperlane $hyperlane)
    {
        return view('admin.hyperlanes.show', ['item' => $hyperlane->load(['galaxy','fromStarSystem','toStarSystem'])]);
    }

    public function edit(Hyperlane $hyperlane)
    {
        $galaxies = Galaxy::query()->orderBy('id','desc')->get();
        $systems = StarSystem::query()->orderBy('id','desc')->limit(400)->get();
        return view('admin.hyperlanes.edit', ['item' => $hyperlane, 'galaxies' => $galaxies, 'systems' => $systems]);
    }

    public function update(Request $request, Hyperlane $hyperlane)
    {
        $data = $this->validateData($request);
        $hyperlane->update($data);
        return redirect()->route('admin.hyperlanes.edit', $hyperlane)->with('ok', 'Сохранено');
    }

    public function destroy(Hyperlane $hyperlane)
    {
        $hyperlane->delete();
        return redirect()->route('admin.hyperlanes.index')->with('ok', 'Удалено');
    }

    private function validateData(Request $request): array
    {
        $data = $request->validate([
            'galaxy_id' => ['required','exists:galaxies,id'],
            'from_star_system_id' => ['required','exists:star_systems,id','different:to_star_system_id'],
            'to_star_system_id' => ['required','exists:star_systems,id'],
        ]);

        return $data;
    }
}
