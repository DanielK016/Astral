@extends('layouts.app')
@section('title','CRUD: Planets')

@section('content')
  <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Planets</h1>
      <a class="btn" href="{{ route('admin.planets.create') }}">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>System</th>
          <th>Name</th>
          <th>Type</th>
          <th>Orbit</th>
          <th>Radius</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>#{{ $item->star_system_id }} {{ $item->starSystem?->name }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ number_format($item->orbit_radius, 1) }}</td>
            <td>{{ number_format($item->radius, 2) }}</td>
            <td style="white-space:nowrap">
              <a class="btn" href="{{ route('admin.planets.edit', $item) }}">Edit</a>
              <form method="post" action="{{ route('admin.planets.destroy', $item) }}" style="display:inline-block" onsubmit="return confirm('Delete this item?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div style="margin-top:12px">
      {{ $items->links() }}
    </div>
  </div>
@endsection
