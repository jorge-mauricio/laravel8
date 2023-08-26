@php
    // Variables.
    $filterIndex = $templateData['filterIndex'];
    $tableName = $templateData['tableName'];

    $filtersGenericLabelIndex = ''; // Optimize to show the right label.
    $filtersGenericLabelModule = ''; // Optimize to show the right label.

    $titleCurrent = $templateData['cphTitleCurrent'];
    $arrFiltersGenericListing = $templateData['cphBody']['arrFiltersGenericListing'];

    // Meta title.
    $metaTitle = '';
    $metaTitle .= \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitleMain');
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
    $metaURLCurrent .= config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/';
    $metaURLCurrent .= '?filterIndex=' . $filterIndex;
    $metaURLCurrent .= '&tableName=' . $tableName;
    // if ($masterPageSelect !== '') {
        $metaURLCurrent .= '&masterPageSelect=' . $masterPageSelect;
    // }

    // Define values.
    // ----------------------
    if (strlen($filterIndex) >= 3) {
      $filtersGenericLabelIndex = substr(1, -1, (string) $filterIndex); // Delete the first number.
      $filtersGenericLabelIndex = (string) ((int) $filtersGenericLabelIndex); // Convert to int and back to string.
    }

    // Filters generic label module.
    if ($tableName == config('app.gSystemConfig.configSystemDBTableCategories')) {
      $filtersGenericLabelModule = 'Categories';
    }
    if ($tableName == config('app.gSystemConfig.configSystemDBTableProducts')) {
      $filtersGenericLabelModule = 'Products';
    }
    if ($tableName == config('app.gSystemConfig.configSystemDBTablePublications')) {
      $filtersGenericLabelModule = 'Publications';
    }
    // ----------------------
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
    <meta property="og:type" content="website" />{{-- http://ogp.me/#types | https:// developers.facebook.com/docs/reference/opengraph/ --}}
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

    {{-- @dump($templateData) --}}

    <section class="ss-backend-layout-section-data01">
        @if (count($arrFiltersGenericListing) < 1)
            <div class="ss-backend-alert ss-backend-layout-div-records-empty">
                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage1') }}
            </div>
        @else
            {{-- TODO: create css class for this part. --}}
            <div style="position: relative; display: block; overflow: hidden; margin-bottom: 2px;">
                {{-- onclick="elementMessage01('formCategoriesListing_method', 'DELETE');
                            formSubmit('formCategoriesListing', '', '', '/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/?_method=DELETE');
                            "--}}

                <button
                    id="filters_generic_delete"
                    name="filters_generic_delete"
                    onclick="elementMessage01('formFiltersGenericListing_method', 'DELETE');
                            formSubmit('formFiltersGenericListing', '', '', '/{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendRecords') }}/?_method=DELETE');
                            "
                    class="ss-backend-btn-base ss-backend-btn-action-cancel"
                    style="float: right;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDelete') }}
                </button>
            </div>

            <form
                id="formFiltersGenericListing"
                name="formFiltersGenericListing"
                method="POST"
                action=""
                enctype="application/x-www-form-urlencoded"
            >
                @csrf

                <input type="hidden" id="formFiltersGenericListing_method" name="_method" value="">

                <input type="hidden" id="formFiltersGenericListing_strTable" name="strTable" value="{{ config('app.gSystemConfig.configSystemDBTableFiltersGeneric') }}" />

                <input type="hidden" id="formFiltersGenericListing_tableName" name="tableName" value="{{ $tableName }}" />
                <input type="hidden" id="formFiltersGenericListing_filterIndex" name="filterIndex" value="{{ $filterIndex }}" />
                <input type="hidden" id="formFiltersGenericListing_pageReturn" name="pageReturn" value="{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') }}" />
                <input type="hidden" id="formFiltersGenericListing_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />

                {{-- TODO: create css class for this part. --}}
                <div style="position: relative; display: block; overflow: hidden;">
                    <table class="ss-backend-table-listing01">
                        <caption class="ss-backend-table-header-text01 ss-backend-table-title">
                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitleMain') }}
                            -
                            @if ($filtersGenericLabelIndex !== '')
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backend' . $filtersGenericLabelModule . 'FilterGeneric' . $filtersGenericLabelIndex) }}
                            @endif

                            @if ($filterIndex === '1')
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backend' . $filtersGenericLabelModule . 'Type') }}
                            @endif

                            @if ($filterIndex === '2')
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backend' . $filtersGenericLabelModule . 'Status') }}
                            @endif
                        </caption>

                        <thead class="ss-backend-table-bg-dark ss-backend-table-header-text01">
                            <tr>
                                <td style="width: 40px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemID') }}
                                </td>

                                @if (config('app.gSystemConfig.enableFiltersGenericSortOrder') === 1)
                                    <td style="width: 40px; text-align: left;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemSortOrderA') }}
                                    </td>
                                @endif

                                @if (config('app.gSystemConfig.enableFiltersGenericImageMain') === 1)
                                    <td style="width: 100px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemImage') }}
                                    </td>
                                @endif

                                <td style="text-align: left;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitle') }}
                                </td>

                                @if (config('app.gSystemConfig.enableFiltersGenericConfigSelection') === 1)
                                    <td style="width: 100px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemFunctions') }}
                                    </td>
                                @endif

                                <td style="width: 40px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivationA') }}
                                </td>
                                @if (config('app.gSystemConfig.enableFiltersGenericActivation1') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation1') }}
                                    </td>
                                @endif
                                @if (config('app.gSystemConfig.enableFiltersGenericActivation2') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation2') }}
                                    </td>
                                @endif
                                @if (config('app.gSystemConfig.enableFiltersGenericActivation3') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation3') }}
                                    </td>
                                @endif
                                @if (config('app.gSystemConfig.enableFiltersGenericActivation4') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation4') }}
                                    </td>
                                @endif
                                @if (config('app.gSystemConfig.enableFiltersGenericActivation5') === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation5') }}
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
                            @foreach ($arrFiltersGenericListing as $filtersGenericRow)
                                <tr class="ss-backend-table-bg-light">
                                    <td style="text-align: center;">
                                        {{ $filtersGenericRow['id'] }}
                                    </td>

                                    @if (config('app.gSystemConfig.enableFiltersGenericSortOrder') === 1)
                                        <td style="text-align: center;">
                                            {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($filtersGenericRow['sort_order'], '', 3, null) }}
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableFiltersGenericImageMain') === 1)
                                        <td style="text-align: center;">
                                            @if ((string) $filtersGenericRow['image_main'] !== '')
                                                {{-- No pop-up. --}}
                                                @if (config('app.gSystemConfig.configImagePopup') === 0)
                                                    <img src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $filtersGenericRow['image_main'] . '?v=' . $cacheClear }}"
                                                        alt="{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($filtersGenericRow['title'], 'db') }}"
                                                        class="ss-backend-images-listing" />
                                                @endif

                                                {{-- GLightbox. --}}
                                                @if (config('app.gSystemConfig.configImagePopup') === 4)
                                                    <a href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/g' . $filtersGenericRow['image_main'] . '?v=' . $cacheClear }}"
                                                        title="{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($filtersGenericRow['title'], 'db') }}"
                                                        class="glightbox_filters_generic_image_main{{ $filtersGenericRow['id'] }}"
                                                        data-glightbox="title:{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($filtersGenericRow['title'], 'db') }};">

                                                        <img src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $filtersGenericRow['image_main'] . '?v=' . $cacheClear }}"
                                                            alt="{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($filtersGenericRow['title'], 'db') }}"
                                                            class="ss-backend-images-listing" />
                                                    </a>
                                                    <script>
                                                        gLightboxBackendConfigOptions.selector = "glightbox_filters_generic_image_main{{ $filtersGenericRow['id'] }}";
                                                        // Note: With ID in the selector, will open individual pop-ups. Without id (same class name in all links) will enable scroll.
                                                        // data-glightbox="title: Title example.; description: Description example."
                                                        let glightboxFiltersGenericImageMain{{ $filtersGenericRow['id'] }} = GLightbox(gLightboxBackendConfigOptions);
                                                    </script>
                                                @endif
                                            @endif
                                        </td>
                                    @endif

                                    <td style="text-align: left;">
                                        {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($filtersGenericRow['title'], 'db') }}
                                    </td>

                                    @if (config('app.gSystemConfig.enableFiltersGenericConfigSelection') === 1)
                                        <td style="text-align: center;">

                                        </td>
                                    @endif

                                    <td id="formFiltersGenericListing_elementActivation{{ $filtersGenericRow['id'] }}" style="text-align: center;" class="{{ $filtersGenericRow['activation'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                        <a id="linkActivation{{ $filtersGenericRow['id'] }}" class="ss-backend-links01"
                                            onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                      ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                                {
                                                                                    idRecord: '{{ $filtersGenericRow['id'] }}',
                                                                                    strTable: '{{ config('app.gSystemConfig.configSystemDBTableFiltersGeneric') }}',
                                                                                    strField:'activation',
                                                                                    recordValue: '{{ $filtersGenericRow['activation'] === 1 ? 0 : 1 }}',
                                                                                    patchType: 'toggleValue',
                                                                                    ajaxFunction: true,
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                                },
                                                                                async function(_resObjReturn) {
                                                                                    // alert(JSON.stringify(_resObjReturn));

                                                                                    if (_resObjReturn.returnStatus === true) {
                                                                                        // alert('returnStatus=', true);

                                                                                        // Check status.
                                                                                        if (_resObjReturn.recordUpdatedValue === '0') {
                                                                                            // Change cell color.
                                                                                            elementCSSAdd('formFiltersGenericListing_elementActivation{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkActivation{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                        }

                                                                                        if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                            // Change cell color.
                                                                                            elementCSSRemove('formFiltersGenericListing_elementActivation{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkActivation{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
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
                                            {{ $filtersGenericRow['activation'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                        </a>
                                    </td>

                                    @if (config('app.gSystemConfig.enableFiltersGenericActivation1') === 1)
                                        <td id="formFiltersGenericListing_elementActivation1{{ $filtersGenericRow['id'] }}" style="text-align: center;" class="{{ $filtersGenericRow['activation1'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation1{{ $filtersGenericRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $filtersGenericRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableFiltersGeneric') }}',
                                                                                        strField:'activation1',
                                                                                        recordValue: '{{ $filtersGenericRow['activation1'] === 1 ? 0 : 1 }}',
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
                                                                                                elementCSSAdd('formFiltersGenericListing_elementActivation1{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation1{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formFiltersGenericListing_elementActivation1{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation1{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
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
                                                {{ $filtersGenericRow['activation1'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableFiltersGenericActivation2') === 1)
                                        <td id="formFiltersGenericListing_elementActivation2{{ $filtersGenericRow['id'] }}" style="text-align: center;" class="{{ $filtersGenericRow['activation2'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation2{{ $filtersGenericRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $filtersGenericRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableFiltersGeneric') }}',
                                                                                        strField:'activation2',
                                                                                        recordValue: '{{ $filtersGenericRow['activation2'] === 1 ? 0 : 1 }}',
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
                                                                                                elementCSSAdd('formFiltersGenericListing_elementActivation2{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation2{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formFiltersGenericListing_elementActivation2{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation2{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
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
                                                {{ $filtersGenericRow['activation2'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableFiltersGenericActivation3') === 1)
                                        <td id="formFiltersGenericListing_elementActivation3{{ $filtersGenericRow['id'] }}" style="text-align: center;" class="{{ $filtersGenericRow['activation3'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation3{{ $filtersGenericRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $filtersGenericRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableFiltersGeneric') }}',
                                                                                        strField:'activation3',
                                                                                        recordValue: '{{ $filtersGenericRow['activation3'] === 1 ? 0 : 1 }}',
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
                                                                                                elementCSSAdd('formFiltersGenericListing_elementActivation3{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation3{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formFiltersGenericListing_elementActivation3{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation3{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
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
                                                {{ $filtersGenericRow['activation3'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableFiltersGenericActivation4') === 1)
                                        <td id="formFiltersGenericListing_elementActivation4{{ $filtersGenericRow['id'] }}" style="text-align: center;" class="{{ $filtersGenericRow['activation4'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation4{{ $filtersGenericRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $filtersGenericRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableFiltersGeneric') }}',
                                                                                        strField:'activation4',
                                                                                        recordValue: '{{ $filtersGenericRow['activation4'] === 1 ? 0 : 1 }}',
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
                                                                                                elementCSSAdd('formFiltersGenericListing_elementActivation4{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation4{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formFiltersGenericListing_elementActivation4{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation4{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
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
                                                {{ $filtersGenericRow['activation4'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    @if (config('app.gSystemConfig.enableFiltersGenericActivation5') === 1)
                                        <td id="formFiltersGenericListing_elementActivation5{{ $filtersGenericRow['id'] }}" style="text-align: center;" class="{{ $filtersGenericRow['activation5'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation5{{ $filtersGenericRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                                    {
                                                                                        idRecord: '{{ $filtersGenericRow['id'] }}',
                                                                                        strTable: '{{ config('app.gSystemConfig.configSystemDBTableFiltersGeneric') }}',
                                                                                        strField:'activation5',
                                                                                        recordValue: '{{ $filtersGenericRow['activation5'] === 1 ? 0 : 1 }}',
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
                                                                                                elementCSSAdd('formFiltersGenericListing_elementActivation5{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation5{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formFiltersGenericListing_elementActivation5{{ $filtersGenericRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation5{{ $filtersGenericRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') }}');
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
                                                {{ $filtersGenericRow['activation5'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0A') }}
                                            </a>
                                        </td>
                                    @endif

                                    <td style="text-align: center;">
                                        <a href="/{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/' . $filtersGenericRow['id'] . '/?' . $queryDefault }}" class="ss-backend-links01">
                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemEdit') }}
                                        </a>
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" name="idsRecordsDelete[]" value="{{ $filtersGenericRow['id'] }}" class="ss-backend-field-checkbox" />
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
            </form>
        @endif
    </section>

    @if ((string) $filterIndex !== '' && (string) $tableName !== '')
        {{-- Form. --}}
        <section class="ss-backend-layout-section-form01">
            <form
                id="formFiltersGeneric"
                name="formFiltersGeneric"
                method="POST"
                action="/{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') }}"
                enctype="multipart/form-data"
            >
                @csrf
                <div style="position: relative; display: block; overflow: hidden;">
                    <script>
                        // Reorder table rows.
                        // TODO: Create variable in config to enable it.
                        document.addEventListener('DOMContentLoaded', () => {

                          inputDataReorder([{{ implode(',', config('app.gSystemConfig.configFiltersGenericInputOrder')) }}]); // necessary to map the array in order to display as an array inside template literals

                        }, false);
                    </script>
                    <table id="input_table_filters_generic" class="ss-backend-table-input01">
                        <caption class="ss-backend-table-header-text01 ss-backend-table-title">
                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitleTable') }}
                             -
                            @if ($filtersGenericLabelIndex !== '')
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backend' . $filtersGenericLabelModule . 'FilterGeneric' . $filtersGenericLabelIndex) }}
                            @endif

                            @if ($filterIndex === '1')
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backend' . $filtersGenericLabelModule . 'Type') }}
                            @endif

                            @if ($filterIndex === '2')
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backend' . $filtersGenericLabelModule . 'Status') }}
                            @endif
                        </caption>
                        <thead class="ss-backend-table-bg-dark ss-backend-table-header-text01">

                        </thead>
                        <tbody class="ss-backend-table-listing-text01">
                            @if (config('app.gSystemConfig.enableFiltersGenericSortOrder') === 1)
                                <tr id="inputRowFiltersGeneric_sort_order" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemSortOrder') }}:
                                    </td>
                                    <td>
                                        <input type="text" id="filtersGeneric_sort_order" name="sort_order" class="ss-backend-field-numeric01" maxlength="10" value="0" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_sort_order");
                                        </script>
                                    </td>
                                </tr>
                            @endif

                            <tr id="inputRowFiltersGeneric_title" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitle') }}:
                                </td>
                                <td>
                                    <input type="text" id="inputRowFiltersGeneric_title" name="title" class="ss-backend-field-text01" maxlength="255" value="" />
                                </td>
                            </tr>

                            @if (config('app.gSystemConfig.enableFiltersGenericDescription') === 1)
                                <tr id="inputRowFiltersGeneric_description" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitle') }}:
                                    </td>
                                    <td>
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="filtersGeneric_description" name="description" class="ss-backend-field-text-area01"></textarea>
                                        @endif


                                        {{-- Quill. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 13)
                                            <textarea id="filtersGeneric_description" name="description" class="ss-backend-field-text-area01"></textarea>
                                            <div id="toolbar">
                                                <button class="ql-bold">Bold</button>
                                                <button class="ql-italic">Italic</button>
                                            </div>
                                            <div id="editor">
                                                <p></p>
                                            </div>
                                            <script>
                                                let editor = new Quill('#editor', {
                                                    modules: { toolbar: '#toolbar' },
                                                    theme: 'snow'
                                                });
                                            </script>
                                        @endif


                                        {{-- FroalaEditor. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 15)
                                            <textarea id="filtersGeneric_description" name="description" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                new FroalaEditor("#filtersGeneric_description");
                                            </script>
                                        @endif


                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="filtersGeneric_description" name="description" class="ss-backend-field-text-area01"></textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#filtersGeneric_description";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.configFiltersGenericURLAlias') === 1)
                                <tr id="inputRowFiltersGeneric_url_alias" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemURLAlias') }}:
                                    </td>
                                    <td>
                                        <input type="text" id="filtersGeneric_url_alias" name="url_alias" class="ss-backend-field-text01" value="" />
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericKeywordsTags') === 1)
                                <tr id="inputRowFiltersGeneric_keywords_tags" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemKeywords') }}:
                                    </td>
                                    <td>
                                        <textarea id="filtersGeneric_keywords_tags" name="keywords_tags" class="ss-backend-field-text-area01"></textarea>
                                        <div>
                                            ({{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemKeywordsInstruction01') }})
                                        </div>
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericMetaDescription') === 1)
                                <tr id="inputRowFiltersGeneric_meta_description" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemMetaDescription') }}:
                                    </td>
                                    <td>
                                        <textarea id="filtersGeneric_meta_description" name="meta_description" class="ss-backend-field-text-area01"></textarea>
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericMetaTitle') === 1)
                                <tr id="inputRowFiltersGeneric_meta_title" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemMetaTitle') }}:
                                    </td>
                                    <td>
                                        <input type="text" id="filtersGeneric_meta_title" name="meta_title" class="ss-backend-field-text01" value="" />
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericInfoS1') === 1)
                                <tr id="inputRowFiltersGeneric_info_small1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericInfoS1') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS1FieldType') === 1)
                                            <input type="text" id="filtersGeneric_info_small1" name="info_small1" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS1FieldType') === 2)
                                            {{-- No formatting. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                                <textarea id="filtersGeneric_info_small1" name="info_small1" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                                <textarea id="filtersGeneric_info_small1" name="info_small1" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#filtersGeneric_info_small1";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                         @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericInfoS2') === 1)
                                <tr id="inputRowFiltersGeneric_info_small2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericInfoS2') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS2FieldType') === 1)
                                            <input type="text" id="filtersGeneric_info_small2" name="info_small2" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS2FieldType') === 2)
                                            {{-- No formatting. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                                <textarea id="filtersGeneric_info_small2" name="info_small2" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                                <textarea id="filtersGeneric_info_small2" name="info_small2" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#filtersGeneric_info_small2";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                         @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericInfoS3') === 1)
                                <tr id="inputRowFiltersGeneric_info_small3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericInfoS3') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS3FieldType') === 1)
                                            <input type="text" id="filtersGeneric_info_small3" name="info_small3" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS3FieldType') === 2)
                                            {{-- No formatting. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                                <textarea id="filtersGeneric_info_small3" name="info_small3" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                                <textarea id="filtersGeneric_info_small3" name="info_small3" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#filtersGeneric_info_small3";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                         @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericInfoS4') === 1)
                                <tr id="inputRowFiltersGeneric_info_small4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericInfoS4') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS4FieldType') === 1)
                                            <input type="text" id="filtersGeneric_info_small4" name="info_small4" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS4FieldType') === 2)
                                            {{-- No formatting. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                                <textarea id="filtersGeneric_info_small4" name="info_small4" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                                <textarea id="filtersGeneric_info_small4" name="info_small4" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#filtersGeneric_info_small4";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                         @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericInfoS5') === 1)
                                <tr id="inputRowFiltersGeneric_info_small5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericInfoS5') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS5FieldType') === 1)
                                            <input type="text" id="filtersGeneric_info_small5" name="info_small5" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericInfoS5FieldType') === 2)
                                            {{-- No formatting. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                                <textarea id="filtersGeneric_info_small5" name="info_small5" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                                <textarea id="filtersGeneric_info_small5" name="info_small5" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#filtersGeneric_info_small5";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                         @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericNumberS1') === 1)
                                <tr id="inputRowFiltersGeneric_number_small1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericNumberS1') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS1FieldType') === 1)
                                            <input type="text" id="filtersGeneric_number_small1" name="number_small1" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small1");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS1FieldType') === 2)
                                            {{ config('app.gSystemConfig.configSystemCurrency') }}
                                            <input type="text" id="filtersGeneric_number_small1" name="number_small1" class="ss-backend-field-currency01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("filtersGeneric_number_small1");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericNumberS2') === 1)
                                <tr id="inputRowFiltersGeneric_number_small2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericNumberS2') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS2FieldType') === 1)
                                            <input type="text" id="filtersGeneric_number_small2" name="number_small2" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small2");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS2FieldType') === 2)
                                            {{ config('app.gSystemConfig.configSystemCurrency') }}
                                            <input type="text" id="filtersGeneric_number_small2" name="number_small2" class="ss-backend-field-currency01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("filtersGeneric_number_small2");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericNumberS3') === 1)
                                <tr id="inputRowFiltersGeneric_number_small3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericNumberS3') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS3FieldType') === 1)
                                            <input type="text" id="filtersGeneric_number_small3" name="number_small3" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small3");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS3FieldType') === 2)
                                            {{ config('app.gSystemConfig.configSystemCurrency') }}
                                            <input type="text" id="filtersGeneric_number_small3" name="number_small3" class="ss-backend-field-currency01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("filtersGeneric_number_small3");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericNumberS4') === 1)
                                <tr id="inputRowFiltersGeneric_number_small4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericNumberS4') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS4FieldType') === 1)
                                            <input type="text" id="filtersGeneric_number_small4" name="number_small4" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small4");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS4FieldType') === 2)
                                            {{ config('app.gSystemConfig.configSystemCurrency') }}
                                            <input type="text" id="filtersGeneric_number_small4" name="number_small4" class="ss-backend-field-currency01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("filtersGeneric_number_small4");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericNumberS5') === 1)
                                <tr id="inputRowFiltersGeneric_number_small5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericNumberS5') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS5FieldType') === 1)
                                            <input type="text" id="filtersGeneric_number_small5" name="number_small5" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small5");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if (config('app.gSystemConfig.configFiltersGenericNumberS5FieldType') === 2)
                                            {{ config('app.gSystemConfig.configSystemCurrency') }}
                                            <input type="text" id="filtersGeneric_number_small5" name="number_small5" class="ss-backend-field-currency01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("filtersGeneric_number_small5");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericImageMain') === 1)
                                <tr id="inputRowFiltersGeneric_image_main" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemImage') }}:
                                    </td>
                                    <td>
                                        <input type="file" id="filtersGeneric_image_main" name="image_main" class="ss-backend-field-file-upload" />
                                    </td>
                                </tr>
                            @endif

                            <tr id="inputRowFiltersGeneric_activation" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation') }}:
                                </td>
                                <td>
                                    <select id="filtersGeneric_activation" name="activation" class="ss-backend-field-dropdown01">
                                        <option value="1" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>

                            @if (config('app.gSystemConfig.enableFiltersGenericActivation1') === 1)
                                <tr id="inputRowFiltersGeneric_activation1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation1') }}:
                                    </td>
                                    <td>
                                        <select id="filtersGeneric_activation1" name="activation1" class="ss-backend-field-dropdown01">
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericActivation2') === 1)
                                <tr id="inputRowFiltersGeneric_activation2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation2') }}:
                                    </td>
                                    <td>
                                        <select id="filtersGeneric_activation2" name="activation2" class="ss-backend-field-dropdown01">
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericActivation3') === 1)
                                <tr id="inputRowFiltersGeneric_activation3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation3') }}:
                                    </td>
                                    <td>
                                        <select id="filtersGeneric_activation3" name="activation3" class="ss-backend-field-dropdown01">
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericActivation4') === 1)
                                <tr id="inputRowFiltersGeneric_activation4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation4') }}:
                                    </td>
                                    <td>
                                        <select id="filtersGeneric_activation4" name="activation4" class="ss-backend-field-dropdown01">
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericActivation5') === 1)
                                <tr id="inputRowFiltersGeneric_activation5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericActivation5') }}:
                                    </td>
                                    <td>
                                        <select id="filtersGeneric_activation5" name="activation5" class="ss-backend-field-dropdown01">
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if (config('app.gSystemConfig.enableFiltersGenericNotes') === 1)
                                <tr id="inputRowFiltersGeneric_notes" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemNotesInternal') }}:
                                    </td>
                                    <td>
                                        <textarea id="filtersGeneric_notes" name="notes" class="ss-backend-field-text-area01"></textarea>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot class="ss-backend-table-foot ss-backend-table-listing-text01">

                        </tfoot>
                    </table>

                    <div style="position: relative; display: block; overflow: hidden; clear: both; margin-top: 2px;">
                        <button id="filtersGeneric_include" name="FiltersGeneric_include" class="ss-backend-btn-base ss-backend-btn-action-execute" style="float: left;">
                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendButtonSend') }}
                        </button>
                    </div>

                    <input type="hidden" id="filtersGeneric_filter_index" name="filter_index" value="{{ $filterIndex }}" />
                    <input type="hidden" id="filtersGeneric_table_name" name="table_name" value="{{ $tableName }}" />
                    <input type="hidden" id="filtersGeneric_config_selection" name="config_selection" value="0" />

                    <input type="hidden" id="filtersGeneric_filterIndex" name="filterIndex" value="{{ $filterIndex }}" />
                    <input type="hidden" id="filtersGeneric_tableName" name="tableName" value="{{ $tableName }}" />
                    <input type="hidden" id="filtersGeneric_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />
                </div>

            </form>
        </section>
    @endif
@endsection
