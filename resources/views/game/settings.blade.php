@extends('layouts.game')

@section('content')
<div class="container py-5">
    <div class="glass rounded-4 p-4 p-md-5">
        <h2 class="text-info neon mb-3">{{ __('ui.menu.settings') }}</h2>
        <p class="text-secondary">Graphics, audio, and control settings will be added later.</p>
        <a class="btn btn-outline-light" href="{{ route('menu') }}">← {{ __('ui.common.back') }}</a>
    </div>
</div>
@endsection
