<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Race;

class RaceController extends Controller
{
    public function index()
    {
        $items = Race::query()->orderBy('id','desc')->paginate(20);
        return view('admin.races.index', compact('items'));
    }

    public function create()
    {
        return view('admin.races.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $item = Race::query()->create($data);
        return redirect()->route('admin.races.edit', $item)->with('ok', 'Создано');
    }

    public function show(Race $race)
    {
        return view('admin.races.show', ['item' => $race]);
    }

    public function edit(Race $race)
    {
        return view('admin.races.edit', ['item' => $race]);
    }

    public function update(Request $request, Race $race)
    {
        $data = $this->validateData($request);
        $race->update($data);
        return redirect()->route('admin.races.edit', $race)->with('ok', 'Сохранено');
    }

    public function destroy(Race $race)
    {
        $race->delete();
        return redirect()->route('admin.races.index')->with('ok', 'Удалено');
    }

    private function validateData(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'color_hex' => ['required','string','max:12'],
            'traits_json' => ['nullable','string'],
            'home_star_system_id' => ['nullable','integer'],
        ]);

        $traits = null;
        if (!empty($data['traits_json'])) {
            $decoded = json_decode($data['traits_json'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $traits = $decoded;
            }
        }

        $data['traits_json'] = $traits;

        return $data;
    }
}
