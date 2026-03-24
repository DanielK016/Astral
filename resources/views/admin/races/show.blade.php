@extends('layouts.app')
@section('title','Race #'.$item->id)

@section('content')
  <div class="card">
    <h1 style="margin:0 0 10px 0;">Race #{{ $item->id }} — {{ $item->name }}</h1>
    <div class="muted">Color: <span style="color:{{ $item->color_hex }}">{{ $item->color_hex }}</span></div>
    <pre style="white-space:pre-wrap;background:rgba(0,0,0,.35);padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.12)">{{ json_encode($item->toArray(), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
    <a class="btn" href="{{ route('admin.races.edit',$item) }}">Edit</a>
    <a class="btn" href="{{ route('admin.races.index') }}">← Back</a>
  </div>
@endsection
