@extends('layouts.app')
@section('title','CRUD: Star Systems')

@section('content')
  <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Star Systems</h1>
      <a class="btn" href="{{ route('admin.star-systems.create') }}">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Galaxy</th>
          <th>Name</th>
          <th>X</th><th>Y</th><th>Z</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>#{{ $item->galaxy_id }} {{ $item->galaxy?->name }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ number_format($item->x, 1) }}</td>
            <td>{{ number_format($item->y, 1) }}</td>
            <td>{{ number_format($item->z, 1) }}</td>
            <td style="white-space:nowrap">
              <a class="btn" href="{{ route('admin.star-systems.edit', $item) }}">Edit</a>
              <form method="post" action="{{ route('admin.star-systems.destroy', $item) }}" style="display:inline-block" onsubmit="return confirm('Delete this item?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
              <a class="btn" href="{{ route('admin.star-systems.show', $item) }}">Open System</a>
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
