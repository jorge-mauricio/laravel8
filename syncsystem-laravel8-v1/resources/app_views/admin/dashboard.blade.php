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
    $metaURLCurrent .= $GLOBALS['configRouteBackendDashboard'] . '/';
    if ($masterPageSelect !== '') {
        $metaURLCurrent .= '?masterPageSelect=' . $masterPageSelect;
    }
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
    @include('admin.partial-messages-status')

    <section class="ss-backend-layout-section-content01 ss-backend-text01">
        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendDashboardWelcome') }},
        {{-- ${objUsersLoggedDetails.tblUsersNameFull} --}}
        <br />
        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendDashboardLoginMessage01') }}:
        {{-- ${objUsersLoggedDetails.tblUsersUsername} --}}
    </section>
@endsection