@extends('layouts.app')
@section('title','Planet #'.$item->id)

@section('content')
  <div class="card">
    <h1 style="margin:0 0 10px 0;">Planet #{{ $item->id }} — {{ $item->name }}</h1>
    <a class="btn" href="{{ route('admin.planets.edit', $item) }}">Edit</a>
    <a class="btn" href="{{ route('admin.planets.index') }}">← Back</a>
    <pre style="white-space:pre-wrap;background:rgba(0,0,0,.35);padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.12);margin-top:10px">{{ json_encode($item->toArray(), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
  </div>
@endsection
