@extends('layouts.app')
@section('title','CRUD: Hyperlanes')

@section('content')
  <div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <h1 style="margin:0">CRUD: Hyperlanes</h1>
      <a class="btn" href="{{ route('admin.hyperlanes.create') }}">+ Create</a>
    </div>

    <div style="height:12px"></div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Galaxy</th>
          <th>From</th>
          <th>To</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>#{{ $item->galaxy_id }} {{ $item->galaxy?->name }}</td>
            <td>#{{ $item->from_star_system_id }} {{ $item->fromStarSystem?->name }}</td>
            <td>#{{ $item->to_star_system_id }} {{ $item->toStarSystem?->name }}</td>
            <td style="white-space:nowrap">
              <a class="btn" href="{{ route('admin.hyperlanes.edit', $item) }}">Edit</a>
              <form method="post" action="{{ route('admin.hyperlanes.destroy', $item) }}" style="display:inline-block" onsubmit="return confirm('Delete this item?')">
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
