@extends('layouts.game')

@section('content')
<div class="container py-5">
    <div class="glass rounded-4 p-4 p-md-5">
        <h2 class="text-info neon mb-4">{{ __('ui.menu.continue') }}</h2>

        @if($sessions->isEmpty())
            <div class="text-secondary">No saved games yet.</div>
        @else
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Turn</th>
                            <th>Difficulty</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sessions as $s)
                        <tr>
                            <td class="text-warning fw-bold">#{{ $s->id }}</td>
                            <td>{{ $s->turn }}</td>
                            <td>{{ ucfirst($s->difficulty) }}</td>
                            <td class="text-secondary">{{ $s->created_at }}</td>
                            <td class="text-end">
                                <form method="POST" action="{{ route('continue.load', ['session'=>$s->id]) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-info">Load</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a class="btn btn-outline-light mt-3" href="{{ route('menu') }}">← {{ __('ui.common.back') }}</a>
    </div>
</div>
@endsection
