@php
    // Variables.
    $titleCurrent = $templateData['cphTitleCurrent'];

    // Meta title.
    $metaTitle = '';
    $metaTitle .= $templateData['cphTitle'];
    if ($titleCurrent) {
        $metaTitle .= ' - ' . $titleCurrent;
    }

    // Meta description.
    $metaDescription = '';

    // Meta keywords.
    $metaKeywords = '';

    // Meta URL current.
    $metaURLCurrent = $GLOBALS['configSystemURL'] . '/';
    $metaURLCurrent .= $GLOBALS['configRouteBackend'] . '/';
    if ($masterPageSelect !== '') {
        $metaURLCurrent .= '?masterPageSelect=' . $masterPageSelect;
    }

    // Debug.
    // echo 'configRouteBackend=' . config('app.gSystemConfig.configRouteBackend');
@endphp

@extends('admin.' . $masterPageSelect)

@section('cphTitle')
    {{ $templateData['cphTitle'] }}
@endsection

@section('cphHead')
    <meta name="title" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaTitle); ?>" /> {{-- Bellow 160 characters. --}}
    <meta name="description" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaDescription); ?>" /> {{-- Bellow 100 characters. --}}
    <meta name="keywords" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaKeywords); ?>" /> {{-- Bellow 60 characters. --}}

    {{-- Open Graph tags. --}}
    <meta property="og:title" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaTitle); ?>" />
    <meta property="og:type" content="website" /> {{-- http:// ogp.me/#types | https:// developers.facebook.com/docs/reference/opengraph/ --}}
    <meta property="og:url" content="<?php echo $metaURLCurrent; ?>" />
    <meta property="og:description" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaDescription); ?>" />
    <meta property="og:image" content="<?php echo $GLOBALS['configSystemURL'] . '/' . $GLOBALS['configDirectoryFilesLayoutSD'] . '/' . 'icon-logo-og.png'; ?>" /> {{-- The recommended resolution for the OG image is 1200x627 pixels, the size up to 5MB. // 120x120px, up to 1MB JPG ou PNG, lower than 300k and minimum dimension 300x200 pixels. --}}
    <meta property="og:image:alt" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaTitle); ?>" />
    <meta property="og:locale" content="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'configBackendLanguage'); ?>" />
@endsection

@section('cphTitleCurrent')
    {{ $titleCurrent }}
@endsection

@section('cphBody')
    {{-- Desktop version. --}}
    <div style="position: absolute; 
        display: block; 
        height: 270px; 
        width: 100%; 
        top: 50%; 
        margin-top: -135px; 
        background-image: url(/{{ $GLOBALS['configDirectoryFilesLayoutSD'] }}/backend-layout-login-bg01.jpg), url(/{{ $GLOBALS['configDirectoryFilesLayoutSD'] }}/backend-layout-login-bg02.jpg);
        background-position: top, bottom;
        background-repeat: repeat-x, repeat-x;">
            {{-- Logo. --}}
        <img src="/{{ $GLOBALS['configDirectoryFilesLayoutSD'] }}/backend-layout-logo-client.png" 
            alt="Logo - {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($GLOBALS['configSystemClientName'], 'config-application') }}" 
            style="max-height: 230px;
            position: absolute;  
            top: 0px;  
            bottom: 0px;  
            left: 10px;  
            margin: auto;" />

        {{-- Header. --}}
        <header class="ss-backend-title01" style="position: absolute; display: block; right: 10px; top: 30px; text-align: right; font-size: 24px;">
            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'layoutSystemName') }}
        </header>

        {{-- Login. --}}
        <main class="ss-backend-text01" style="position: absolute; display: block; right: 10px; bottom: 30px; text-align: right;">
            @include('admin.partial-messages-status')
            
            <form id="formLogin" name="formLogin" method="POST" action="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendLogin'] }}" enctype="multipart/form-data">
                @csrf
                
                <div style="position: relative; display: block;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendLoginUser') }}:
                    <input type="text" id="username" name="username" class="ss-backend-field-text01" />
                </div>
                <div style="position: relative; display: block; margin: 5px 0px;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendLoginPassword') }}:
                    <input type="password" id="password" name="password" class="ss-backend-field-text01" />
                </div>
                <div style="position: relative; display: block;">
                    <button class="ss-backend-btn-base ss-backend-btn-action">
                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendButtonLogin') }}
                    </button>
                </div>
            </form>
        </main>

        {{-- Footer. --}}
        <footer class="ss-backend-copyright" style="position: absolute; 
                                                    display: block;
                                                    right: 0px;
                                                    bottom: -5px;  
                                                    left: 0px; 
                                                    text-align: center;">
            {{ 
                \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'layoutCopyright') . ' ® ' . 
                \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'layoutDevName') . ' ' . 
                \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'layoutCopyright1')
            }}
        </footer>
    </div>
@endsection
