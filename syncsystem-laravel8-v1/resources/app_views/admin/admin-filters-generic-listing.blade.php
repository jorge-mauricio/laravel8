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

    @dump($templateData)

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
@endsection
