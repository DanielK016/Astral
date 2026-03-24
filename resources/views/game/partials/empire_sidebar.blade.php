@php
    $unlocked = $unlocked ?? [];
    $researchTree = $researchTree ?? [];
    $others = $others ?? collect();
    $relMap = $relMap ?? [];
    $shipPreviewMap = [
        'humans' => 'assets/img_model_main/human/RASA/human_ship.png',
        'lorians' => 'assets/img_model_main/zab_human/RASA/zab_human_ship.png',
        'zeth' => 'assets/img_model_main/roi/RASA/roi_ship.png',
    ];
    $shipPreview = asset($shipPreviewMap[$player->race_key] ?? 'assets/img_model_main/human/RASA/human_ship.png');
@endphp

<div class="d-flex align-items-center justify-content-between mb-2">
    <div class="text-warning fw-bold">{{ __('ui.game.research') }}</div>
    <div class="text-secondary small">{{ $player->current_research_key ? ('In progress: '.$player->current_research_key) : 'None' }}</div>
</div>

<form method="POST" action="{{ route('game.research.select', ['session' => $session->id]) }}">
    @csrf
    <select name="tech_key" class="form-select form-select-sm bg-dark text-light border border-info border-opacity-25 mb-2">
        <option value="">Select technology...</option>
        @foreach($researchTree as $branch => $items)
            <optgroup label="{{ ucfirst($branch) }}">
                @foreach($items as $t)
                    @php $k = $t['key']; @endphp
                    @if(!in_array($k, $unlocked, true))
                        <option value="{{ $k }}">{{ $t['name'] }} ({{ $t['cost'] }})</option>
                    @endif
                @endforeach
            </optgroup>
        @endforeach
    </select>
    <button class="btn btn-sm btn-outline-info w-100">Start Research</button>
</form>

<hr class="border-info border-opacity-25">

<div class="text-warning fw-bold mb-2">{{ __('ui.game.fleets') }}</div>
<div class="text-secondary small mb-2">Tip: click a system on the map to enter it.</div>
<div class="ship-preview-card rounded-4 border border-info border-opacity-25 bg-black bg-opacity-50 p-2 mb-2 text-center">
    <img src="{{ $shipPreview }}" alt="Ship preview" class="img-fluid ship-preview-image">
</div>

<hr class="border-info border-opacity-25">

<div class="text-warning fw-bold mb-2">Diplomacy</div>
@foreach($others as $o)
    @php $st = $relMap[$o->id] ?? 'unknown'; @endphp
    <div class="d-flex align-items-center justify-content-between border-bottom border-info border-opacity-10 py-2">
        <div>
            <div class="text-light fw-bold">{{ $o->name }}</div>
            <div class="text-secondary small">Status: {{ $st }}</div>
        </div>
        <div class="d-flex gap-1 flex-wrap justify-content-end">
            @if($st === 'unknown')
                <form method="POST" action="{{ route('game.diplomacy.contact', ['session' => $session->id, 'other' => $o->id]) }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-info">Contact</button>
                </form>
            @endif

            @if($st !== 'war')
                <form method="POST" action="{{ route('game.diplomacy.war', ['session' => $session->id, 'other' => $o->id]) }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">War</button>
                </form>
            @else
                <form method="POST" action="{{ route('game.diplomacy.peace', ['session' => $session->id, 'other' => $o->id]) }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-success">Peace</button>
                </form>
            @endif
        </div>
    </div>
@endforeach
