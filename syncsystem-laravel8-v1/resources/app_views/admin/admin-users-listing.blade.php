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
        /*
        echo 'arrUsersListing=<pre>';
        var_dump($arrUsersListing);
        echo '</pre><br />';
        */
    @endphp

    <section class="ss-backend-layout-section-data01">
        @if (count($arrUsersListing) < 1)
            <div class="ss-backend-alert ss-backend-layout-div-records-empty">
                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage1') }}
            </div>
        @else
            <div style="position: relative; display: block; overflow: hidden; margin-bottom: 2px;">
                <button
                    id="users_delete"
                    name="users_delete"
                    onclick="elementMessage01('formUsersListing_method', 'DELETE');
                            formSubmit('formUsersListing', '', '', '/{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendRecords') }}/?_method=DELETE');
                            "
                    class="ss-backend-btn-base ss-backend-btn-action-cancel"
                    style="float: right;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDelete') }}
                </button>
            </div>

            <form
                id="formUsersListing"
                name="formUsersListing"
                method="POST"
                action=""
                enctype="application/x-www-form-urlencoded"
            >
                @csrf
                <input type="hidden" id="formUsersListing_method" name="_method" value="">

                <input type="hidden" id="formUsersListing_strTable" name="strTable" value="{{ config('app.gSystemConfig.configSystemDBTableUsers') }}" />

                <input type="hidden" id="formUsersListing_idParent" name="idParent" value="{{ $idParent }}" />
                <input type="hidden" id="formUsersListing_pageReturn" name="pageReturn" value="{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') }}" />
                <input type="hidden" id="formUsersListing_pageNumber" name="pageNumber" value="{{ $pageNumber }}" />
                <input type="hidden" id="formUsersListing_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />

                <div style="position: relative; display: block; overflow: hidden;">
                    <table class="ss-backend-table-listing01">
                        <caption class="ss-backend-table-header-text01 ss-backend-table-title">
                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersTitleMain') }}
                        </caption>
                        <thead class="ss-backend-table-bg-dark ss-backend-table-header-text01">
                            <tr>
                                @if (config('app.gSystemConfig.enableUsersSortOrder') === 1)
                                    <td style="width: 40px; text-align: left;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemSortOrderA') }}
                                    </td>
                                @endif

                                @if (config('app.gSystemConfig.enableUsersImageMain') === 1)
                                    <td style="width: 100px; text-align: left;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemImage') }}
                                    </td>
                                @endif

                                @if (config('app.gSystemConfig.enableUsersNameFull') === 1)
                                    <td style="text-align: left;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersNameFull') }}
                                    </td>
                                @endif

                                @if (config('app.gSystemConfig.enableUsersNameFirst') === 1)
                                    <td style="text-align: left;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersNameFirst') }}
                                    </td>
                                @endif

                                <td style="width: 100px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemFunctions') }}
                                </td>

                                <td style="width: 40px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivationA') }}
                                </td>

                                @if (config('app.gSystemConfig.enableUsersActivation1') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation1') }}
                                    </td>
                                @endif
                                @if (config('app.gSystemConfig.enableUsersActivation2') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation2') }}
                                    </td>
                                @endif
                                @if (config('app.gSystemConfig.enableUsersActivation3') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation3') }}
                                    </td>
                                @endif
                                @if (config('app.gSystemConfig.enableUsersActivation4') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation4') }}
                                    </td>
                                @endif
                                @if (config('app.gSystemConfig.enableUsersActivation5') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation5') }}
                                    </td>
                                @endif

                                <td style="width: 40px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemEdit') }}
                                </td>
                                <td style="width: 40px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDelete') }}
                                </td>
                            </tr>
                        </thead>

                        <tbody class="ss-backend-table-listing-text01">
                            @foreach ($arrUsersListing as $usersRow)
                                <tr class="ss-backend-table-bg-light">
                                    @if (config('app.gSystemConfig.enableUsersSortOrder') === 1)
                                        <td style="text-align: center;">
                                            {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($usersRow['sort_order'], '', 3, null) }}
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableUsersImageMain') === 1)
                                        <td style="text-align: center;">
                                            @if ((string) $usersRow['image_main'] !== '')
                                                {{-- No pop-up. --}}
                                                @if (config('app.gSystemConfig.configImagePopup') === 0)
                                                    <img src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $usersRow['image_main'] . '?v=' . $cacheClear }}"
                                                        alt="{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($usersRow['title'], 'db') }}"
                                                        class="ss-backend-images-listing" />
                                                @endif

                                                {{-- GLightbox. --}}
                                                @if (config('app.gSystemConfig.configImagePopup') === 4)
                                                    <a href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/g' . $usersRow['image_main'] . '?v=' . $cacheClear }}"
                                                        title="{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($usersRow['title'], 'db') }}"
                                                        class="glightbox_users_image_main{{ $usersRow['id'] }}"
                                                        data-glightbox="title:{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($usersRow['title'], 'db') }};">

                                                        <img src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $usersRow['image_main'] . '?v=' . $cacheClear }}"
                                                            alt="{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($usersRow['title'], 'db') }}"
                                                            class="ss-backend-images-listing" />
                                                    </a>
                                                    <script>
                                                        /*
                                                        let lightboxDescription = GLightbox({
                                                            loop: false,
                                                            autoplayVideos: true,
                                                            openEffect: "fade", // zoom, fade, none
                                                            slideEffect: "slide", // slide, fade, zoom, none
                                                            moreText: "+", // More text for descriptions on mobile devices.
                                                            touchNavigation: true,
                                                            descPosition: "bottom", // Global position for slides description, you can define a specific position on each slide (bottom, top, left, right).
                                                            selector: "glightbox_users_image_main"
                                                        });
                                                        */

                                                        gLightboxBackendConfigOptions.selector = "glightbox_users_image_main{{ $usersRow['id'] }}";
                                                        // Note: With ID in the selector, will open individual pop-ups. Without id (same class name in all links) will enable scroll.
                                                        // data-glightbox="title: Title example.; description: Description example."
                                                        let glightboxUsersImageMain{{ $usersRow['id'] }} = GLightbox(gLightboxBackendConfigOptions);
                                                    </script>
                                                @endif
                                            @endif


                                        </td>
                                    @endif

                                    <td style="text-align: left;">
                                        {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($usersRow['name_full'], 'db') }}
                                        <div>
                                            @if (config('app.gSystemConfig.enableUsersUsername') === 1)
                                                <strong>
                                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersUsername') }}:
                                                </strong>

                                                {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($usersRow['username'], 'db') }}
                                            @endif

                                            @if (config('app.gSystemConfig.enableUsersEmail') === 1)
                                                <strong>
                                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemEmail') }}:
                                                </strong>

                                                {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($usersRow['email'], 'db') }}
                                            @endif


                                            <strong>
                                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemPassword') }}:
                                            </strong>

                                            {{ \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($usersRow['password'], 'db'), SS_ENCRYPT_METHOD_DATA) }}
                                        </div>
                                    </td>

                                    @if (config('app.gSystemConfig.enableUsersNameFirst') === 1)
                                        <td style="text-align: center;">
                                            {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($usersRow['name_first'], 'db') }}
                                        </td>
                                    @endif

                                    <td style="text-align: center;">

                                    </td>

                                    <td id="formUsersListing_elementActivation{{ $usersRow['id'] }}" style="text-align: center;" class="{{ $usersRow['activation'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                        <a id="linkActivation{{ $usersRow['id'] }}" class="ss-backend-links01"
                                            onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                      ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteBackendRecords') }}/',
                                                                                {
                                                                                    idRecord: '{{ $usersRow['id'] }}',
                                                                                    strTable: '{{ config('app.gSystemConfig.configSystemDBTableUsers') }}',
                                                                                    strField:'activation',
                                                                                    recordValue: '{{ $usersRow['activation'] === 1 ? 0 : 1 }}',
                                                                                    patchType: 'toggleValue',
                                                                                    ajaxFunction: true,
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                                },
                                                                                async function(_resObjReturn) {
                                                                                    // alert(JSON.stringify(_resObjReturn));

                                                                                    // if (_resObjReturn.objReturn.returnStatus === true) { // For some reason, the promise object is returning without an object inside.
                                                                                    if (_resObjReturn.returnStatus === true) {
                                                                                        // alert('returnStatus=', true);

                                                                                        // Check status.
                                                                                        if (_resObjReturn.recordUpdatedValue === '0') {
                                                                                            // Change cell color.
                                                                                            elementCSSAdd('formUsersListing_elementActivation{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkActivation{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                        }

                                                                                        if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                            // Change cell color.
                                                                                            elementCSSRemove('formUsersListing_elementActivation{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkActivation{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
                                                                                        }

                                                                                        // Success message.
                                                                                        elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage11') }}');

                                                                                    } else {
                                                                                        // Show error.
                                                                                        elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessageAPI2e') }}');
                                                                                    }

                                                                                    // Hide ajax progress bar.
                                                                                    htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                });">
                                            {{ $usersRow['activation'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                        </a>
                                    </td>

                                    @if (config('app.gSystemConfig.enableUsersActivation1') === 1)
                                        <td id="formUsersListing_elementActivation1{{ $usersRow['id'] }}" style="text-align: center;" class="{{ $usersRow['activation1'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation1{{ $usersRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteBackendRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $usersRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableUsers') }}',
                                                                                        strField:'activation1',
                                                                                        recordValue: '{{ $usersRow['activation1'] === 1 ? 0 : 1 }}',
                                                                                        patchType: 'toggleValue',
                                                                                        ajaxFunction: true,
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                                    },
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));

                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formUsersListing_elementActivation1{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation1{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formUsersListing_elementActivation1{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation1{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $usersRow['activation1'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableUsersActivation2') === 1)
                                        <td id="formUsersListing_elementActivation2{{ $usersRow['id'] }}" style="text-align: center;" class="{{ $usersRow['activation2'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation2{{ $usersRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteBackendRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $usersRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableUsers') }}',
                                                                                        strField:'activation2',
                                                                                        recordValue: '{{ $usersRow['activation2'] === 1 ? 0 : 1 }}',
                                                                                        patchType: 'toggleValue',
                                                                                        ajaxFunction: true,
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                                    },
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));

                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formUsersListing_elementActivation2{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation2{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formUsersListing_elementActivation2{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation2{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $usersRow['activation2'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableUsersActivation3') === 1)
                                        <td id="formUsersListing_elementActivation3{{ $usersRow['id'] }}" style="text-align: center;" class="{{ $usersRow['activation3'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation3{{ $usersRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteBackendRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $usersRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableUsers') }}',
                                                                                        strField:'activation3',
                                                                                        recordValue: '{{ $usersRow['activation3'] === 1 ? 0 : 1 }}',
                                                                                        patchType: 'toggleValue',
                                                                                        ajaxFunction: true,
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                                    },
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));

                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formUsersListing_elementActivation3{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation3{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formUsersListing_elementActivation3{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation3{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $usersRow['activation3'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableUsersActivation4') === 1)
                                        <td id="formUsersListing_elementActivation4{{ $usersRow['id'] }}" style="text-align: center;" class="{{ $usersRow['activation4'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation4{{ $usersRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteBackendRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $usersRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableUsers') }}',
                                                                                        strField:'activation4',
                                                                                        recordValue: '{{ $usersRow['activation4'] === 1 ? 0 : 1 }}',
                                                                                        patchType: 'toggleValue',
                                                                                        ajaxFunction: true,
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                                    },
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));

                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formUsersListing_elementActivation4{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation4{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formUsersListing_elementActivation4{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation4{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $usersRow['activation4'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableUsersActivation5') === 1)
                                        <td id="formUsersListing_elementActivation5{{ $usersRow['id'] }}" style="text-align: center;" class="{{ $usersRow['activation5'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation5{{ $usersRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteBackendRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $usersRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableUsers') }}',
                                                                                        strField:'activation5',
                                                                                        recordValue: '{{ $usersRow['activation5'] === 1 ? 0 : 1 }}',
                                                                                        patchType: 'toggleValue',
                                                                                        ajaxFunction: true,
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                                    },
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));

                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formUsersListing_elementActivation5{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation5{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formUsersListing_elementActivation5{{ $usersRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation5{{ $usersRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $usersRow['activation5'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    <td style="text-align: center;">
                                        <a href="/{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/' . $usersRow['id'] . '/?' . $queryDefault }}" class="ss-backend-links01">
                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemEdit') }}
                                        </a>
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" name="idsRecordsDelete[]" value="{{ $usersRow['id'] }}" class="ss-backend-field-checkbox" />
                                        <!--input type="checkbox" name="idsRecordsDelete" value="{{ $usersRow['id'] }}" class="ss-backend-field-checkbox" /-->
                                        <!--input type="checkbox" name="arrIdsRecordsDelete" value="${usersRow.id}" class="ss-backend-field-checkbox" /-->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot class="ss-backend-table-foot ss-backend-table-listing-text01" style="display: none;">
                            <tr>
                                <td style="text-align: left;">

                                </td>
                                <td style="text-align: center;">

                                </td>
                                <td style="text-align: center;">

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


                {{-- Pagination. --}}
                {{-- ---------------------- --}}
                @if (config('app.gSystemConfig.enableUsersBackendPagination') === 1)
                    <div class="ss-backend-paging" style="position: relative; display: block; overflow: hidden; text-align: center;">
                        {{-- Page numbers. --}}
                        @if (config('app.gSystemConfig.enableUsersBackendPaginationNumbering') === 1)
                            <div class="ss-backend-paging-number-link-a" style="position: relative; display: block; overflow: hidden;">
                                @for ($pageNumberOutput = 0; $pageNumberOutput <  $_pagingTotal; $pageNumberOutput++)
                                    @if ($pageNumberOutput + 1 === $_pageNumber)
                                        {{ $pageNumberOutput + 1 }}
                                    @else
                                        <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $idParent . '?pageNumber=' . $pageNumberOutput + 1 }}" title="{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingPageCounter01') . ' ' . $pageNumberOutput + 1 }}" class="ss-backend-paging-number-link">
                                            {{ $pageNumberOutput + 1 }}
                                        </a>
                                    @endif
                                @endfor
                            </div>
                        @endif

                        {{-- Page controls. --}}
                        {{-- TODO: optimize this logic. --}}
                        {{-- TODO: evaluate slash before ?. --}}
                        {{-- TODO: evaluate slash URL (for everything  / change node version to match). --}}
                        {{-- NOTE: $idParent used to be $_idParent - re-aveluate.  --}}
                        <div style="position: relative; display: block; overflow: hidden;">
                            @if ($_pageNumber === 1)
                                <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $idParent . '?pageNumber=1' }}" title="{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingFirst') }}" class="ss-backend-paging-btn" style="visibility: hidden;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingFirst') }}
                                </a>
                                <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $idParent . '?pageNumber=' . (int) $_pageNumber - 1 }}" title="{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingPrevious') }}" class="ss-backend-paging-btn" style="visibility: hidden;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingPrevious') }}
                                </a>
                            @else
                                <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $idParent . '?pageNumber=1' }}" title="{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingFirst') }}" class="ss-backend-paging-btn">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingFirst') }}
                                </a>
                                <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $idParent . '?pageNumber=' . (int) $_pageNumber - 1 }}" title="{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingPrevious') }}" class="ss-backend-paging-btn">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingPrevious') }}
                                </a>
                            @endif

                            @if ($_pageNumber === $_pagingTotal)
                                <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $idParent . '?pageNumber=' . (int) $_pageNumber + 1 }}" title="{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingNext') }}" class="ss-backend-paging-btn" style="visibility: hidden;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingNext') }}
                                </a>
                                <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $idParent . '?pageNumber=' . $_pagingTotal }}" title="{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingLast') }}" class="ss-backend-paging-btn" style="visibility: hidden;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingLast') }}
                                </a>
                            @else
                                <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $idParent . '?pageNumber=' . (int) $_pageNumber + 1 }}" title="{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingNext') }}" class="ss-backend-paging-btn">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingNext') }}
                                </a>
                                <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $idParent . '?pageNumber=' . $_pagingTotal }}" title="{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingLast') }}" class="ss-backend-paging-btn">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendPagingLast') }}
                                </a>
                            @endif
                        </div>

                        <div style="position: relative; display: block; overflow: hidden;">
                            {{ $_pageNumber }} / {{ $_pagingTotal }}
                        </div>
                    </div>
                @endif
                {{-- ---------------------- --}}
            </form>
        @endif
    </section>

    {{-- Form. --}}
    <section class="ss-backend-layout-section-form01">
        <form
            id="formUsers"
            name="formUsers"
            method="POST"
            action="/{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') }}"
            enctype="multipart/form-data"
        >
            @csrf

            <div style="position: relative; display: block; overflow: hidden;">
                <script>
                    // Debug.
                    // webpackDebugTest(); // webpack debug

                    // Reorder table rows.
                    // TODO: Create variable in config to enable it.
                    document.addEventListener('DOMContentLoaded', () => {

                        inputDataReorder([{{ implode(',', config('app.gSystemConfig.configUsersInputOrder')) }}]); // necessary to map the array in order to display as an array inside template literals

                    }, false);
                </script>

                <table id="input_table_users" class="ss-backend-table-input01">
                    <caption class="ss-backend-table-header-text01 ss-backend-table-title">
                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersTitleTable') }}
                    </caption>
                    <thead class="ss-backend-table-bg-dark ss-backend-table-header-text01">

                    </thead>
                    <tbody class="ss-backend-table-listing-text01">
                        @if (config('app.gSystemConfig.enableUsersSortOrder') === 1)
                            <tr id="inputRowUsers_sort_order" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemSortOrder') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_sort_order" name="sort_order" class="ss-backend-field-numeric01" maxlength="10" value="0" />
                                    <script>
                                        Inputmask(inputmaskGenericBackendConfigOptions).mask("users_sort_order");
                                    </script>
                                </td>
                            </tr>
                        @endif


                        @if (config('app.gSystemConfig.enableUsersNameFull') === 1)
                            <tr id="inputRowUsers_name_full" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersNameFull') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_name_full" name="name_full" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif
                        @if (config('app.gSystemConfig.enableUsersNameFirst') === 1)
                            <tr id="inputRowUsers_name_first" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersNameFirst') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_name_first" name="name_first" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif
                        @if (config('app.gSystemConfig.enableUsersNameLast') === 1)
                            <tr id="inputRowUsers_name_last" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersNameLast') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_name_last" name="name_last" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersDateBirth') !== 0)
                        <tr id="inputRowUsers_date_birth" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDateBirth') }}:
                            </td>
                            <td>
                                {{-- Dropdown menu. --}}
                                @if (config('app.gSystemConfig.configUsersDateBirth') === 2)
                                    @if (config('app.gSystemConfig.configBackendDateFormat') === 1)
                                        <select id="users_date_birth_day" name="date_birth_day" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => 4]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        /
                                        <select id="users_date_birth_month" name="date_birth_month" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => 4]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        /
                                        <select id="users_date_birth_year" name="date_birth_year" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => 4]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select id="users_date_birth_month" name="date_birth_month" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => 4]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        /
                                        <select id="users_date_birth_day" name="date_birth_day" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => 4]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        /
                                        <select id="users_date_birth_year" name="date_birth_year" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => 4]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                @endif

                                {{-- js-datepicker. --}}
                                @if (config('app.gSystemConfig.configUsersDateBirth') === 11)
                                    <input type="text" id="users_date_birth" name="date_birth" class="ss-backend-field-date01" autocomplete="off" value="" />
                                    <script>
                                        const dpDate1 = datepicker("#users_date_birth", jsDatepickerBirthBackendConfigOptions);
                                    </script>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if (config('app.gSystemConfig.enableUsersGender') === 1)
                        <tr id="inputRowUsers_gender" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemGender') }}:
                            </td>
                            <td>
                                <label class="ss-backend-field-radio-label">
                                    <input type="radio" name="gender" checked value="0" class="ss-backend-field-radio" />
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemGender0') }}:
                                </label>
                                <label class="ss-backend-field-radio-label">
                                    <input type="radio" name="gender" value="1" class="ss-backend-field-radio" />
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemGender1') }}:
                                </label>
                                <label class="ss-backend-field-radio-label">
                                    <input type="radio" name="gender" value="2" class="ss-backend-field-radio" />
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemGender2') }}:
                                </label>
                            </td>
                        </tr>
                        @endif
                        @if (config('app.gSystemConfig.enableUsersDocument') === 1)
                            <tr id="inputRowUsers_document" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersDocument') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_document" name="document" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersAddress') === 1)
                            <tr id="inputRowUsers_address_street" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressStreet') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_address_street" name="address_street" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_address_number" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressNumber') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_address_number" name="address_number" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_address_complement" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressComplement') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_address_complement" name="address_complement" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_neighborhood" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressNeighborhood') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_neighborhood" name="neighborhood" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_district" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressDistrict') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_district" name="district" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_county" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressCounty') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_county" name="county" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_city" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressCity') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_city" name="city" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_state" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressState') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_state" name="state" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_country" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressCountry') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_country" name="country" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_zip_code" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressZipCode') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_zip_code" name="zip_code" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersPhone1') === 1)
                            <tr id="inputRowUsers_phone1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersPhone1') }}:
                                </td>
                                <td>
                                    @if (config('app.gSystemConfig.enableUsersPhoneInternationalCode') === 1)
                                        +<input type="text" id="users_phone1_international_code" name="phone1_international_code" class="ss-backend-field-tel-ac01" maxlength="3" value="" />
                                    @endif
                                    (<input type="text" id="users_phone1_area_code" name="phone1_area_code" class="ss-backend-field-tel-ac01" maxlength="10" value="" />)
                                    <input type="text" id="users_phone1" name="phone1" class="ss-backend-field-tel01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif
                        @if (config('app.gSystemConfig.enableUsersPhone2') === 1)
                            <tr id="inputRowUsers_phone2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersPhone2') }}:
                                </td>
                                <td>
                                    @if (config('app.gSystemConfig.enableUsersPhoneInternationalCode') === 1)
                                        +<input type="text" id="users_phone2_international_code" name="phone2_international_code" class="ss-backend-field-tel-ac01" maxlength="3" value="" />
                                    @endif
                                    (<input type="text" id="users_phone2_area_code" name="phone2_area_code" class="ss-backend-field-tel-ac01" maxlength="10" value="" />)
                                    <input type="text" id="users_phone2" name="phone2" class="ss-backend-field-tel01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif
                        @if (config('app.gSystemConfig.enableUsersPhone3') === 1)
                            <tr id="inputRowUsers_phone3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersPhone3') }}:
                                </td>
                                <td>
                                    @if (config('app.gSystemConfig.enableUsersPhoneInternationalCode') === 1)
                                        +<input type="text" id="users_phone3_international_code" name="phone3_international_code" class="ss-backend-field-tel-ac01" maxlength="3" value="" />
                                    @endif
                                    (<input type="text" id="users_phone3_area_code" name="phone3_area_code" class="ss-backend-field-tel-ac01" maxlength="10" value="" />)
                                    <input type="text" id="users_phone3" name="phone3" class="ss-backend-field-tel01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersUsername') === 1)
                            <tr id="inputRowUsers_username" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersUsername') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_username" name="username" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersEmail') === 1)
                            <tr id="inputRowUsers_email" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemEmail') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_email" name="email" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>
                        @endif

                        <tr id="inputRowUsers_password" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemPassword') }}:
                            </td>
                            <td>
                                <input type="password" id="users_password" name="password" class="ss-backend-field-text01" maxlength="255" value="" />
                            </td>
                        </tr>

                        {{-- Information fields. --}}
                        @if (config('app.gSystemConfig.enableUsersInfo1') === 1)
                            <tr id="inputRowUsers_info1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo1') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo1FieldType') === 1)
                                        <input type="text" id="users_info1" name="info1" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo1FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info1" name="info1" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info1" name="info1" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info1";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo1FieldType') === 11)
                                        <input type="text" id="users_info1" name="info1" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo1FieldType') === 12)
                                        <textarea id="users_info1" name="info1" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersInfo2') === 1)
                            <tr id="inputRowUsers_info2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo2') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo2FieldType') === 1)
                                        <input type="text" id="users_info2" name="info2" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo2FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info2" name="info2" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info2" name="info2" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info2";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo2FieldType') === 11)
                                        <input type="text" id="users_info2" name="info2" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo2FieldType') === 12)
                                        <textarea id="users_info2" name="info2" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersInfo3') === 1)
                            <tr id="inputRowUsers_info3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo3') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo3FieldType') === 1)
                                        <input type="text" id="users_info3" name="info3" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo3FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info3" name="info3" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info3" name="info3" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info3";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo3FieldType') === 11)
                                        <input type="text" id="users_info3" name="info3" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo3FieldType') === 12)
                                        <textarea id="users_info3" name="info3" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersInfo4') === 1)
                            <tr id="inputRowUsers_info4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo4') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo4FieldType') === 1)
                                        <input type="text" id="users_info4" name="info4" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo4FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info4" name="info4" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info4" name="info4" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info4";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo4FieldType') === 11)
                                        <input type="text" id="users_info4" name="info4" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo4FieldType') === 12)
                                        <textarea id="users_info4" name="info4" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersInfo5') === 1)
                            <tr id="inputRowUsers_info5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo5') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo5FieldType') === 1)
                                        <input type="text" id="users_info5" name="info5" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo5FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info5" name="info5" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info5" name="info5" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info5";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo5FieldType') === 11)
                                        <input type="text" id="users_info5" name="info5" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo5FieldType') === 12)
                                        <textarea id="users_info5" name="info5" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersInfo6') === 1)
                            <tr id="inputRowUsers_info6" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo6') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo6FieldType') === 1)
                                        <input type="text" id="users_info6" name="info6" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo6FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info6" name="info6" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info6" name="info6" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info6";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo6FieldType') === 11)
                                        <input type="text" id="users_info6" name="info6" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo6FieldType') === 12)
                                        <textarea id="users_info6" name="info6" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersInfo7') === 1)
                            <tr id="inputRowUsers_info7" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo7') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo7FieldType') === 1)
                                        <input type="text" id="users_info7" name="info7" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo7FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info7" name="info7" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info7" name="info7" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info7";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo7FieldType') === 11)
                                        <input type="text" id="users_info7" name="info7" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo7FieldType') === 12)
                                        <textarea id="users_info7" name="info7" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersInfo8') === 1)
                            <tr id="inputRowUsers_info8" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo8') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo8FieldType') === 1)
                                        <input type="text" id="users_info8" name="info8" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo8FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info8" name="info8" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info8" name="info8" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info8";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo8FieldType') === 11)
                                        <input type="text" id="users_info8" name="info8" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo8FieldType') === 12)
                                        <textarea id="users_info8" name="info8" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersInfo9') === 1)
                            <tr id="inputRowUsers_info9" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo9') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo9FieldType') === 1)
                                        <input type="text" id="users_info9" name="info9" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo9FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info9" name="info9" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info9" name="info9" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info9";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo9FieldType') === 11)
                                        <input type="text" id="users_info9" name="info9" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo9FieldType') === 12)
                                        <textarea id="users_info9" name="info9" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersInfo10') === 1)
                            <tr id="inputRowUsers_info10" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersInfo10') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo10FieldType') === 1)
                                        <input type="text" id="users_info10" name="info10" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo10FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info10" name="info10" class="ss-backend-field-text-area01"></textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info10" name="info10" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info10";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo10FieldType') === 11)
                                        <input type="text" id="users_info10" name="info10" class="ss-backend-field-text01" value="" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo10FieldType') === 12)
                                        <textarea id="users_info10" name="info10" class="ss-backend-field-text-area01"></textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersImageMain') === 1)
                            <tr id="inputRowUsers_image_main" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemImage') }}:
                                </td>
                                <td>
                                    <input type="file" id="users_image_main" name="image_main" class="ss-backend-field-file-upload" />
                                </td>
                            </tr>
                        @endif

                        <tr id="inputRowUsers_activation" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation') }}:
                            </td>
                            <td>
                                <select id="users_activation" name="activation" class="ss-backend-field-dropdown01">
                                    <option value="1" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                    <option value="0">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                </select>
                            </td>
                        </tr>

                        @if (config('app.gSystemConfig.enableUsersActivation1') === 1)
                            <tr id="inputRowUsers_activation1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation1') }}:
                                </td>
                                <td>
                                    <select id="users_activation1" name="activation1" class="ss-backend-field-dropdown01">
                                        <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersActivation2') === 1)
                            <tr id="inputRowUsers_activation2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation2') }}:
                                </td>
                                <td>
                                    <select id="users_activation2" name="activation2" class="ss-backend-field-dropdown01">
                                        <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersActivation3') === 1)
                            <tr id="inputRowUsers_activation3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation3') }}:
                                </td>
                                <td>
                                    <select id="users_activation3" name="activation3" class="ss-backend-field-dropdown01">
                                        <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersActivation4') === 1)
                            <tr id="inputRowUsers_activation4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation4') }}:
                                </td>
                                <td>
                                    <select id="users_activation4" name="activation4" class="ss-backend-field-dropdown01">
                                        <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersActivation5') === 1)
                            <tr id="inputRowUsers_activation5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersActivation5') }}:
                                </td>
                                <td>
                                    <select id="users_activation5" name="activation5" class="ss-backend-field-dropdown01">
                                        <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersNotes') === 1)
                            <tr id="inputRowUsers_notes" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemNotesInternal') }}:
                                </td>
                                <td>
                                    <textarea id="users_notes" name="notes" class="ss-backend-field-text-area01"></textarea>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot class="ss-backend-table-foot ss-backend-table-listing-text01">

                    </tfoot>
                </table>

            </div>
            <div style="position: relative; display: block; overflow: hidden; clear: both; margin-top: 2px;">
                <button id="users_include" name="users_include" class="ss-backend-btn-base ss-backend-btn-action-execute" style="float: left;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendButtonSend') }}
                </button>
            </div>

            <input type="hidden" id="users_id_parent" name="id_parent" value="{{ $idParent }}" />
            <input type="hidden" id="users_id_type" name="id_type" value="1" />
            <input type="hidden" id="users_name_title" name="name_title" value="" />
            <input type="hidden" id="users_id_status" name="id_status" value="0" />

            <input type="hidden" id="users_idParent" name="idParent" value="{{ $idParent }}" />
            <input type="hidden" id="users_pageNumber" name="pageNumber" value="{{ $pageNumber }}" />
            <input type="hidden" id="users_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />
        </form>
    </section>
@endsection
