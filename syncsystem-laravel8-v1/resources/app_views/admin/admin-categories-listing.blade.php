@php
    // Variables.
    $titleCurrent = $templateData['cphTitleCurrent'];
    $arrCategoriesDetails = $templateData['cphBody']['arrCategoriesDetails'];
    $arrCategoriesListing = $templateData['cphBody']['arrCategoriesListing'];

    // Meta title.
    $metaTitle = '';
    $metaTitle .= \SyncSystemNS\FunctionsGeneric::contentMaskRead($GLOBALS['configSystemClientName'], 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesTitleMain');
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
    $metaURLCurrent .= $GLOBALS['configRouteBackendCategories'] . '/';
    $metaURLCurrent .= $templateData['cphBody']['arrCategoriesDetails']['tblCategoriesIdParent'] . '/';
    // if ($masterPageSelect !== '') {
        $metaURLCurrent .= '?masterPageSelect=' . $masterPageSelect;
    // }
    if ($pageNumber && $pageNumber !== '') {
        $metaURLCurrent .= '&pageNumber=' . $pageNumber;
    }
@endphp

{{-- @include('admin.include-layout') --}}
{{-- @include('admin.include-layout', ['masterPageSelect' => $masterPageSelect]) --}}
{{-- @extends('admin.include-layout') --}}
{{-- @extends('admin.layout-admin-main') --}}
{{-- @extends('admin.{{$masterPageSelect}}') --}}
{{-- @extends({{'admin.' . $masterPageSelect}}) --}}
@extends('admin.' . $masterPageSelect)
{{-- @extends('admin.' . $GLOBALS['masterPageSelect']) --}}
{{-- @extends('admin.' . $templateData['masterPageSelect']) --}}

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
    {{-- TODO: substitute with session. --}}
    <div id="divMessageSuccess" class="ss-backend-success">

    </div>
    <div id="divMessageError" class="ss-backend-error">

    </div>
    <div id="divMessageAlert" class="ss-backend-alert">

    </div>

    <script>
        // Debug.
        // alert(document.location);
        // alert(window.location.hostname);
        // alert(window.location.host);
        // alert(window.location.origin);
    </script>

    <section class="ss-backend-layout-section-data01">
        @if (count($arrCategoriesListing) < 1)
            <div class="ss-backend-alert ss-backend-layout-div-records-empty">
                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage1') }}
            </div>
        @else
            <div style="position: relative; display: block; overflow: hidden; margin-bottom: 2px;">
                <button 
                    id="categories_delete" 
                    name="categories_delete" 
                    onclick="elementMessage01('formCategoriesListing_method', 'DELETE');
                            formSubmit('formCategoriesListing', '', '', '/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/?_method=DELETE');
                            " 
                    class="ss-backend-btn-base ss-backend-btn-action-cancel" 
                    style="float: right;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemDelete') }}
                </button>
            </div>
        
            has data
        @endif
    </section>
    
    <pre>
        @php
            // Debug.
            //echo '_GET=' . $_GET['masterPageSelect'] . '<br />';
            //echo 'masterPageSelect=' . $masterPageSelect . '<br />';
            //echo 'masterPageSelect=' . $masterPageSelect . '<br />';

            // var_dump($templateData['cphBody']);
            // var_dump($templateData['additionalData']);
        @endphp
    </pre>
@endsection