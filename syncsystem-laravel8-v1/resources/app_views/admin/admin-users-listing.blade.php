@php
    // Variables.
    $idParent = $templateData['idParent'];

    $_pagingNRecords = config('app.gSystemConfig.configUsersBackendPaginationNRecords');
    $_pagingTotalRecords = 0;
    $_pagingTotal = 0;
    $_pageNumber = (int) $pageNumber;
    if (config('app.gSystemConfig.enableUsersBackendPagination') === 1) {
        $_pagingTotalRecords = $templateData['_pagingTotalRecords'];
        $_pagingTotal = intval(ceil($_pagingTotalRecords / $_pagingNRecords));
        // if (!$_pageNumber) { // TODO: double check this logic.
        // if ($_pageNumber === '') { // TODO: double check this logic. // Verified - 0 (null) changes to 1
        if (!$_pageNumber) {
            $_pageNumber = 1;
        }
    }

    $titleCurrent = $templateData['cphTitleCurrent'];
    $arrUsersListing = $templateData['cphBody']['arrUsersListing'];

    // Meta title.
    $metaTitle = '';
    $metaTitle .= \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersTitleMain');
    if ($titleCurrent) {
        $metaTitle .= ' - ' . $titleCurrent;
    }

    // Meta description.
    $metaDescription = '';

    // Meta keywords.
    $metaKeywords = '';

    // Meta URL current.
    $metaURLCurrent = config('app.gSystemConfig.configSystemURL') . '/';
    $metaURLCurrent .= config('app.gSystemConfig.configRouteBackend') . '/';
    $metaURLCurrent .= config('app.gSystemConfig.configRouteBackendUsers') . '/';
    $metaURLCurrent .= $idParent . '/';
    // if ($masterPageSelect !== '') {
        $metaURLCurrent .= '?masterPageSelect=' . $masterPageSelect;
    // }
    if ($pageNumber && $pageNumber !== '') {
        $metaURLCurrent .= '&pageNumber=' . $pageNumber;
    }
@endphp

@extends('admin.' . $masterPageSelect)

@section('cphTitle')
    {{ $templateData['cphTitle'] }}
@endsection

@section('cphHead')
    <meta name="title" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaTitle); ?>" />{{-- Bellow 160 characters. --}}
    <meta name="description" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaDescription); ?>" />{{-- Bellow 100 characters. --}}
    <meta name="keywords" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaKeywords); ?>" />{{-- Bellow 60 characters. --}}

    {{-- Open Graph tags. --}}
    <meta property="og:title" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaTitle); ?>" />
    <meta property="og:type" content="website" />{{-- http:// ogp.me/#types | https:// developers.facebook.com/docs/reference/opengraph/ --}}
    <meta property="og:url" content="<?php echo $metaURLCurrent; ?>" />
    <meta property="og:description" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaDescription); ?>" />
    <meta property="og:image" content="<?php echo config('app.gSystemConfig.configSystemURL') . '/' . config('app.gSystemConfig.configDirectoryFilesLayoutSD') . '/' . 'icon-logo-og.png'; ?>" /> {{-- The recommended resolution for the OG image is 1200x627 pixels, the size up to 5MB. // 120x120px, up to 1MB JPG ou PNG, lower than 300k and minimum dimension 300x200 pixels. --}}
    <meta property="og:image:alt" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaTitle); ?>" />
    <meta property="og:locale" content="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'configBackendLanguage'); ?>" />
@endsection

@section('cphTitleCurrent')
    {{ $titleCurrent }}
@endsection

@section('cphBody')
    @include('admin.partials.messages-status')

    @php
        // Debug.
        echo 'arrUsersListing=<pre>';
        var_dump($arrUsersListing);
        echo '</pre><br />';
    @endphp

    <section class="ss-backend-layout-section-data01">
        @if (count($arrUsersListing) < 1)
            <div class="ss-backend-alert ss-backend-layout-div-records-empty">
                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage1') }}
            </div>
        @else
            User listing
        @endif
    </section>
@endsection
