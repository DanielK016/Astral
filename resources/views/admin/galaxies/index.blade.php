@extends('layouts.app')
@section('title','CRUD: Galaxies')

@section('content')
  <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Galaxies</h1>
      <a class="btn" href="{{ route('admin.galaxies.create') }}">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
      <th>Seed</th>
      <th>Size</th>
      <th>Arms</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
        <td>{{ $item->seed }}</td>
        <td>{{ $item->size }}</td>
        <td>{{ $item->arms }}</td>
            <td style="white-space:nowrap">
              <a class="btn" href="{{ route('admin.galaxies.edit', $item) }}">Edit</a>
              <form method="post" action="{{ route('admin.galaxies.destroy', $item) }}" style="display:inline-block" onsubmit="return confirm('Delete this item?')">
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
