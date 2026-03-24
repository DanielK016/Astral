@extends('layouts.app')
@section('title','CRUD: Races')

@section('content')
  <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Races</h1>
      <a class="btn" href="{{ route('admin.races.create') }}">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Color</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->color_hex }}</td>
            <td style="white-space:nowrap">
              <a class="btn" href="{{ route('admin.races.edit', $item) }}">Edit</a>
              <form method="post" action="{{ route('admin.races.destroy', $item) }}" style="display:inline-block" onsubmit="return confirm('Delete this item?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" style="text-align:center">No races yet</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection