@php
$hideGameNav = true;

$racePlanetIconMap = [
'humans' => asset('assets/img_model_main/human/RASA/human_planet.png'),
'lorians' => asset('assets/img_model_main/zab_human/RASA/zab_human_planet.png'),
'zeth' => asset('assets/img_model_main/roi/RASA/roi_planet.png'),
];

$planetTypeIconMap = [
'terran' => asset('assets/img_model_main/icon_planet/terrna.png'),
'desert' => asset('assets/img_model_main/icon_planet/desert.png'),
'ice' => asset('assets/img_model_main/icon_planet/ice.png'),
'ocean' => asset('assets/img_model_main/icon_planet/ocean.png'),
'gas' => asset('assets/img_model_main/icon_planet/gas.png'),
'volcanic' => asset('assets/img_model_main/icon_planet/vulcanic.png'),
'vulcanic' => asset('assets/img_model_main/icon_planet/vulcanic.png'),
'biolum' => asset('assets/img_model_main/icon_planet/biolum.png'),
'unknown' => asset('assets/img_model_main/icon_planet/terrna.png'),
];

$resourceBoxIcon = asset('assets/img_model_main/resurse_icon/resurse_box.png');

$resourceTopbarMap = [
['field' => 'science', 'income' => 'science_income', 'label' => 'Energy Credits', 'icon' => asset('assets/resources64x64/Energy_Credits.png')],
['field' => 'energy', 'income' => 'energy_income', 'label' => 'Biomass', 'icon' => asset('assets/resources64x64/Biomass.png')],
['field' => 'unity', 'income' => 'unity_income', 'label' => 'Raw Minerals', 'icon' => asset('assets/resources64x64/Raw_Minerals.png')],
['field' => 'minerals', 'income' => 'minerals_income', 'label' => 'Dark Matter', 'icon' => asset('assets/resources64x64/Dark_Matter.png')],
['field' => 'rare_metals', 'income' => 'rare_metals_income', 'label' => 'Ethereal Dust', 'icon' => asset('assets/resources64x64/Ethereal_Dust.png')],
['field' => 'exotic_gases', 'income' => 'exotic_gases_income', 'label' => 'Living Crystal', 'icon' => asset('assets/resources64x64/Living_Crystal.png')],
['field' => 'xenocultures', 'income' => 'xenocultures_income', 'label' => 'Nano Alloys', 'icon' => asset('assets/resources64x64/Nano-Alloys.png')],
['field' => 'influence', 'income' => 'influence_income', 'label' => 'Neural Chips', 'icon' => asset('assets/resources64x64/Neural_Chips.png')],
];

$planetResourceMeta = [
['key' => 'science', 'label' => 'Energy Credits', 'icon' => asset('assets/resources128x128/Energy_Credits.png')],
['key' => 'energy', 'label' => 'Biomass', 'icon' => asset('assets/resources128x128/Biomass.png')],
['key' => 'unity', 'label' => 'Raw Minerals', 'icon' => asset('assets/resources128x128/Raw_Minerals.png')],
['key' => 'minerals', 'label' => 'Dark Matter', 'icon' => asset('assets/resources128x128/Dark_Matter.png')],
['key' => 'rare_metals', 'label' => 'Ethereal Dust', 'icon' => asset('assets/resources128x128/Ethereal_Dust.png')],
['key' => 'exotic_gases', 'label' => 'Living Crystal', 'icon' => asset('assets/resources128x128/Living_Crystal.png')],
['key' => 'xenocultures', 'label' => 'Nano Alloys', 'icon' => asset('assets/resources128x128/Nano-Alloys.png')],
['key' => 'influence', 'label' => 'Neural Chips', 'icon' => asset('assets/resources128x128/Neural_Chips.png')],
];

$shipClassIconMap = [
'heavy' => asset('assets/img_model_main/icon_ship_fleets/heavy.png'),
'medium' => asset('assets/img_model_main/icon_ship_fleets/medium.png'),
'litle' => asset('assets/img_model_main/icon_ship_fleets/litel.png'),
];

$shipPreviewImagesByRace = [
'humans' => [
'heavy' => asset('assets/img_model_main/ship_rasa/human/ship_heavy.png'),
'medium' => asset('assets/img_model_main/ship_rasa/human/ship_medium.png'),
'litle' => asset('assets/img_model_main/ship_rasa/human/ship_lite.png'),
],
'lorians' => [
'heavy' => asset('assets/img_model_main/ship_rasa/zab_human/ship_heavy.png'),
'medium' => asset('assets/img_model_main/ship_rasa/zab_human/ship_medium.png'),
'litle' => asset('assets/img_model_main/ship_rasa/zab_human/ship_litel.png'),
],
'zeth' => [
'heavy' => asset('assets/img_model_main/ship_rasa/ROI/ship_heavy.png'),
'medium' => asset('assets/img_model_main/ship_rasa/ROI/ship_medium.png'),
'litle' => asset('assets/img_model_main/ship_rasa/ROI/ship_litle.png'),
],
];
$shipPreviewModelsByRace = [
    'humans' => [
        'heavy' => asset('models/DOX_SHIP_SPACE_3D/Human/human_heavy/heavy.glb'),
        'medium' => asset('models/DOX_SHIP_SPACE_3D/Human/human_medium/medium.glb'),
        'litle' => asset('models/DOX_SHIP_SPACE_3D/Human/human_lite/lite.glb'),
    ],
    'lorians' => [
        'heavy' => asset('models/DOX_SHIP_SPACE_3D/Lorians/lorians_heavy/heavy.glb'),
        'medium' => asset('models/DOX_SHIP_SPACE_3D/Lorians/lorians_medium/medium.glb'),
        'litle' => asset('models/DOX_SHIP_SPACE_3D/Lorians/lorians_lite/lite.glb'),
    ],
    'zeth' => [
        'heavy' => asset('models/DOX_SHIP_SPACE_3D/ROI/Roi_heavy/heavy.glb'),
        'medium' => asset('models/DOX_SHIP_SPACE_3D/ROI/Roi_medium/medium.glb'),
        'litle' => asset('models/DOX_SHIP_SPACE_3D/ROI/Roi_lite/lite.glb'),
    ],
];

$fleetVariantLabelMap = [
'heavy' => 'Heavy Ship',
'medium' => 'Medium Ship',
'litle' => 'Light Ship',
];
$planetBannerMap = [
    'terran'   => asset('assets/planetBanners/terra_banner.png'),
    'desert'   => asset('assets/planetBanners/desert_banner.png'),
    'gas'      => asset('assets/planetBanners/gas_banner.png'),
    'ice'      => asset('assets/planetBanners/ice_banner.png'),
    'ocean'    => asset('assets/planetBanners/ocean_banner.png'),
    'volcanic' => asset('assets/planetBanners/vulcanic_banner.png'),
    'vulcanic' => asset('assets/planetBanners/vulcanic_banner.png'),
    'biolum'   => asset('assets/planetBanners/biolum_banner.png'),

    
    'unknown'  => asset('assets/planetBanners/terra_banner.png'),

    
    'humans'   => asset('assets/planetBanners/human_banner.png'),
    'lorians'  => asset('assets/planetBanners/forgotten_banner.png'),
    'zeth'     => asset('assets/planetBanners/zethRoi_banner.png'),
];
@endphp

@extends('layouts.game')

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<style>
    @property --fill {
        syntax: '<angle>';
        inherits: false;
        initial-value: 0turn;
    }

    :root {
        --game-topbar-height: 92px;
        --hud-border: rgba(143, 215, 255, .16);
        --hud-border-strong: rgba(143, 215, 255, .28);
        --hud-bg: rgba(5, 11, 22, .72);
        --hud-soft: rgba(255, 255, 255, .03);
        --hud-text: #eef7ff;
        --hud-muted: rgba(220, 235, 255, .62);
        --hud-accent: #8fd7ff;
        --hud-gold: #ffd38a;
        --hud-danger: #ff9f9f;
        --hold-duration: 1800ms;
    }

    .system-view {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background: #030711;
    }

    .system-view::before {
        content: '';
        position: fixed;
        inset: 0;
        pointer-events: none;
        background:
            radial-gradient(circle at 18% 20%, rgba(90, 176, 255, .12), transparent 24%),
            radial-gradient(circle at 84% 18%, rgba(255, 193, 119, .08), transparent 20%),
            linear-gradient(180deg, rgba(4, 9, 18, .12), rgba(3, 5, 11, .64));
        z-index: 0;
    }

    .sys-frame {
        position: fixed;
        inset: 0;
        border: 0;
        width: 100vw;
        height: 100vh;
        z-index: 1;
        opacity: 0;
        transition: opacity .55s ease;
    }

    .sys-frame.is-ready {
        opacity: 1;
    }

    .hud-panel {
        background: linear-gradient(180deg, rgba(255, 255, 255, .046), rgba(255, 255, 255, .02)), var(--hud-bg);
        border: 1px solid var(--hud-border);
        border-radius: 24px;
        box-shadow: 0 18px 42px rgba(0, 0, 0, .26);
        backdrop-filter: blur(16px);
    }

    .system-topbar {
        position: fixed;
        top: 12px;
        left: 12px;
        right: 12px;
        z-index: 120;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 12px 14px;
        pointer-events: auto;
    }

    .system-brand {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .system-brand__eyebrow {
        color: var(--hud-accent);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .system-brand__title {
        color: var(--hud-text);
        font-weight: 800;
        letter-spacing: .14em;
        text-transform: uppercase;
        font-size: clamp(1rem, 1.5vw, 1.18rem);
    }

    .system-brand__copy {
        color: var(--hud-muted);
        font-size: .72rem;
        margin-top: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .system-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: nowrap;
        justify-content: flex-end;
        overflow-x: auto;
    }

    .system-action--gold {
        flex-shrink: 0;
        white-space: nowrap;
    }

    .system-pill,
    .system-action {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-height: 36px;
        padding: 0 10px;
        border-radius: 10px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: var(--hud-text);
        font-weight: 700;
        text-decoration: none;
    }

    .system-pill img {
        width: 18px;
        height: 18px;
        object-fit: contain;
        filter: drop-shadow(0 0 6px rgba(85, 210, 255, .35));
    }

    .system-pill__income {
        color: var(--hud-muted);
        font-size: .84rem;
    }

    .system-action {
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .system-action:hover {
        transform: translateY(-1px);
        border-color: var(--hud-border-strong);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .system-action--gold {
        border-color: rgba(255, 211, 138, .26);
        background: rgba(255, 211, 138, .06);
        color: #fff3d8;
    }

    .system-action--gold:hover {
        border-color: rgba(255, 211, 138, .46);
        background: rgba(255, 211, 138, .12);
        box-shadow: 0 0 20px rgba(255, 211, 138, .10);
    }



    .left-panel,
    .right-panel {
        position: fixed;
        top: 112px;
        z-index: 90;
        max-height: calc(100vh - 128px);
        overflow: auto;
        pointer-events: auto;
        padding: 18px;
    }

    .left-panel {
        left: 104px;
        width: min(390px, calc(100vw - 140px));
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: translateX(-18px);
        transition: opacity .22s ease, visibility .22s ease, transform .22s ease;
    }

    .left-panel.is-open {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateX(0);
    }

    .right-panel {
        right: 12px;
        width: min(420px, calc(100vw - 140px));
    }
    .right-panel.is-fleet-collapsed {
    padding-bottom: 8px !important;
}

    .panel-title {
        color: var(--hud-gold);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .panel-subtitle {
        color: var(--hud-muted);
        font-size: .88rem;
        line-height: 1.64;
        margin-bottom: 12px;
    }

    .planet-row,
    .fleet-row {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px;
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, .07);
        background: rgba(255, 255, 255, .03);
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .planet-row+.planet-row,
    .fleet-row+.fleet-row {
        margin-top: 10px;
    }

    .planet-row:hover,
    .fleet-row:hover {
        transform: translateY(-1px);
        border-color: var(--hud-border-strong);
        background: rgba(96, 187, 255, .08);
        box-shadow: 0 0 18px rgba(97, 188, 255, .12);
    }

    .planet-visual {
        width: 58px;
        height: 58px;
        flex: 0 0 58px;
        display: grid;
        place-items: center;
        border-radius: 16px;
        background: rgba(255, 255, 255, .03);
        border: 1px solid rgba(143, 215, 255, .14);
        overflow: hidden;
    }

    .planet-visual img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 0 12px rgba(88, 208, 255, 0.20));
    }

    .planet-meta,
    .fleet-summary {
        min-width: 0;
        flex: 1;
    }

    .planet-name,
    .fleet-name {
        color: var(--hud-text);
        font-weight: 800;
        line-height: 1.14;
    }

    .planet-type,
    .fleet-mission,
    .fleet-class {
        color: var(--hud-muted);
        font-size: .84rem;
        margin-top: 6px;
        line-height: 1.54;
    }

    .planet-capital-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-top: 8px;
        padding: 4px 9px;
        border-radius: 999px;
        border: 1px solid rgba(255, 211, 138, .20);
        background: rgba(255, 211, 138, .08);
        color: #ffe0a6;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .resource-trigger {
        position: relative;
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        border-radius: 14px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        display: grid;
        place-items: center;
        cursor: pointer;
        transition: transform .16s ease, border-color .16s ease, background .16s ease;
        overflow: hidden;
    }

    .resource-trigger:hover {
        transform: translateY(-1px);
        border-color: var(--hud-border-strong);
        background: rgba(96, 187, 255, .10);
    }

    .resource-trigger::before {
        content: '';
        position: absolute;
        inset: -1px;
        border-radius: inherit;
        background: conic-gradient(rgba(143, 215, 255, .68) var(--fill, 0turn), transparent 0turn);
        mask: radial-gradient(farthest-side, transparent calc(100% - 4px), #000 calc(100% - 3px));
        opacity: 0;
    }

    .resource-trigger.is-arming::before {
        opacity: 1;
        animation: resourceHoldFill var(--hold-duration) linear forwards;
    }

    .resource-trigger img {
        width: 28px;
        height: 28px;
        object-fit: contain;
        position: relative;
        z-index: 1;
    }

    @keyframes resourceHoldFill {
        from {
            --fill: 0turn;
        }

        to {
            --fill: 1turn;
        }
    }

    .fleet-select-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-height: 52px;
        padding: 0 12px;
        border-radius: 16px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: var(--hud-text);
        transition: transform .16s ease, border-color .16s ease, background .16s ease, box-shadow .16s ease;
    }

    .fleet-select-btn:hover,
    .fleet-select-btn.is-active {
        transform: translateY(-1px);
        border-color: var(--hud-border-strong);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .12);
    }

    .fleet-select-btn img {
        width: 34px;
        height: 34px;
        object-fit: contain;
    }

    .fleet-preview-card,
    .claim-progress-card,
    .inspector-card {
        padding: 16px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, .07);
        background: rgba(255, 255, 255, .03);
    }

    .fleet-preview-card {
        margin-top: 14px;
    }

    .fleet-preview-frame {
        min-height: 180px;
        border-radius: 16px;
        border: 1px solid rgba(143, 215, 255, .12);
        background: radial-gradient(circle at center, rgba(27, 52, 73, 0.42), rgba(0, 0, 0, 0.34));
        display: grid;
        place-items: center;
        padding: 10px;
        margin-bottom: 12px;
    }
    .fleet-preview-frame model-viewer {
    width: 100%;
    height: 160px;
    --poster-color: transparent;
}

    .fleet-preview-image {
        max-width: 100%;
        max-height: 160px;
        object-fit: contain;
        filter: drop-shadow(0 0 18px rgba(72, 203, 255, 0.20));
    }

    .fleet-preview-title {
        color: var(--hud-text);
        font-weight: 800;
        text-align: center;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .fleet-preview-subtitle,
    .empty-state-note,
    .claim-progress-subtext {
        color: var(--hud-muted);
        font-size: .88rem;
        text-align: center;
        line-height: 1.62;
    }

    .fleet-move-row {
        display: flex;
        gap: 10px;
        margin-top: 12px;
    }

    .fleet-move-row .form-select,
    .planet-build-form .form-select {
        flex: 1;
        border-radius: 14px;
        border-color: rgba(143, 215, 255, .16);
        background: rgba(8, 14, 26, .92);
        color: #eef7ff;
    }

    .system-feedback-stack {
        position: fixed;
        top: 112px;
        right: 12px;
        z-index: 145;
        width: min(440px, calc(100vw - 24px));
        display: grid;
        gap: 10px;
        pointer-events: none;
    }

    .system-feedback {
        border-radius: 18px;
        border: 1px solid var(--hud-border);
        background: rgba(4, 10, 18, 0.90);
        color: var(--hud-text);
        padding: 12px 14px;
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.30);
        pointer-events: auto;
    }

    .system-feedback.is-error {
        border-color: rgba(255, 116, 116, 0.28);
        background: rgba(24, 7, 10, 0.92);
    }

    .system-feedback-title,
    .claim-progress-title,
    .floating-context-title,
    .inspector-eyebrow {
        color: var(--hud-gold);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .claim-progress-text {
        color: var(--hud-text);
        font-weight: 700;
        line-height: 1.58;
    }

    .claim-progress-meter {
        height: 9px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        overflow: hidden;
        margin-top: 10px;
    }

    .claim-progress-fill {
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, rgba(255, 196, 77, 0.62), rgba(255, 230, 120, 0.96));
        box-shadow: 0 0 18px rgba(255, 214, 107, 0.28);
    }

    .floating-context-panel,
    .planet-inspector {
        position: fixed;
        z-index: 150;
        border-radius: 22px;
        border: 1px solid var(--hud-border);
        background: rgba(6, 12, 24, 0.94);
        box-shadow: 0 18px 48px rgba(0, 0, 0, 0.44), 0 0 28px rgba(40, 160, 255, 0.12);
        backdrop-filter: blur(14px);
    }

    .floating-context-panel {
        min-width: 280px;
        max-width: 360px;
        display: none;
        padding: 14px;
    }

    .floating-context-panel.visible {
        display: block;
    }

   .planet-inspector {
         right: 12px;
        bottom: 12px;
        right: auto;
        top: auto;
        width: 760px;
        max-height: 560px;
        display: flex;
        flex-direction: column;
        opacity: 0;
        visibility: hidden;
        transform: translateY(18px);
        transition: opacity .24s ease, visibility .24s ease, transform .24s ease;
    }

    .planet-inspector.is-open {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .planet-inspector__head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    padding: 12px 14px 10px;
        border-bottom: 1px solid rgba(255, 255, 255, .07);
    }

    .planet-inspector__title {
        color: var(--hud-text);
    font-size: 0.9rem;
        font-weight: 800;
        letter-spacing: .10em;
        text-transform: uppercase;
    }

    .planet-inspector__sub {
        color: var(--hud-muted);
    font-size: 0.9rem;
        margin-top: 6px;
        line-height: 1.58;
    }

    .planet-inspector__close {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #eef7ff;
    }

.planet-inspector-shell {
    display: grid;
    gap: 12px;
}

.planet-inspector-main-shell {
    display: grid;
    gap: 12px;
}

.planet-inspector-layout {
    display: grid;
    gap: 12px;
}

.planet-inspector-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 16px;
    border: 1px solid rgba(143, 215, 255, .14);
    background: rgba(255, 255, 255, .03);
}

.planet-inspector-bar__title {
    color: var(--hud-gold);
    font-size: .72rem;
    font-weight: 800;
    letter-spacing: .18em;
    text-transform: uppercase;
}

.planet-inspector-layout {
    display: grid;
    gap: 12px;
}

.planet-inspector-hero {
    display: block;
}

.planet-inspector-hero__banner,
.planet-inspector-fleet,
.planet-inspector-panel,
.planet-inspector-main-shell {
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, .07);
    background: rgba(255, 255, 255, .03);
}
.planet-inspector-hero__banner {
    position: relative;
    width: 100%;
    height: 88px;
    border-radius: 14px;
    overflow: hidden;
}

.planet-inspector-hero__banner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}


.planet-inspector-banner-content {
      position: absolute;
    inset: 0;
    display: flex;
    align-items: flex-end;
    gap: 14px;
    padding: 10px 14px;
}

.planet-inspector-hero__planet {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    align-self: center;
}
.planet-inspector-hero__planet img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 0 16px rgba(72, 203, 255, 0.22));
}
.planet-inspector-resource-inline {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    align-self: flex-end;
    margin-bottom: 2px;
}
.planet-inspector-resource-inline .inspector-yields {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 0;
}

.planet-inspector-resource-inline .inspector-yield {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 0;
    border: 0;
    background: transparent;
    border-radius: 0;
    min-width: 0;
    height: auto;
}

.planet-inspector-resource-inline .inspector-yield img {
    width: 20px;
    height: 20px;
}
.planet-inspector-banner-placeholder {
    width: 100%;
    height: 94px;
    border-radius: 12px;
    border: 1px solid rgba(67, 191, 255, .28);
    background: linear-gradient(90deg, rgba(35, 167, 240, .82), rgba(35, 167, 240, .28));
}



.planet-inspector-main {
    display: grid;
    grid-template-columns: 64px minmax(0, 1fr);
    gap: 12px;
    align-items: stretch;
}

.planet-inspector-tabs {
    display: grid;
    gap: 8px;
}

.planet-inspector-tab {
     min-height: 42px;
    border-radius: 12px;
    font-size: 0.8rem;
    padding: 6px 8px;
    border: 1px solid rgba(143, 215, 255, .14);
    background: rgba(255, 255, 255, .03);
    color: var(--hud-text);
    font-weight: 800;
    letter-spacing: .04em;
    transition: transform .16s ease, border-color .16s ease, background .16s ease, box-shadow .16s ease;
}

.planet-inspector-tab:hover,
.planet-inspector-tab.is-active {
    transform: translateY(-1px);
    border-color: var(--hud-border-strong);
    background: rgba(96, 187, 255, .10);
    box-shadow: 0 0 18px rgba(97, 188, 255, .12);
}

.planet-inspector-panel {
    padding: 10px;
    min-height: 140px;
}

.planet-tab-content {
    display: none;
}

.planet-tab-content.is-active {
    display: block;
}

.planet-inspector-mini-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.planet-inspector-mini-stat {
    padding: 8px 10px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, .06);
    background: rgba(255, 255, 255, .03);
}

.planet-inspector-mini-stat__label {
    color: var(--hud-muted);
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
}

.planet-inspector-mini-stat__value {
    color: var(--hud-text);
    font-size: .85rem;
    font-weight: 800;
    margin-top: 6px;
}

.planet-inspector-fleet {
    padding: 10px;
    display: grid;
    gap: 10px;
}

.planet-inspector-fleet__ship {
    min-height: 110px;
    display: grid;
    place-items: center;
    border-radius: 14px;
    border: 1px solid rgba(143, 215, 255, .12);
    background: radial-gradient(circle at center, rgba(27, 52, 73, 0.42), rgba(0, 0, 0, 0.34));
    padding: 8px;
}

.planet-inspector-fleet__ship img {
    max-width: 100%;
    max-height: 92px;
    object-fit: contain;
    filter: drop-shadow(0 0 16px rgba(72, 203, 255, 0.20));
}

.planet-inspector-fleet__name {
    color: var(--hud-text);
    font-weight: 800;
    line-height: 1.3;
}

.planet-inspector-fleet__meta {
    color: var(--hud-muted);
    font-size: .82rem;
    line-height: 1.55;
}

@media (max-width: 820px) {
    .planet-inspector-layout {
        grid-template-columns: 1fr;
    }

    .planet-inspector {
        width: calc(100vw - 24px);
        max-height: 60vh;
    }
}

    .inspector-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 14px;
    }

    .inspector-stat {
        padding: 12px 14px;
        border-radius: 18px;
        background: rgba(255, 255, 255, .03);
        border: 1px solid rgba(255, 255, 255, .06);
    }

    .inspector-stat__label {
        color: var(--hud-muted);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .inspector-stat__value {
        color: var(--hud-text);
        font-size: 1rem;
        font-weight: 800;
        margin-top: 6px;
    }

    .inspector-slots,
    .inspector-yields {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 12px;
    }

   .inspector-slot,
.inspector-yield {
    display: inline-flex;
    align-items: center;
    gap: 5px;              
    padding: 5px 7px;     
    border-radius: 999px;
    border: 1px solid rgba(143, 215, 255, .14);
    background: rgba(255, 255, 255, .03);
    color: var(--hud-text);
    font-size: .72rem;    
}

    .inspector-yield img {
        width: 20px;
        height: 20px;
        object-fit: contain;
    }

    .inspector-section+.inspector-section {
        margin-top: 14px;
    }

    .inspector-section-title {
        color: var(--hud-gold);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .inspector-note {
        color: var(--hud-muted);
        font-size: .88rem;
        line-height: 1.66;
    }

    .planet-build-form {
        display: grid;
        gap: 10px;
        margin-top: 12px;
    }

    .planet-build-form label {
        color: var(--hud-muted);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .planet-build-form .btn {
        min-height: 36px;
    font-size: 0.8rem;
        border-radius: 14px;
        border: 1px solid rgba(143, 215, 255, .18);
        background: rgba(96, 187, 255, .10);
        color: #f1f7ff;
        font-weight: 700;
    }

    .system-loader,
    .system-transition {
        position: fixed;
        inset: 0;
        z-index: 160;
        display: grid;
        place-items: center;
        transition: opacity .46s ease, visibility .46s ease;
    }

    .system-loader {
        background: radial-gradient(circle at 50% 40%, rgba(20, 48, 84, .34), rgba(1, 4, 10, .94));
        opacity: 1;
        visibility: visible;
    }

    .system-loader.is-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .system-loader__box {
        text-align: center;
        padding: 26px 30px;
        border-radius: 24px;
        border: 1px solid rgba(143, 215, 255, .16);
        background: rgba(6, 12, 24, .68);
        backdrop-filter: blur(16px);
        box-shadow: 0 18px 42px rgba(0, 0, 0, .26);
    }

    .system-loader__title {
        color: #eff7ff;
        font-size: .92rem;
        font-weight: 800;
        letter-spacing: .28em;
        text-transform: uppercase;
    }

    .system-loader__copy {
        margin-top: 10px;
        color: var(--hud-muted);
        font-size: .9rem;
    }

    .system-transition {
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 36%, rgba(24, 58, 99, .24), rgba(1, 4, 10, .96));
    }

    .system-transition.is-visible {
        opacity: 1;
        visibility: visible;
    }

    .flash {
        animation: flashGlow 1.2s ease-in-out 0s 2;
    }
    /* Flets mechanics */
   .fleet-panel-toggle {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 0;
    margin: 0 0 12px 0;
    border: 0;
    background: transparent;
    color: inherit;
    cursor: pointer;
}

.fleet-panel-toggle__arrow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 10px;
    border: 1px solid rgba(143, 215, 255, .14);
    background: rgba(255, 255, 255, .03);
    color: var(--hud-text);
    font-size: 14px;
    transition: transform .2s ease;
    flex: 0 0 28px;
}

.fleet-panel-content {
    overflow: hidden;
    max-height: 2000px;
    transition: max-height .25s ease, opacity .2s ease;
    opacity: 1;
}

.right-panel.is-fleet-collapsed .fleet-panel-content {
    max-height: 0;
    opacity: 0;
    pointer-events: none;
}

.right-panel.is-fleet-collapsed .fleet-panel-toggle__arrow {
    transform: rotate(180deg);
} 

    @keyframes flashGlow {
        50% {
            box-shadow: 0 0 22px rgba(90, 210, 255, 0.55);
        }
    }

    @media (max-width: 1240px) {
        .system-topbar {
            flex-direction: column;
            align-items: stretch;
        }
    }

    @media (max-width: 1100px) {

        .left-panel,
        .right-panel {
            width: min(360px, calc(100vw - 24px));
        }

        .left-panel {
            left: 12px;
        }
    }

    @media (max-width: 820px) {

        .left-panel,
        .right-panel,
        .planet-inspector {
            width: calc(100vw - 24px);
        }

        .right-panel {
            top: auto;
            bottom: 12px;
            max-height: 34vh;
        }

        .left-panel {
            top: 112px;
            max-height: 32vh;
        }

        .planet-inspector {
            bottom: auto;
            top: 50%;
            transform: translateY(22px);
            max-height: 42vh;
        }

        .planet-inspector.is-open {
            transform: translateY(0);
        }

        .system-feedback-stack {
            top: 112px;
            width: calc(100vw - 24px);
        }
    }
    #planetInspectorFleetContainer {
    position: absolute;      
    top: 0;
    right: -180px;           
    width: 170px;
    z-index: 10;
    display: none;
}

#planetInspectorFleetContainer.has-fleet {
    display: block;
}

#planetInspectorFleetContainer .planet-inspector-fleet {
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, .07);
    background: rgba(255, 255, 255, .03);
    padding: 10px;
    display: grid;
    gap: 10px;
}

#planetInspectorFleetContainer .planet-inspector-fleet__ship {
    min-height: 110px;
    display: grid;
    place-items: center;
    border-radius: 14px;
    border: 1px solid rgba(143, 215, 255, .12);
    background: radial-gradient(circle at center, rgba(27, 52, 73, 0.42), rgba(0, 0, 0, 0.34));
    padding: 8px;
}

#planetInspectorFleetContainer .planet-inspector-fleet__ship img {
    max-width: 100%;
    max-height: 92px;
    object-fit: contain;
    filter: drop-shadow(0 0 16px rgba(72, 203, 255, 0.20));
}

#planetInspectorFleetContainer .planet-inspector-fleet__name {
    color: var(--hud-text);
    font-weight: 800;
    line-height: 1.3;
}

#planetInspectorFleetContainer .planet-inspector-fleet__meta {
    color: var(--hud-muted);
    font-size: .82rem;
    line-height: 1.55;
}
</style>
@endpush

@section('content')
<div class="system-view">
    <iframe
        class="sys-frame"
        src="{{ asset('legacy/system.html') }}?embed=1&session={{ $session->id }}&player={{ $player->id }}&system={{ $system->id }}"
        data-system-frame></iframe>

    <div class="system-topbar hud-panel">
        <div class="system-brand">
            <div>
                <div class="system-brand__eyebrow">System Command</div>
                <div class="system-brand__title">{{ $system->name }} · Turn {{ $session->turn }}</div>
            </div>
        </div>

        <div class="system-actions">
            @foreach($resourceTopbarMap as $resource)
            <span class="system-pill" title="{{ $resource['label'] }}">
                <img src="{{ $resource['icon'] }}" alt="{{ $resource['label'] }}">
                <span>{{ $player->{$resource['field']} }}</span>
                <span class="system-pill__income">(+{{ $player->{$resource['income']} }})</span>
            </span>
            @endforeach

            <a class="system-action" href="{{ route('game.galaxy', ['session' => $session->id]) }}" data-page-link>← Galaxy</a>
            <form method="POST" action="{{ route('game.endTurn', ['session' => $session->id]) }}" class="m-0">
                @csrf
                <input type="hidden" name="return_to" value="{{ request()->url() }}">
                <button class="system-action system-action--gold" type="submit">{{ __('ui.game.end_turn') }}</button>
            </form>
        </div>
    </div>

    @if(session('status') || session('error'))
    <div class="system-feedback-stack">
        @if(session('status'))
        <div class="system-feedback">
            <div class="system-feedback-title">Status</div>
            <div>{{ session('status') }}</div>
        </div>
        @endif
        @if(session('error'))
        <div class="system-feedback is-error">
            <div class="system-feedback-title">Action Blocked</div>
            <div>{{ session('error') }}</div>
        </div>
        @endif
    </div>
    @endif

    @include('game.partials.command_panel')

    <div class="left-panel hud-panel">
        <div class="panel-title">Planets</div>
        <div class="panel-subtitle">Select a planet to open the inspector. Hover over the resource box to reveal extracted yields.</div>

        @forelse($planets as $p)
        @php
        $showPlanetIdentity = in_array($visStatus, ['discovered', 'surveyed']) || $fleets->isNotEmpty();
        $systemClaimedByPlayer = (int)($system->owner_player_id ?? 0) === (int)$player->id;
        $planetTypeKey = $showPlanetIdentity ? strtolower((string) $p->type) : 'unknown';
        $planetIcon = $p->is_capital
        ? ($racePlanetIconMap[$systemOwnerRaceKey ?? $player->race_key] ?? reset($racePlanetIconMap))
        : ($planetTypeIconMap[$planetTypeKey] ?? ($planetTypeIconMap['terran'] ?? ''));
        $planetTypeLabel = $showPlanetIdentity ? ucfirst(str_replace('_', ' ', $p->type)) : __('ui.game.unknown');
        $planetName = $showPlanetIdentity ? $p->name : 'Unknown Planet';
        @endphp

        <div class="planet-row" onclick="openPlanet({{ $p->id }})">
            <div class="planet-visual">
                <img src="{{ $planetIcon }}" alt="{{ $planetName }}">
            </div>

            <div class="planet-meta">
                <div class="planet-name">{{ $planetName }}</div>
                <div class="planet-type">{{ $planetTypeLabel }}</div>
                @if($p->is_capital && $visStatus === 'surveyed')
                <div class="planet-capital-badge">Capital World</div>
                @endif
            </div>

            @if($systemClaimedByPlayer)
            <button
                type="button"
                class="resource-trigger"
                data-planet-name="{{ $planetName }}"
                data-yields='@json($p->ui_yields ?? [])'
                data-tooltip-copy="Hold to inspect extracted resources"
                aria-label="Planet resources">
                <img src="{{ $resourceBoxIcon }}" alt="Resources">
            </button>
            @endif
        </div>
        @empty
        <div class="panel-subtitle mb-0">No planets are present in this system.</div>
        @endforelse
    </div>

    <div class="right-panel hud-panel" id="fleetPanel">
    <button type="button" class="fleet-panel-toggle" id="fleetPanelToggle" aria-expanded="true">
        <div class="panel-title mb-0">Fleets</div>
        <span class="fleet-panel-toggle__arrow">⌃</span>
    </button>

    <div class="fleet-panel-content" id="fleetPanelContent">

        @if($fleets->isEmpty())
        <div class="panel-subtitle mb-0">No fleets are currently stationed in this system.</div>
        @else
        <div class="panel-subtitle">Choose a ship to preview it and move it to another connected system.</div>

        @foreach($fleets as $f)
        @php
        $variant = $f->ship_variant ?? 'litle';
        $previewImage = $shipPreviewImagesByRace[$player->race_key][$variant] ?? $shipPreviewImagesByRace['humans']['litle'];
        $previewModel = $shipPreviewModelsByRace[$player->race_key][$variant] ?? $shipPreviewModelsByRace['humans']['litle'];
        $variantLabel = $fleetVariantLabelMap[$variant] ?? 'Ship';
        $shipClassIcon = $shipClassIconMap[$variant] ?? $shipClassIconMap['litle'];
        @endphp
        <div class="fleet-row" id="fleet-{{ $f->id }}">
            <div class="fleet-summary">
                <div class="fleet-name">{{ $f->name }}</div>
                <div class="fleet-class">{{ $variantLabel }}</div>
                <div class="fleet-mission">Mission: {{ ucfirst($f->mission) }}</div>
            </div>

            <button

                type="button"
                class="fleet-select-btn"
                data-fleet-id="{{ $f->id }}"
                data-fleet-name="{{ $f->name }}"
                data-fleet-variant-label="{{ $variantLabel }}"
                data-fleet-preview="{{ $previewImage }}"
                data-fleet-model="{{ $previewModel }}"
                data-move-action="{{ route('game.fleet.move', ['session' => $session->id, 'fleet' => $f->id]) }}"
                data-survey-action="{{ route('game.fleet.survey', ['session' => $session->id, 'fleet' => $f->id]) }}">
                <img src="{{ $shipClassIcon }}" alt="{{ $variantLabel }}">
                <span>Select</span>
            </button>
        </div>
        @endforeach

        <div class="fleet-preview-card">
            <div class="fleet-preview-frame">
                <model-viewer
                    id="fleetPreviewModel"
                    src=""
                    alt="Ship preview"
                    camera-controls
                    auto-rotate
                    shadow-intensity="1"
                    exposure="1"
                    style="width:100%;height:100%;background:transparent;display:none;">
                </model-viewer>

                <div id="fleetPreviewEmpty" class="empty-state-note">Select a ship from the list above.</div>
            </div>
            <div id="fleetPreviewTitle" class="fleet-preview-title">No Ship Selected</div>
            <div id="fleetPreviewSubtitle" class="fleet-preview-subtitle">Choose a fleet to inspect its silhouette and orders.</div>

            <form id="fleetMoveForm" method="POST" action="" class="d-none">
                @csrf
                <div class="fleet-move-row">
                    <select name="target_star_system_id" class="form-select form-select-sm">
                        @foreach($neighbors as $neighbor)
                        <option value="{{ $neighbor->id }}">{{ $neighbor->name }}</option>
                        @endforeach
                    </select>
                    <button class="system-action" type="submit">{{ __('ui.game.move') }}</button>
                </div>
            </form>

            <form id="fleetSurveyForm" method="POST" action="{{ $fleets->first() ? route('game.fleet.survey', ['session' => $session->id, 'fleet' => $fleets->first()->id]) : '#' }}" class="mt-2">
                @csrf
                <button class="system-action system-action--gold w-100 justify-content-center" {{ $fleets->isEmpty() ? 'disabled' : '' }}>{{ __('ui.game.survey') }}</button>
            </form>
        </div>
        @endif
    </div>
        @if(!$system->owner_player_id)
        <div class="claim-progress-card mt-3">
            @php
            $claimProgress = (int) ($system->claim_progress ?? 0);
            $claimRequired = max(1, (int) ($system->claim_required_turns ?? 5));
            $claimPercent = (int) round(($claimProgress / $claimRequired) * 100);
            $claimOwnerIsPlayer = (int) ($system->claim_player_id ?? 0) === (int) $player->id;
            $claimInProgress = !empty($system->claim_player_id);
            $playerHasFleetHere = $fleets->isNotEmpty();
            @endphp

            @if($claimInProgress)
            <div class="claim-progress-title">System Claim</div>
            <div class="claim-progress-text">
                {{ $claimOwnerIsPlayer ? 'Claim in progress.' : 'Another empire is currently claiming this system.' }}
            </div>
            <div class="claim-progress-subtext mt-2">
                Progress: {{ $claimProgress }}/{{ $claimRequired }} turns.
            </div>
            <div class="claim-progress-meter">
                <div class="claim-progress-fill" style="width: {{ $claimPercent }}%;"></div>
            </div>
            <div class="claim-progress-subtext mt-2">
                {{ $claimOwnerIsPlayer
                            ? 'Keep ending turns until the claim is complete and control transfers to your empire.'
                            : 'You cannot begin another claim until the current one is resolved.' }}
            </div>
            @elseif($playerHasFleetHere)
            <div class="claim-progress-title">System Claim</div>
            <div class="claim-progress-subtext text-start">Spend 10 Influence to begin the five-turn claim process while one of your fleets remains in the system.</div>
            <form method="POST" action="{{ route('game.system.claim', ['session' => $session->id, 'system' => $system->id]) }}" class="mt-3">
                @csrf
                <button class="system-action system-action--gold w-100 justify-content-center" type="submit">Claim System · 10 Influence</button>
            </form>
            @else
            <div class="claim-progress-title">System Claim</div>
            <div class="claim-progress-subtext text-start">Move one of your fleets into this system before attempting to establish control.</div>
            @endif
        </div>
        @endif
    </div>

    <form id="fleetPlanetMoveForm" method="POST" action="" class="d-none">
        @csrf
        <input type="hidden" name="target_planet_id" id="fleetPlanetMoveTargetPlanetId">
    </form>

    <div id="resourcePopup" class="floating-context-panel" aria-hidden="true"></div>

  <div class="planet-inspector" id="planetInspector" aria-hidden="true">
    <div class="planet-inspector__head">
        <div class="planet-inspector__title" id="planetInspectorTitle">PLANET</div>
        <button type="button" class="planet-inspector__close" id="planetInspectorClose">✕</button>
    </div>
    <div class="planet-inspector__body" id="planetInspectorBody">
        <div class="inspector-note">System data will appear here after a planet is selected.</div>
    </div>
        <div id="planetInspectorFleetContainer"></div>
</div>
    <div class="system-loader" data-system-loader>
        <div class="system-loader__box">
            <div class="system-loader__title">Entering System</div>
            <div class="system-loader__copy">Loading stellar bodies, fleets, and orbital interface.</div>
        </div>
    </div>

    <div class="system-transition" data-system-transition></div>
</div>

@push('scripts')
<script>
    let holdTimer = null;
    let planetInspectorOpen = false;
    const resourcePopup = document.getElementById('resourcePopup');
    const planetInspector = document.getElementById('planetInspector');
    const planetInspectorTitle = document.getElementById('planetInspectorTitle');
    const planetInspectorSubtitle = document.getElementById('planetInspectorSubtitle');
    const planetInspectorBody = document.getElementById('planetInspectorBody');
    const planetInspectorClose = document.getElementById('planetInspectorClose');
    const planetResourceMeta = @json($planetResourceMeta);
    const planetTypeIconMap = @json($planetTypeIconMap);
const racePlanetIconMap = @json($racePlanetIconMap);
const planetBannerMap = @json($planetBannerMap);
const shipPreviewImagesByRace = @json($shipPreviewImagesByRace);
const defaultPlanetOwnerRaceKey = @json($systemOwnerRaceKey ?? $player->race_key ?? 'humans');
    const fleetPanel = document.getElementById('fleetPanel');
const fleetPanelToggle = document.getElementById('fleetPanelToggle');
const FLEET_PANEL_STORAGE_KEY = 'fleet-panel-collapsed-{{ $session->id }}-{{ $system->id }}-{{ $player->id }}';
const fleetPreviewModel = document.getElementById('fleetPreviewModel');
    const fleetPreviewEmpty = document.getElementById('fleetPreviewEmpty');
    const fleetPreviewTitle = document.getElementById('fleetPreviewTitle');
    const fleetPreviewSubtitle = document.getElementById('fleetPreviewSubtitle');
    const fleetMoveForm = document.getElementById('fleetMoveForm');
    const fleetSurveyForm = document.getElementById('fleetSurveyForm');
    const fleetButtons = Array.from(document.querySelectorAll('.fleet-select-btn'));
    const systemFrame = document.querySelector('[data-system-frame]');
    const systemLoader = document.querySelector('[data-system-loader]');
    const systemTransition = document.querySelector('[data-system-transition]');
    const fleetPlanetMoveForm = document.getElementById('fleetPlanetMoveForm');
    const fleetPlanetMoveTargetPlanetId = document.getElementById('fleetPlanetMoveTargetPlanetId');
  const fleetPlanetMoveActionTemplate = @json(route('game.fleet.planet.move', ['session' => $session->id, 'fleet' => '__FLEET__']));
let selectedFleetId = null;
    function setFleetPanelCollapsed(collapsed) {
    if (!fleetPanel || !fleetPanelToggle) return;

    fleetPanel.classList.toggle('is-fleet-collapsed', collapsed);
    fleetPanelToggle.setAttribute('aria-expanded', collapsed ? 'false' : 'true');

    try {
        localStorage.setItem(FLEET_PANEL_STORAGE_KEY, collapsed ? '1' : '0');
    } catch (e) {}
}

