@php
    // Variables.
    $idTbFiltersGeneric = $templateData['idTbFiltersGeneric'];
    $titleCurrent = $templateData['cphTitleCurrent'];
    //$arrFiltersGenericDetails = $templateData['cphBody']['arrFiltersGenericDetails'];
    $ofgdRecord = $templateData['cphBody']['ofgdRecord'];

    $filtersGenericLabelIndex = ''; // Optimize to show the right label.
    $filtersGenericLabelModule = ''; // Optimize to show the right label.

    $filterIndex = $ofgdRecord['tblFiltersGenericFilterIndex'];
    $tableName = $ofgdRecord['tblFiltersGenericTableName'];

    // Meta title.
    $metaTitle = '';
    $metaTitle .= \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitleEdit');
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
    $metaURLCurrent .= config('app.gSystemConfig.configRouteBackendActionEdit') . '/';
    $metaURLCurrent .= $ofgdRecord['tblFiltersGenericID'] . '/';
    // if ($masterPageSelect !== '') {
        $metaURLCurrent .= '?masterPageSelect=' . $masterPageSelect;
    // }
    // if ($pageNumber && $pageNumber !== '') {
        // $metaURLCurrent .= '&pageNumber=' . $pageNumber;
    // }

    // Define values.
    // ----------------------
    if (strlen($filterIndex) >= 3) {
      $filtersGenericLabelIndex = substr((string) $filterIndex, 1); // Delete the first number.
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
    {{-- TODO: evaluate changing these outputs to {{}} (or {!! !!}). --}}
    <meta name="title" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaTitle); ?>" /> {{-- Bellow 160 characters. --}}
    <meta name="description" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaDescription); ?>" /> {{-- Bellow 100 characters. --}}
    <meta name="keywords" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaKeywords); ?>" /> {{-- Bellow 60 characters. --}}

    {{-- Open Graph tags. --}}
    <meta property="og:title" content="<?php echo \SyncSystemNS\FunctionsGeneric::removeHTML01($metaTitle); ?>" />
    <meta property="og:type" content="website" /> {{-- http://ogp.me/#types | https://developers.facebook.com/docs/reference/opengraph/ --}}
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

    {{-- Form. --}}
    <section class="ss-backend-layout-section-form01">
        <form
            id="formFiltersGeneric"
            name="formFiltersGeneric"
            method="POST"
            action="/{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') }}/?_method=PUT"
            enctype="multipart/form-data"
        >
            @csrf
            <input type="hidden" id="formFiltersGenericEdit_method" name="_method" value="PUT" />

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
                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitleTableEdit') }}
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
                                    <input type="text" id="filtersGeneric_sort_order" name="sort_order" class="ss-backend-field-numeric01" maxlength="10" value="{{ $ofgdRecord['tblFiltersGenericSortOrder'] }}" />
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
                                <input type="text" id="inputRowFiltersGeneric_title" name="title" class="ss-backend-field-text01" maxlength="255" value="{{ $ofgdRecord['tblFiltersGenericTitle'] }}" />
                            </td>
                        </tr>

                        @if (config('app.gSystemConfig.enableFiltersGenericDescription') === 1)
                            <tr id="inputRowFiltersGeneric_description" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericDescription') }}:
                                </td>
                                <td>
                                    {{-- No formatting. --}}
                                    @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                        <textarea id="filtersGeneric_description" name="description" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericDescription_edit'] }}</textarea>
                                    @endif


                                    {{-- Quill. --}}
                                    @if (config('app.gSystemConfig.configBackendTextBox') === 13)
                                        <textarea id="filtersGeneric_description" name="description" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericDescription_edit'] }}</textarea>
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
                                        <textarea id="filtersGeneric_description" name="description" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericDescription_edit'] }}</textarea>
                                        <script>
                                            new FroalaEditor("#filtersGeneric_description");
                                        </script>
                                    @endif


                                    {{-- TinyMCE. --}}
                                    @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                        <textarea id="filtersGeneric_description" name="description" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericDescription_edit'] }}</textarea>
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
                                    <input type="text" id="filtersGeneric_url_alias" name="url_alias" class="ss-backend-field-text01" value="{{ $ofgdRecord['tblFiltersGenericURLAlias'] }}" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableFiltersGenericKeywordsTags') === 1)
                            <tr id="inputRowFiltersGeneric_keywords_tags" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemKeywords') }}:
                                </td>
                                <td>
                                    <textarea id="filtersGeneric_keywords_tags" name="keywords_tags" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericKeywordsTags'] }}</textarea>
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
                                    <textarea id="filtersGeneric_meta_description" name="meta_description" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericMetaDescription_edit'] }}</textarea>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableFiltersGenericMetaTitle') === 1)
                            <tr id="inputRowFiltersGeneric_meta_title" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemMetaTitle') }}:
                                </td>
                                <td>
                                    <input type="text" id="filtersGeneric_meta_title" name="meta_title" class="ss-backend-field-text01" value="{{ $ofgdRecord['tblFiltersGenericMetaTitle'] }}" />
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
                                        <input type="text" id="filtersGeneric_info_small1" name="info_small1" class="ss-backend-field-text01" value="{{ $ofgdRecord['tblFiltersGenericInfoSmall1_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericInfoS1FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="filtersGeneric_info_small1" name="info_small1" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall1_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="filtersGeneric_info_small1" name="info_small1" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall1_edit'] }}</textarea>
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
                                        <input type="text" id="filtersGeneric_info_small2" name="info_small2" class="ss-backend-field-text01" value="{{ $ofgdRecord['tblFiltersGenericInfoSmall2_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericInfoS2FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="filtersGeneric_info_small2" name="info_small2" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall2_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="filtersGeneric_info_small2" name="info_small2" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall2_edit'] }}</textarea>
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
                                        <input type="text" id="filtersGeneric_info_small3" name="info_small3" class="ss-backend-field-text01" value="{{ $ofgdRecord['tblFiltersGenericInfoSmall3_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericInfoS3FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="filtersGeneric_info_small3" name="info_small3" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall3_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="filtersGeneric_info_small3" name="info_small3" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall3_edit'] }}</textarea>
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
                                        <input type="text" id="filtersGeneric_info_small4" name="info_small4" class="ss-backend-field-text01" value="{{ $ofgdRecord['tblFiltersGenericInfoSmall4_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericInfoS4FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="filtersGeneric_info_small4" name="info_small4" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall4_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="filtersGeneric_info_small4" name="info_small4" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall4_edit'] }}</textarea>
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
                                        <input type="text" id="filtersGeneric_info_small5" name="info_small5" class="ss-backend-field-text01" value="{{ $ofgdRecord['tblFiltersGenericInfoSmall5_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericInfoS5FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="filtersGeneric_info_small5" name="info_small5" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall5_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="filtersGeneric_info_small5" name="info_small5" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericInfoSmall5_edit'] }}</textarea>
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
                                        <input type="text" id="filtersGeneric_number_small1" name="number_small1" class="ss-backend-field-numeric01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall1_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small1");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericNumberS1FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="filtersGeneric_number_small1" name="number_small1" class="ss-backend-field-currency01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall1_print'] }}" maxlength="9" />
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
                                        <input type="text" id="filtersGeneric_number_small2" name="number_small2" class="ss-backend-field-numeric01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall2_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small2");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericNumberS2FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="filtersGeneric_number_small2" name="number_small2" class="ss-backend-field-currency01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall2_print'] }}" maxlength="9" />
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
                                        <input type="text" id="filtersGeneric_number_small3" name="number_small3" class="ss-backend-field-numeric01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall3_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small3");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericNumberS3FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="filtersGeneric_number_small3" name="number_small3" class="ss-backend-field-currency01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall3_print'] }}" maxlength="9" />
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
                                        <input type="text" id="filtersGeneric_number_small4" name="number_small4" class="ss-backend-field-numeric01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall4_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small4");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericNumberS4FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="filtersGeneric_number_small4" name="number_small4" class="ss-backend-field-currency01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall4_print'] }}" maxlength="9" />
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
                                        <input type="text" id="filtersGeneric_number_small5" name="number_small5" class="ss-backend-field-numeric01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall5_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("filtersGeneric_number_small5");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configFiltersGenericNumberS5FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="filtersGeneric_number_small5" name="number_small5" class="ss-backend-field-currency01" value="{{ $ofgdRecord['tblFiltersGenericNumberSmall5_print'] }}" maxlength="9" />
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
                                    @if ($ofgdRecord['tblFiltersGenericImageMain'] !== '')
                                        <img id="imgFiltersGenericImageMain" src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $ofgdRecord['tblFiltersGenericImageMain'] . '?v=' . $cacheClear }}" alt="{{ $ofgdRecord['tblFiltersGenericTitle'] }}" class="ss-backend-images-edit" />
                                        <div id="divFiltersGenericImageMainDelete" style="position: relative; display: inline-block;">
                                            <a class="ss-backend-delete01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                            {
                                                                                idRecord: '{{ $ofgdRecord['tblFiltersGenericID'] }}',
                                                                                strTable: '{{ config('app.gSystemConfig.configSystemDBTableFiltersGeneric') }}',
                                                                                strField: 'image_main',
                                                                                recordValue: '',
                                                                                patchType: 'fileDelete',
                                                                                ajaxFunction: true,
                                                                                apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                            },
                                                                            async function(_resObjReturn) {
                                                                                // alert(JSON.stringify(_resObjReturn));

                                                                                // if(_resObjReturn.objReturn.returnStatus == true) { // Note: changed to _resObjReturn.returnStatus because it now comunicates directly with the API. TODO: update multiplatform node admin version.
                                                                                if (_resObjReturn.returnStatus === true) {
                                                                                    // Delete files.


                                                                                    // Hide elements.
                                                                                    htmlGenericStyle01('imgFiltersGenericImageMain', 'display', 'none');
                                                                                    htmlGenericStyle01('divFiltersGenericImageMainDelete', 'display', 'none');

                                                                                    // Success message.
                                                                                    elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage6') }}');

                                                                                } else {
                                                                                    // Show error.
                                                                                    elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessageAPI2e') }}');
                                                                                }

                                                                                // Hide ajax progress bar.
                                                                                htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                            });">
                                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemImageDelete') }}
                                            </a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        <tr id="inputRowFiltersGeneric_activation" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation') }}:
                            </td>
                            <td>
                                <select id="filtersGeneric_activation" name="activation" class="ss-backend-field-dropdown01">
                                    <option value="1"{{ $ofgdRecord['tblFiltersGenericActivation'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                    <option value="0"{{ $ofgdRecord['tblFiltersGenericActivation'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                        <option value="1"{{ $ofgdRecord['tblFiltersGenericActivation1'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ofgdRecord['tblFiltersGenericActivation1'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                        <option value="1"{{ $ofgdRecord['tblFiltersGenericActivation2'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ofgdRecord['tblFiltersGenericActivation2'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                        <option value="1"{{ $ofgdRecord['tblFiltersGenericActivation3'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ofgdRecord['tblFiltersGenericActivation3'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                        <option value="1"{{ $ofgdRecord['tblFiltersGenericActivation4'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ofgdRecord['tblFiltersGenericActivation4'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                        <option value="1"{{ $ofgdRecord['tblFiltersGenericActivation5'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ofgdRecord['tblFiltersGenericActivation5'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                    <textarea id="filtersGeneric_notes" name="notes" class="ss-backend-field-text-area01">{{ $ofgdRecord['tblFiltersGenericNotes_edit'] }}</textarea>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot class="ss-backend-table-foot ss-backend-table-listing-text01">

                    </tfoot>
                </table>
            </div>

            <div style="position: relative; display: block; overflow: hidden; clear: both; margin-top: 2px;">
                <button id="filtersGeneric_include" name="filtersGeneric_include" class="ss-backend-btn-base ss-backend-btn-action-execute" style="float: left;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendButtonUpdate') }}
                </button>

                <a onclick="history.go(-1);" class="ss-backend-btn-base ss-backend-btn-action-alert" style="float: right;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendButtonBack') }}
                </a>
            </div>

            <input type="hidden" id="filtersGeneric_id" name="id" value="{{ $ofgdRecord['tblFiltersGenericID'] }}" />
            <input type="hidden" id="filtersGeneric_filter_index" name="filter_index" value="{{ $ofgdRecord['tblFiltersGenericFilterIndex'] }}" />
            <input type="hidden" id="filtersGeneric_table_name" name="table_name" value="{{ $ofgdRecord['tblFiltersGenericTableName'] }}" />

            <input type="hidden" id="filtersGeneric_filterIndex" name="filterIndex" value="{{ $ofgdRecord['tblFiltersGenericFilterIndex'] }}" />
            <input type="hidden" id="filtersGeneric_tableName" name="tableName" value="{{ $ofgdRecord['tblFiltersGenericTableName'] }}" />
            <input type="hidden" id="filtersGeneric_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />
        </form>
    </section>
@endsection