function restoreFleetPanelState() {
    let collapsed = false;

    try {
        collapsed = localStorage.getItem(FLEET_PANEL_STORAGE_KEY) === '1';
    } catch (e) {}

    setFleetPanelCollapsed(collapsed);
}
function hideSystemLoader() {
    systemLoader?.classList.add('is-hidden');
    systemFrame?.classList.add('is-ready');
}
    function escapeHtml(value) {
        return String(value ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function renderYieldBadges(yields = {}) {
        const items = planetResourceMeta
            .filter(({
                key
            }) => Number(yields?.[key] || 0) > 0)
            .map(({
                key,
                icon,
                label
            }) => `
                <span class="inspector-yield" title="${label}">
                    <img src="${icon}" alt="${label}">
                    <span>${yields[key]}</span>
                </span>
            `);

        return items.length ?
            `<div class="inspector-yields">${items.join('')}</div>` :
            '<div class="inspector-note">Survey the system to reveal the resources extracted from this planet.</div>';
    }

    function showResourcePopup(trigger, x, y) {
        const planetName = trigger.dataset.planetName || 'Planet';
        const yields = JSON.parse(trigger.dataset.yields || '{}');
        resourcePopup.innerHTML = `
            <div class="floating-context-title">${escapeHtml(planetName)} Resources</div>
            ${renderYieldBadges(yields)}
        `;

        const popupWidth = 340;
        const popupHeight = 180;
        resourcePopup.style.left = `${Math.max(12, Math.min(x, window.innerWidth - popupWidth - 12))}px`;
        resourcePopup.style.top = `${Math.max(12, Math.min(y, window.innerHeight - popupHeight - 12))}px`;
        resourcePopup.classList.add('visible');
        resourcePopup.setAttribute('aria-hidden', 'false');
    }

    function hideResourcePopup() {
        resourcePopup.classList.remove('visible');
        resourcePopup.setAttribute('aria-hidden', 'true');
    }

    function clearHoldTimer(trigger) {
        clearTimeout(holdTimer);
        if (trigger) trigger.classList.remove('is-arming');
    }

    function armResourceTrigger(trigger) {
        clearHoldTimer(trigger);
        trigger.classList.add('is-arming');
        holdTimer = setTimeout(() => {
            const rect = trigger.getBoundingClientRect();
            showResourcePopup(trigger, rect.right + 10, rect.top + 6);
        }, 1800);
    }

function openInspector(title, subtitle, bodyHtml, fleetHtml = '') {
    planetInspectorTitle.textContent = `PLANET ${String(title || '').toUpperCase()}`;
    planetInspectorBody.innerHTML = bodyHtml;

    const fleetContainer = document.getElementById('planetInspectorFleetContainer');
    if (fleetContainer) {
        fleetContainer.innerHTML = '';
        fleetContainer.classList.remove('has-fleet');

        if (fleetHtml) {
            fleetContainer.innerHTML = fleetHtml;
            fleetContainer.classList.add('has-fleet');
        }
    }

    wirePlanetInspectorTabs();
    planetInspector.classList.add('is-open');
    planetInspector.setAttribute('aria-hidden', 'false');
    planetInspectorOpen = true;
}
function closeInspector() {
    planetInspector.classList.remove('is-open');
    planetInspector.setAttribute('aria-hidden', 'true');
    planetInspectorOpen = false;

    const fleetContainer = document.getElementById('planetInspectorFleetContainer');
    if (fleetContainer) {
        fleetContainer.innerHTML = '';
        fleetContainer.classList.remove('has-fleet');
    }
}


restoreFleetPanelState();
planetInspectorClose?.addEventListener('click', closeInspector);

    function syncFleetSelectionToFrame() {
        systemFrame?.contentWindow?.postMessage({
            type: 'syncFleetSelection',
            fleetId: selectedFleetId
        }, '*');
    }

    function clearFleetSelection() {
    selectedFleetId = null;

    fleetButtons.forEach((btn) => btn.classList.remove('is-active'));

    if (fleetPreviewModel) {
        fleetPreviewModel.removeAttribute('src');
        fleetPreviewModel.style.display = 'none';
    }

    if (fleetPreviewEmpty) {
        fleetPreviewEmpty.classList.remove('d-none');
    }

    if (fleetPreviewTitle) {
        fleetPreviewTitle.textContent = 'No Ship Selected';
    }

    if (fleetPreviewSubtitle) {
        fleetPreviewSubtitle.textContent = 'Choose a fleet to inspect its silhouette and orders.';
    }

    if (fleetMoveForm) {
        fleetMoveForm.classList.add('d-none');
        fleetMoveForm.action = '';
    }

    syncFleetSelectionToFrame();
}
fleetPanelToggle?.addEventListener('click', () => {
    const collapsed = fleetPanel.classList.contains('is-fleet-collapsed');
    setFleetPanelCollapsed(!collapsed);
});
function selectFleetButton(button) {
    if (!button || !fleetMoveForm) return;

    selectedFleetId = Number(button.dataset.fleetId || 0) || null;
    fleetButtons.forEach((btn) => btn.classList.remove('is-active'));
    button.classList.add('is-active');

    const fleetName = button.dataset.fleetName || 'Ship';
    const fleetVariantLabel = button.dataset.fleetVariantLabel || 'Ship';
    const previewModel = button.dataset.fleetModel || '';
    const moveAction = button.dataset.moveAction || '';
    const surveyAction = button.dataset.surveyAction || '';

    if (fleetPreviewTitle) {
        fleetPreviewTitle.textContent = fleetName;
    }

    if (fleetPreviewSubtitle) {
        fleetPreviewSubtitle.textContent = fleetVariantLabel;
    }

    if (fleetPreviewModel) {
        if (previewModel) {
            fleetPreviewModel.src = previewModel;
            fleetPreviewModel.style.display = 'block';
        } else {
            fleetPreviewModel.removeAttribute('src');
            fleetPreviewModel.style.display = 'none';
        }
    }

    if (fleetPreviewEmpty) {
        fleetPreviewEmpty.classList.add('d-none');
    }

    fleetMoveForm.classList.remove('d-none');
    fleetMoveForm.action = moveAction;

    if (fleetSurveyForm && surveyAction) {
        fleetSurveyForm.action = surveyAction;
    }

    syncFleetSelectionToFrame();
}

   function buildPlanetInspectorHtml(p, buildings = []) {
    const slots = [];
    for (let i = 0; i < p.slots; i++) {
        const building = buildings.find((item) => item.slot === i);
        slots.push({
            i,
            building: building ? building.key : null
        });
    }

    const buildOptions = @json(array_keys(config('game.buildings')));
    const buildUrl = "{{ route('game.planet.build', ['session' => $session->id, 'planet' => '__PID__']) }}".replace('__PID__', String(p.id));
    const happinessPct = Math.round((Number(p.happiness) || 0) * 100);

    const planetTypeKey = String(p.type || 'unknown').toLowerCase();
    const ownerRaceKey = String(p.owner_race_key || defaultPlanetOwnerRaceKey || 'humans').toLowerCase();

    const planetImage = p.is_capital
        ? (racePlanetIconMap[ownerRaceKey] || planetTypeIconMap[planetTypeKey] || planetTypeIconMap.unknown || '')
        : (planetTypeIconMap[planetTypeKey] || planetTypeIconMap.unknown || '');

    const bannerImage = planetBannerMap[planetTypeKey] || planetBannerMap[ownerRaceKey] || '';

    const infoHtml = `
        <div class="planet-inspector-mini-grid">
            <div class="planet-inspector-mini-stat">
                <div class="planet-inspector-mini-stat__label">Population</div>
                <div class="planet-inspector-mini-stat__value">${escapeHtml(p.population)}</div>
            </div>
            <div class="planet-inspector-mini-stat">
                <div class="planet-inspector-mini-stat__label">Happiness</div>
                <div class="planet-inspector-mini-stat__value">${happinessPct}%</div>
            </div>
            <div class="planet-inspector-mini-stat">
                <div class="planet-inspector-mini-stat__label">Specialization</div>
                <div class="planet-inspector-mini-stat__value">${escapeHtml(p.specialization)}</div>
            </div>
            <div class="planet-inspector-mini-stat">
                <div class="planet-inspector-mini-stat__label">Capital</div>
                <div class="planet-inspector-mini-stat__value">${p.is_capital ? 'Yes' : 'No'}</div>
            </div>
        </div>
    `;

    const constructionHtml = `
        <div class="inspector-note" style="margin-bottom:10px;">Choose a free slot and build a structure.</div>
        <form class="planet-build-form" method="POST" action="${buildUrl}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label>Slot</label>
                <select name="slot_index" class="form-select form-select-sm">
                    ${slots.map((slot) => `<option value="${slot.i}" ${slot.building ? 'disabled' : ''}>#${slot.i} ${slot.building ? '(occupied)' : ''}</option>`).join('')}
                </select>
            </div>
            <div>
                <label>Building</label>
                <select name="building_key" class="form-select form-select-sm">
                    ${buildOptions.map((key) => `<option value="${key}">${escapeHtml(key)}</option>`).join('')}
                </select>
            </div>
            <button class="btn" type="submit">Build Structure</button>
        </form>
    `;

    const slotsHtml = `
        <div class="inspector-slots">
            ${slots.map((slot) => `<span class="inspector-slot">Slot ${slot.i}: ${escapeHtml(slot.building || 'empty')}</span>`).join('')}
        </div>
    `;

    return `
        <div class="planet-inspector-shell">
            <div class="planet-inspector-main-shell">
                
                <div class="planet-inspector-layout">
                   <div class="planet-inspector-hero">
    <div class="planet-inspector-hero__banner">
        ${bannerImage ? `<img src="${bannerImage}" alt="Banner">` : `<div class="planet-inspector-banner-placeholder"></div>`}

        <div class="planet-inspector-banner-content">

            <div class="planet-inspector-hero__planet">
                ${planetImage ? `<img src="${planetImage}" alt="${escapeHtml(p.name)}">` : ''}
            </div>

            <div class="planet-inspector-resource-inline">
                ${renderYieldBadges(p.yields || {})}
            </div>

        </div>
    </div>
</div>
                    <div class="planet-inspector-main">
                        <div class="planet-inspector-tabs">
                            <button type="button" class="planet-inspector-tab is-active" data-planet-tab="info">Info</button>
                            <button type="button" class="planet-inspector-tab" data-planet-tab="construction">Build</button>
                            <button type="button" class="planet-inspector-tab" data-planet-tab="slots">Slots</button>
                        </div>

                        <div class="planet-inspector-panel">
                            <div class="planet-tab-content is-active" data-planet-panel="info">${infoHtml}</div>
                            <div class="planet-tab-content" data-planet-panel="construction">${constructionHtml}</div>
                            <div class="planet-tab-content" data-planet-panel="slots">${slotsHtml}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}
function buildPlanetFleetHtml(stationedFleet, ownerRaceKey = 'humans') {
    if (!stationedFleet) return '';

    const fleetRaceKey = String(stationedFleet.race_key || ownerRaceKey || 'humans').toLowerCase();
    const fleetVariant = String(stationedFleet.ship_variant || 'litle').toLowerCase();

    const fleetImage =
        shipPreviewImagesByRace?.[fleetRaceKey]?.[fleetVariant] ||
        shipPreviewImagesByRace?.humans?.[fleetVariant] ||
        shipPreviewImagesByRace?.humans?.litle ||
        '';

    return `
        <div class="planet-inspector-fleet">
            <div class="planet-inspector-bar">
                <div class="planet-inspector-bar__title">Fleet</div>
            </div>
            <div class="planet-inspector-fleet__ship">
                ${fleetImage ? `<img src="${fleetImage}" alt="${escapeHtml(stationedFleet.name)}">` : ''}
            </div>
            <div class="planet-inspector-fleet__name">${escapeHtml(stationedFleet.name)}</div>
            <div class="planet-inspector-fleet__meta">
                Type: ${escapeHtml(stationedFleet.ship_variant || 'Ship')}<br>
                Mission: ${escapeHtml(stationedFleet.mission || 'Idle')}
            </div>
        </div>
    `;
}
function wirePlanetInspectorTabs() {
    const buttons = Array.from(planetInspectorBody.querySelectorAll('[data-planet-tab]'));
    const panels = Array.from(planetInspectorBody.querySelectorAll('[data-planet-panel]'));

    if (!buttons.length || !panels.length) return;

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const tab = button.dataset.planetTab;

            buttons.forEach((btn) => {
                btn.classList.toggle('is-active', btn === button);
            });

            panels.forEach((panel) => {
                panel.classList.toggle('is-active', panel.dataset.planetPanel === tab);
            });
        });
    });
}

    if (systemFrame) {
    systemFrame.addEventListener('load', () => {
        setTimeout(hideSystemLoader, 220);
    });

    try {
        if (systemFrame.contentDocument && systemFrame.contentDocument.readyState === 'complete') {
            setTimeout(hideSystemLoader, 220);
        }
    } catch (e) {}
}


             document.querySelectorAll('.resource-trigger').forEach((btn) => {
            btn.addEventListener('mouseenter', () => armResourceTrigger(btn));
            btn.addEventListener('mouseleave', () => {
                clearHoldTimer(btn);
                hideResourcePopup();
            });
            btn.addEventListener('focus', () => armResourceTrigger(btn));
            btn.addEventListener('blur', () => {
                clearHoldTimer(btn);
                hideResourcePopup();
            });
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                clearHoldTimer(btn);
                showResourcePopup(btn, e.clientX + 10, e.clientY + 10);
            });
        });

        fleetButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const clickedFleetId = Number(button.dataset.fleetId || 0) || null;

                if (selectedFleetId && clickedFleetId === selectedFleetId) {
                    clearFleetSelection();
                    return;
                }

                selectFleetButton(button);
            });
        });

        clearFleetSelection();

        if (systemFrame) {
            systemFrame.addEventListener('load', () => {
                setTimeout(() => {
                    hideSystemLoader();
                    syncFleetSelectionToFrame();
                }, 220);
            });

            try {
                if (systemFrame.contentDocument && systemFrame.contentDocument.readyState === 'complete') {
                    setTimeout(() => {
                        hideSystemLoader();
                        syncFleetSelectionToFrame();
                    }, 220);
                }
            } catch (e) {}
        }

        document.addEventListener('click', (e) => {
            if (!resourcePopup.contains(e.target) && !e.target.closest('.resource-trigger')) {
                hideResourcePopup();
            }
        });

        window.addEventListener('blur', hideResourcePopup);

        window.addEventListener('message', (e) => {
            if (!e.data || typeof e.data !== 'object') return;

            if (e.data.type === 'systemReady') {
                hideSystemLoader();
                syncFleetSelectionToFrame();
                return;
            }

            if (e.data.type === 'openPlanet' && e.data.planetId) {
                openPlanet(Number(e.data.planetId));
                return;
            }

            if (e.data.type === 'selectFleet' && e.data.fleetId) {
                if (Number(selectedFleetId || 0) === Number(e.data.fleetId)) {
                    clearFleetSelection();
                    return;
                }

                const row = document.getElementById('fleet-' + e.data.fleetId);
                const btn = document.querySelector(`.fleet-select-btn[data-fleet-id="${e.data.fleetId}"]`);

                if (btn) {
                    selectFleetButton(btn);
                }

                if (row) {
                    row.classList.add('flash');
                    row.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    setTimeout(() => row.classList.remove('flash'), 2200);
                }
                return;
            }

            if (e.data.type === 'moveFleetToPlanet' && e.data.fleetId && e.data.planetId) {
                if (!selectedFleetId || Number(selectedFleetId) !== Number(e.data.fleetId)) {
                    return;
                }

                fleetPlanetMoveForm.action = fleetPlanetMoveActionTemplate.replace('__FLEET__', String(e.data.fleetId));
                fleetPlanetMoveTargetPlanetId.value = String(e.data.planetId);
                fleetPlanetMoveForm.submit();
                return;
            }

            if (e.data.type === 'goSystem' && e.data.systemId) {
                const url = "{{ route('game.system', ['session' => $session->id, 'system' => 0]) }}".replace('/0', '/' + e.data.systemId);
                systemTransition?.classList.add('is-visible');
                window.AstralPageTransition?.show?.();
                setTimeout(() => window.location.href = url, 520);
            }
        });
   function openPlanet(id) {
    fetch("{{ route('game.api.planet', ['session' => $session->id, 'planet' => 0]) }}".replace('/0', '/' + id) + "?player={{ $player->id }}")
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                openInspector(
                    'Unknown Planet',
                    'Survey the system to reveal more detailed planetary information.',
                    '<div class="inspector-note">Very little data is available about this world. Send a fleet to investigate and complete the survey.</div>',
                    ''
                );
                return;
            }

            const planet = data.planet;
            const buildings = data.buildings || [];
            const fleetHtml = buildPlanetFleetHtml(
                planet.stationed_fleet || null,
                planet.owner_race_key || defaultPlanetOwnerRaceKey || 'humans'
            );

            openInspector(
                `${planet.name}`,
                `${planet.type} world · orbit-ready planetary report`,
                buildPlanetInspectorHtml(planet, buildings),
                fleetHtml
            );
        })
        .catch((error) => {
            console.error('PLANET FETCH ERROR', error);
            openInspector(
                'Planet Data Unavailable',
                'The inspector could not retrieve the requested planet report.',
                '<div class="inspector-note">Please try again in a moment.</div>',
                ''
            );
        });
}
</script>
@endpush
@endsection