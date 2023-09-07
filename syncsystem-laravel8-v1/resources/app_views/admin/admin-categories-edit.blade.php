@php
    // Variables.
    $idTbCategories = $templateData['idTbCategories'];
    $titleCurrent = $templateData['cphTitleCurrent'];
    //$arrCategoriesDetails = $templateData['cphBody']['arrCategoriesDetails'];
    $ocdRecord = $templateData['cphBody']['ocdRecord'];

    // Meta title.
    $metaTitle = '';
    $metaTitle .= \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesTitleEdit');
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
    $metaURLCurrent .= config('app.gSystemConfig.configRouteBackendCategories') . '/';
    $metaURLCurrent .= config('app.gSystemConfig.configRouteBackendActionEdit') . '/';
    $metaURLCurrent .= $ocdRecord['tblCategoriesID'] . '/';
    // if ($masterPageSelect !== '') {
        $metaURLCurrent .= '?masterPageSelect=' . $masterPageSelect;
    // }
    if ($pageNumber && $pageNumber !== '') {
        $metaURLCurrent .= '&pageNumber=' . $pageNumber;
    }

    // Filters - Status.
    if (config('app.gSystemConfig.enableCategoriesStatus') === 1) {
        $resultsCategoriesStatusListing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 2;
        });
    }

    // Filter results according to filter_index.
    if (config('app.gSystemConfig.enableCategoriesFilterGeneric1') !== 0) {
        $resultsCategoriesFiltersGeneric1Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 101;
        });
    }

    if (config('app.gSystemConfig.enableCategoriesFilterGeneric2') !== 0) {
        $resultsCategoriesFiltersGeneric2Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 102;
        });
    }

    if (config('app.gSystemConfig.enableCategoriesFilterGeneric3') !== 0) {
        $resultsCategoriesFiltersGeneric3Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 103;
        });
    }

    if (config('app.gSystemConfig.enableCategoriesFilterGeneric4') !== 0) {
        $resultsCategoriesFiltersGeneric4Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 104;
        });
    }

    if (config('app.gSystemConfig.enableCategoriesFilterGeneric5') !== 0) {
        $resultsCategoriesFiltersGeneric5Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 105;
        });
    }

    if (config('app.gSystemConfig.enableCategoriesFilterGeneric6') !== 0) {
        $resultsCategoriesFiltersGeneric6Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 106;
        });
    }

    if (config('app.gSystemConfig.enableCategoriesFilterGeneric7') !== 0) {
        $resultsCategoriesFiltersGeneric7Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 107;
        });
    }

    if (config('app.gSystemConfig.enableCategoriesFilterGeneric8') !== 0) {
        $resultsCategoriesFiltersGeneric8Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 108;
        });
    }

    if (config('app.gSystemConfig.enableCategoriesFilterGeneric9') !== 0) {
        $resultsCategoriesFiltersGeneric9Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 109;
        });
    }

    if (config('app.gSystemConfig.enableCategoriesFilterGeneric10') !== 0) {
        $resultsCategoriesFiltersGeneric10Listing = array_filter($templateData['cphBody']['ofglRecords'], function ($arr) {
            return $arr['filter_index'] === 110;
        });
    }
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

    @dump($templateData['cphBody'])

    {{-- Form. --}}
    <section class="ss-backend-layout-section-form01">
        <form
            id="formCategories"
            name="formCategories"
            method="POST"
            action="/{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') }}/?_method=PUT"
            enctype="multipart/form-data"
        >
            {{-- TODO: check if this is necessary: /?_method=PUT (transcribed from node version) --}}
            @csrf

            <input type="hidden" id="formCategoryEdit_method" name="_method" value="PUT" />

            {{-- TODO: change for css class. --}}
            <div style="position: relative; display: block; overflow: hidden;">
                <script>
                    // Debug.
                    // webpackDebugTest(); // webpack debug


                    // Reorder table rows.
                    // TODO: Create variable in config to enable it.
                    document.addEventListener('DOMContentLoaded', () => {

                        inputDataReorder([{{ implode(',', config('app.gSystemConfig.configCategoriesInputOrder')) }}]); // necessary to map the array in order to display as an array inside template literals

                    }, false);
                </script>

                <table id="input_table_categories" class="ss-backend-table-input01">
                    <caption class="ss-backend-table-header-text01 ss-backend-table-title">
                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesTitleTable') }}
                    </caption>
                    <thead class="ss-backend-table-bg-dark ss-backend-table-header-text01">

                    </thead>
                    <tbody class="ss-backend-table-listing-text01">
                        @if (config('app.gSystemConfig.enableCategoriesIdParentEdit') === 1)
                            <tr id="inputRowCategories_id_parent" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemParentLink') }}:
                                </td>
                                <td>
                                    {{-- TODO: Convert to ajax. --}}
                                    <select id="categories_id_parent" name="id_parent" class="ss-backend-field-dropdown01">
                                        <option value="0"{{ $ocdRecord['tblCategoriesIdParent'] === 0 ? ' selected' : '' }}>
                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectRoot') }}
                                        </option>

                                        {{-- ${objCategoriesIdParent.map((categoriesIdParentRow) => {
                                        return `
                                                <option value="${categoriesIdParentRow.id}"${ocdRecord.tblCategoriesIdParent == categoriesIdParentRow.id ? ` selected` : ``}>
                                                    ${SyncSystemNS.FunctionsGeneric.contentMaskRead(categoriesIdParentRow.title, 'db')}
                                                </option>
                                            `;
                                        })} --}}
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesSortOrder') === 1)
                            <tr id="inputRowCategories_sort_order" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemSortOrder') }}:
                                </td>
                                <td>
                                    <input type="text" id="categories_sort_order" name="sort_order" class="ss-backend-field-numeric01" maxlength="10" value="{{ $ocdRecord['tblCategoriesSortOrder'] }}" />
                                    <script>
                                        Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_sort_order");
                                    </script>
                                </td>
                            </tr>
                        @endif

                        <tr id="inputRowCategories_category_type" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesType') }}:
                            </td>
                            <td>
                                <select id="categories_category_type" name="category_type" class="ss-backend-field-dropdown01">
                                    @foreach (config('app.gSystemConfig.configCategoryType') as $categoryTypeRow)
                                        <option value="{{ $categoryTypeRow['category_type'] }}"{{ $ocdRecord['tblCategoriesCategoryType'] === $categoryTypeRow['category_type'] ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $categoryTypeRow['category_type_function_label']) }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        @if (config('app.gSystemConfig.enableCategoriesBindRegisterUser') === 1)
                            <tr id="inputRowCategories_id_register_user" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesRU') }}:
                                </td>
                                <td>
                                    <select id="categories_id_register_user" name="id_register_user" class="ss-backend-field-dropdown01">
                                        <option value="0" selected="true">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @else
                            <input type="hidden" id="categories_id_register_user" name="id_register_user" value="0" />
                        @endif

                        <tr id="inputRowCategories_title" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesCategory') }}:
                            </td>
                            <td>
                                <input type="text" id="categories_title" name="title" class="ss-backend-field-text01" maxlength="255" value="{{ $ocdRecord['tblCategoriesTitle'] }}" />
                            </td>
                        </tr>

                        @if (config('app.gSystemConfig.enableCategoriesDescription') === 1)
                        <tr id="inputRowCategories_description" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesDescription') }}:
                            </td>
                            <td>
                                {{-- No formatting. --}}
                                @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                    <textarea id="categories_description" name="description" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesDescription_edit'] }}</textarea>
                                @endif


                                {{-- Quill. --}}
                                @if (config('app.gSystemConfig.configBackendTextBox') === 13)
                                    <textarea id="categories_description" name="description" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesDescription_edit'] }}</textarea>
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
                                    <textarea id="categories_description" name="description" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesDescription_edit'] }}</textarea>
                                    <script>
                                        new FroalaEditor("#categories_description");
                                    </script>
                                @endif


                                {{-- TinyMCE. --}}
                                @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                    <textarea id="categories_description" name="description" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesDescription_edit'] }}</textarea>
                                    <script>
                                        tinyMCEBackendConfig.selector = "#categories_description";
                                        tinymce.init(tinyMCEBackendConfig);
                                    </script>
                                @endif
                            </td>
                        </tr>
                        @endif

                        @if (config('app.gSystemConfig.configCategoriesURLAlias') === 1)
                            <tr id="inputRowCategories_url_alias" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemURLAlias') }}:
                                </td>
                                <td>
                                    <input type="text" id="categories_url_alias" name="url_alias" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesURLAlias'] }}" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesKeywordsTags') === 1)
                            <tr id="inputRowCategories_keywords_tags" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemKeywords') }}:
                                </td>
                                <td>
                                    <textarea id="categories_keywords_tags" name="keywords_tags" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesKeywordsTags'] }}</textarea>
                                    <div>
                                        ({{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemKeywordsInstruction01') }})
                                    </div>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesMetaDescription') === 1)
                            <tr id="inputRowCategories_meta_description" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemMetaDescription') }}:
                                </td>
                                <td>
                                    <textarea id="categories_meta_description" name="meta_description" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesMetaDescription_edit'] }}</textarea>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesMetaTitle') === 1)
                            <tr id="inputRowCategories_meta_title" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemMetaTitle') }}:
                                </td>
                                <td>
                                    <input type="text" id="categories_meta_title" name="meta_title" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesMetaTitle'] }}" />
                                </td>
                            </tr>
                        @endif

                        {{-- Generic filters. --}}
                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric1') !== 0)
                            <tr id="inputRowCategories_filters_generic1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric1') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric1') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric1Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric1[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric1') === 2)
                                        <select id="idsCategoriesFiltersGeneric1" name="idsCategoriesFiltersGeneric1[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric1Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric1') === 3)
                                        <select id="idsCategoriesFiltersGeneric1" name="idsCategoriesFiltersGeneric1[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric1Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric1') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric1Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric1[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric2') !== 0)
                            <tr id="inputRowCategories_filters_generic2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric2') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric2') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric2Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric2[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric2') === 2)
                                        <select id="idsCategoriesFiltersGeneric2" name="idsCategoriesFiltersGeneric2[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric2Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric2') === 3)
                                        <select id="idsCategoriesFiltersGeneric2" name="idsCategoriesFiltersGeneric2[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric2Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric2') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric2Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric2[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric3') !== 0)
                            <tr id="inputRowCategories_filters_generic3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric3') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric3') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric3Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric3[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric3') === 2)
                                        <select id="idsCategoriesFiltersGeneric3" name="idsCategoriesFiltersGeneric3[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric3Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric3') === 3)
                                        <select id="idsCategoriesFiltersGeneric3" name="idsCategoriesFiltersGeneric3[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric3Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric3') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric3Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric3[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric4') !== 0)
                            <tr id="inputRowCategories_filters_generic4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric4') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric4') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric4Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric4[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric4') === 2)
                                        <select id="idsCategoriesFiltersGeneric4" name="idsCategoriesFiltersGeneric4[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric4Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric4') === 3)
                                        <select id="idsCategoriesFiltersGeneric4" name="idsCategoriesFiltersGeneric4[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric4Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric4') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric4Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric4[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric5') !== 0)
                            <tr id="inputRowCategories_filters_generic5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric5') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric5') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric5Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric5[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric5') === 2)
                                        <select id="idsCategoriesFiltersGeneric5" name="idsCategoriesFiltersGeneric5[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric5Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric5') === 3)
                                        <select id="idsCategoriesFiltersGeneric5" name="idsCategoriesFiltersGeneric5[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric5Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric5') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric5Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric5[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric6') !== 0)
                            <tr id="inputRowCategories_filters_generic6" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric6') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric6') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric6Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric6[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric6') === 2)
                                        <select id="idsCategoriesFiltersGeneric6" name="idsCategoriesFiltersGeneric6[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric6Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric6') === 3)
                                        <select id="idsCategoriesFiltersGeneric6" name="idsCategoriesFiltersGeneric6[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric6Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric6') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric6Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric6[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric7') !== 0)
                            <tr id="inputRowCategories_filters_generic7" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric7') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric7') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric7Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric7[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric7') === 2)
                                        <select id="idsCategoriesFiltersGeneric7" name="idsCategoriesFiltersGeneric7[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric7Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric7') === 3)
                                        <select id="idsCategoriesFiltersGeneric7" name="idsCategoriesFiltersGeneric7[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric7Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric7') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric7Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric7[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric8') !== 0)
                            <tr id="inputRowCategories_filters_generic8" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric8') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric8') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric8Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric8[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric8') === 2)
                                        <select id="idsCategoriesFiltersGeneric8" name="idsCategoriesFiltersGeneric8[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric8Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric8') === 3)
                                        <select id="idsCategoriesFiltersGeneric8" name="idsCategoriesFiltersGeneric8[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric8Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric8') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric8Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric8[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric9') !== 0)
                            <tr id="inputRowCategories_filters_generic9" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric9') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric9') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric9Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric9[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric9') === 2)
                                        <select id="idsCategoriesFiltersGeneric9" name="idsCategoriesFiltersGeneric9[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric9Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric9') === 3)
                                        <select id="idsCategoriesFiltersGeneric9" name="idsCategoriesFiltersGeneric9[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric9Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric9') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric9Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric9[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesFilterGeneric10') !== 0)
                            <tr id="inputRowCategories_filters_generic10" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric10') }}:
                                </td>
                                <td>
                                    {{-- Checkbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric10') === 1)
                                        @foreach ($resultsCategoriesFiltersGeneric10Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-checkbox-label">
                                                <input type="checkbox" name="idsCategoriesFiltersGeneric10[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-checkbox" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif

                                    {{-- Listbox. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric10') === 2)
                                        <select id="idsCategoriesFiltersGeneric10" name="idsCategoriesFiltersGeneric10[]" class="ss-backend-field-listbox01" size="5" multiple="multiple">
                                            @foreach ($resultsCategoriesFiltersGeneric10Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Dropdown. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric10') === 3)
                                        <select id="idsCategoriesFiltersGeneric10" name="idsCategoriesFiltersGeneric10[]" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                            @foreach ($resultsCategoriesFiltersGeneric10Listing as $categoriesFiltersGenericRow)
                                                <option value="{{ $categoriesFiltersGenericRow['id'] }}">{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    {{-- Radio. --}}
                                    @if (config('app.gSystemConfig.enableCategoriesFilterGeneric10') === 4)
                                        @foreach ($resultsCategoriesFiltersGeneric10Listing as $categoriesFiltersGenericRow)
                                            <label class="ss-backend-field-radio-label">
                                                <input type="radio" name="idsCategoriesFiltersGeneric10[]" value="{{ $categoriesFiltersGenericRow['id'] }}" class="ss-backend-field-radio" /> {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesFiltersGenericRow['title'], 'db') }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif


                        @if (config('app.gSystemConfig.enableCategoriesInfo1') === 1)
                            <tr id="inputRowCategories_info1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo1') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo1FieldType') === 1)
                                        <input type="text" id="categories_info1" name="info1" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo1_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo1FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info1" name="info1" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo1_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info1" name="info1" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo1_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info1";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo1FieldType') === 11)
                                        <input type="text" id="categories_info1" name="info1" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo1_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo1FieldType') === 12)
                                        <textarea id="categories_info1" name="info1" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo1_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfo2') === 1)
                            <tr id="inputRowCategories_info2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo2') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo2FieldType') === 1)
                                        <input type="text" id="categories_info2" name="info2" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo2_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo2FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info2" name="info2" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo2_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info2" name="info2" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo2_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info2";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo2FieldType') === 11)
                                        <input type="text" id="categories_info2" name="info2" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo2_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo2FieldType') === 12)
                                        <textarea id="categories_info2" name="info2" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo2_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfo3') === 1)
                            <tr id="inputRowCategories_info3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo3') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo3FieldType') === 1)
                                        <input type="text" id="categories_info3" name="info3" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo3_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo3FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info3" name="info3" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo3_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info3" name="info3" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo3_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info3";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo3FieldType') === 11)
                                        <input type="text" id="categories_info3" name="info3" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo3_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo3FieldType') === 12)
                                        <textarea id="categories_info3" name="info3" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo3_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfo4') === 1)
                            <tr id="inputRowCategories_info4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo4') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo4FieldType') === 1)
                                        <input type="text" id="categories_info4" name="info4" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo4_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo4FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info4" name="info4" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo4_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info4" name="info4" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo4_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info4";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo4FieldType') === 11)
                                        <input type="text" id="categories_info4" name="info4" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo4_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo4FieldType') === 12)
                                        <textarea id="categories_info4" name="info4" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo4_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfo5') === 1)
                            <tr id="inputRowCategories_info5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo5') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo5FieldType') === 1)
                                        <input type="text" id="categories_info5" name="info5" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo5_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo5FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info5" name="info5" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo5_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info5" name="info5" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo5_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info5";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo5FieldType') === 11)
                                        <input type="text" id="categories_info5" name="info5" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo5_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo5FieldType') === 12)
                                        <textarea id="categories_info5" name="info5" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo5_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfo6') === 1)
                            <tr id="inputRowCategories_info6" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo6') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo6FieldType') === 1)
                                        <input type="text" id="categories_info6" name="info6" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo6_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo6FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info6" name="info6" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo6_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info6" name="info6" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo6_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info6";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo6FieldType') === 11)
                                        <input type="text" id="categories_info6" name="info6" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo6_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo6FieldType') === 12)
                                        <textarea id="categories_info6" name="info6" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo6_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfo7') === 1)
                            <tr id="inputRowCategories_info7" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo7') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo7FieldType') === 1)
                                        <input type="text" id="categories_info7" name="info7" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo7_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo7FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info7" name="info7" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo7_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info7" name="info7" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo7_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info7";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo7FieldType') === 11)
                                        <input type="text" id="categories_info7" name="info7" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo7_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo7FieldType') === 12)
                                        <textarea id="categories_info7" name="info7" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo7_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfo8') === 1)
                            <tr id="inputRowCategories_info8" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo8') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo8FieldType') === 1)
                                        <input type="text" id="categories_info8" name="info8" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo8_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo8FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info8" name="info8" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo8_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info8" name="info8" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo8_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info8";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo8FieldType') === 11)
                                        <input type="text" id="categories_info8" name="info8" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo8_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo8FieldType') === 12)
                                        <textarea id="categories_info8" name="info8" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo8_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfo9') === 1)
                            <tr id="inputRowCategories_info9" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo9') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo9FieldType') === 1)
                                        <input type="text" id="categories_info9" name="info9" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo9_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo9FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info9" name="info9" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo9_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info9" name="info9" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo9_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info9";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo9FieldType') === 11)
                                        <input type="text" id="categories_info9" name="info9" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo9_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo9FieldType') === 12)
                                        <textarea id="categories_info9" name="info9" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo9_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfo10') === 1)
                            <tr id="inputRowCategories_info10" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfo10') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo10FieldType') === 1)
                                        <input type="text" id="categories_info10" name="info10" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo10_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo10FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info10" name="info10" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo10_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="categories_info10" name="info10" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo10_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info10";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo10FieldType') === 11)
                                        <input type="text" id="categories_info10" name="info10" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo10_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfo10FieldType') === 12)
                                        <textarea id="categories_info10" name="info10" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo10_edit'] }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfoS1') === 1)
                            <tr id="inputRowCategories_info_small1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfoS1') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS1FieldType') === 1)
                                        <input type="text" id="categories_info_small1" name="info_small1" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall1_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS1FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info_small1" name="info_small1" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall1_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="categories_info_small1" name="info_small1" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall1_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info_small1";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfoS2') === 1)
                            <tr id="inputRowCategories_info_small2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfoS2') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS2FieldType') === 1)
                                        <input type="text" id="categories_info_small2" name="info_small2" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall2_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS2FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info_small2" name="info_small2" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall2_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="categories_info_small2" name="info_small2" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall2_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info_small2";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfoS3') === 1)
                            <tr id="inputRowCategories_info_small3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfoS3') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS3FieldType') === 1)
                                        <input type="text" id="categories_info_small3" name="info_small3" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall3_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS3FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info_small3" name="info_small3" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall3_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="categories_info_small3" name="info_small3" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall3_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info_small3";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfoS4') === 1)
                            <tr id="inputRowCategories_info_small4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfoS4') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS4FieldType') === 1)
                                        <input type="text" id="categories_info_small4" name="info_small4" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall4_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS4FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info_small4" name="info_small4" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall4_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="categories_info_small4" name="info_small4" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall4_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info_small4";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesInfoS5') === 1)
                            <tr id="inputRowCategories_info_small5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesInfoS5') }}:
                                </td>
                                <td>
                                    {{-- Single line. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS5FieldType') === 1)
                                        <input type="text" id="categories_info_small5" name="info_small5" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall5_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configCategoriesInfoS5FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="categories_info_small5" name="info_small5" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall5_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox') === 18)
                                            <textarea id="categories_info_small5" name="info_small5" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall5_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#categories_info_small5";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumber1') === 1)
                            <tr id="inputRowCategories_number1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumber1') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber1FieldType') === 1)
                                        <input type="text" id="categories_number1" name="number1" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber1_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number1");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber1FieldType') === 2 || config('app.gSystemConfig.configCategoriesNumber1FieldType') === 4)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number1" name="number1" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber1_print'] }}" maxlength="45" />

                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number1");
                                        </script>
                                    @endif

                                    {{-- Decimal. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber1FieldType') === 3)
                                        <input type="text" id="categories_number1" name="number1" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber1_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number1");
                                        </script>
                                    @endif

                                    {{-- Debug. --}}
                                    {{--
                                    @dump($ocdRecord['tblCategoriesNumber1'])
                                    @dump(\SyncSystemNS\FunctionsGeneric::valueMaskRead($ocdRecord['tblCategoriesNumber1'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumber1FieldType']))
                                    @dump(SS_VALUE_TYPE_SYSTEM_CURRENCY)
                                    --}}
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumber2') === 1)
                            <tr id="inputRowCategories_number2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumber2') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber2FieldType') === 1)
                                        <input type="text" id="categories_number2" name="number2" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber2_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number2");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber2FieldType') === 2 || config('app.gSystemConfig.configCategoriesNumber2FieldType') === 4)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number2" name="number2" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber2_print'] }}" maxlength="45" />

                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number2");
                                        </script>
                                    @endif

                                    {{-- Decimal. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber2FieldType') === 3)
                                        <input type="text" id="categories_number2" name="number2" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber2_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number2");
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumber3') === 1)
                            <tr id="inputRowCategories_number3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumber3') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber3FieldType') === 1)
                                        <input type="text" id="categories_number3" name="number3" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber3_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number3");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber3FieldType') === 2 || config('app.gSystemConfig.configCategoriesNumber3FieldType') === 4)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number3" name="number3" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber3_print'] }}" maxlength="45" />

                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number3");
                                        </script>
                                    @endif

                                    {{-- Decimal. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber3FieldType') === 3)
                                        <input type="text" id="categories_number3" name="number3" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber3_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number3");
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumber4') === 1)
                            <tr id="inputRowCategories_number4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumber4') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber4FieldType') === 1)
                                        <input type="text" id="categories_number4" name="number4" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber4_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number4");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber4FieldType') === 2 || config('app.gSystemConfig.configCategoriesNumber4FieldType') === 4)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number4" name="number4" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber4_print'] }}" maxlength="45" />

                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number4");
                                        </script>
                                    @endif

                                    {{-- Decimal. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber4FieldType') === 3)
                                        <input type="text" id="categories_number4" name="number4" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber4_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number4");
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumber5') === 1)
                            <tr id="inputRowCategories_number5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumber5') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber5FieldType') === 1)
                                        <input type="text" id="categories_number5" name="number5" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber5_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number5");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber5FieldType') === 2 || config('app.gSystemConfig.configCategoriesNumber5FieldType') === 4)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number5" name="number5" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber5_print'] }}" maxlength="45" />

                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number5");
                                        </script>
                                    @endif

                                    {{-- Decimal. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumber5FieldType') === 3)
                                        <input type="text" id="categories_number5" name="number5" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber5_print'] }}" maxlength="34" />
                                        <script>
                                            Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number5");
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumberS1') === 1)
                            <tr id="inputRowCategories_number_small1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumberS1') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS1FieldType') === 1)
                                        <input type="text" id="categories_number_small1" name="number_small1" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall1_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small1");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS1FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number_small1" name="number_small1" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall1_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small1");
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumberS2') === 1)
                            <tr id="inputRowCategories_number_small2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumberS2') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS2FieldType') === 1)
                                        <input type="text" id="categories_number_small2" name="number_small2" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall2_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small2");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS2FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number_small2" name="number_small2" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall2_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small2");
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumberS3') === 1)
                            <tr id="inputRowCategories_number_small3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumberS3') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS3FieldType') === 1)
                                        <input type="text" id="categories_number_small3" name="number_small3" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall3_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small3");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS3FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number_small3" name="number_small3" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall3_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small3");
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumberS4') === 1)
                            <tr id="inputRowCategories_number_small4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumberS4') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS4FieldType') === 1)
                                        <input type="text" id="categories_number_small4" name="number_small4" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall4_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small4");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS4FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number_small4" name="number_small4" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall4_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small4");
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNumberS5') === 1)
                            <tr id="inputRowCategories_number_small5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesNumberS5') }}:
                                </td>
                                <td>
                                    {{-- General number. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS5FieldType') === 1)
                                        <input type="text" id="categories_number_small5" name="number_small5" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall5_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small5");
                                        </script>
                                    @endif

                                    {{-- System currency. --}}
                                    @if (config('app.gSystemConfig.configCategoriesNumberS5FieldType') === 2)
                                        {{ config('app.gSystemConfig.configSystemCurrency') }}
                                        <input type="text" id="categories_number_small5" name="number_small5" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall5_print'] }}" maxlength="9" />
                                        <script>
                                            Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small5");
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesDate1') === 1)
                            <tr id="inputRowCategories_date1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesDate1') }}:
                                </td>
                                <td>
                                    {{-- Dropdown menu. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate1FieldType') === 2)
                                        @if (config('app.gSystemConfig.configBackendDateFormat') === 1)
                                            <select id="categories_date1_day" name="date1_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate1Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate1DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date1_month" name="date1_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate1Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate1DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date1_year" name="date1_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate1Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate1DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select id="categories_date1_month" name="date1_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate1Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate1DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date1_day" name="date1_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate1Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate1DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date1_year" name="date1_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate1Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate1DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif


                                    {{-- js-datepicker. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate1FieldType') === 11)
                                        <input type="text" id="categories_date1" name="date1" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate1_print'] }}" />
                                        <script>
                                            const dpDate1 = datepicker("#categories_date1",
                                                // Generic date.
                                                {{ config('app.gSystemConfig.configCategoriesDate1Type') === 1 || config('app.gSystemConfig.configCategoriesDate1Type') === 2 || config('app.gSystemConfig.configCategoriesDate1Type') === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                // Birth date.
                                                {{ config('app.gSystemConfig.configCategoriesDate1Type') === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                // Task date.
                                                {{ config('app.gSystemConfig.configCategoriesDate1Type') === 5 || config('app.gSystemConfig.configCategoriesDate1Type') === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                // History date.
                                                {{ config('app.gSystemConfig.configCategoriesDate1Type') === 6 || config('app.gSystemConfig.configCategoriesDate1Type') === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
                                            );
                                            // $("#date1").datepicker();


                                            // Debug.
                                            // alert(jsDatepickerGenericBackendConfigOptions);
                                            // console.log("jsDatepickerBaseBackendConfigOptions=", jsDatepickerBaseBackendConfigOptions);
                                            // console.log("jsDatepickerGenericBackendConfigOptions=", jsDatepickerGenericBackendConfigOptions);
                                            // console.log("jsDatepickerBirthBackendConfigOptions=", jsDatepickerGenericBackendConfigOptions);
                                            // console.log("jsDatepickerTaskBackendConfigOptions=", jsDatepickerGenericBackendConfigOptions);
                                            // console.log("jsDatepickerHistoryBackendConfigOptions=", jsDatepickerGenericBackendConfigOptions);
                                        </script>
                                    @endif

                                    {{-- Complete and Semi-complete date. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate1Type') === 2 || config('app.gSystemConfig.configCategoriesDate1Type') === 3 || config('app.gSystemConfig.configCategoriesDate1Type') === 55 || config('app.gSystemConfig.configCategoriesDate1Type') === 66)
                                        -
                                        <select id="categories_date1_hour" name="date1_hour" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate1Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate1DateHour'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        :
                                        <select id="categories_date1_minute" name="date1_minute" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate1Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate1DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (config('app.gSystemConfig.configCategoriesDate1Type') === 2)
                                            :
                                            <select id="categories_date1_seconds" name="date1_seconds" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate1Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate1DateSecond'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesDate2') === 1)
                            <tr id="inputRowCategories_date2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesDate2') }}:
                                </td>
                                <td>
                                    {{-- Dropdown menu. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate2FieldType') === 2)
                                        @if (config('app.gSystemConfig.configBackendDateFormat') === 1)
                                            <select id="categories_date2_day" name="date2_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate2Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate2DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date2_month" name="date2_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate2Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate2DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date2_year" name="date2_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate2Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate2DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select id="categories_date2_month" name="date2_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate2Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate2DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date2_day" name="date2_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate2Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate2DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date2_year" name="date2_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate2Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate2DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif


                                    {{-- js-datepicker. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate2FieldType') === 11)
                                        <input type="text" id="categories_date2" name="date2" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate2_print'] }}" />
                                        <script>
                                            const dpDate2 = datepicker("#categories_date2",
                                                // Generic date.
                                                {{ config('app.gSystemConfig.configCategoriesDate2Type') === 1 || config('app.gSystemConfig.configCategoriesDate2Type') === 2 || config('app.gSystemConfig.configCategoriesDate2Type') === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                // Birth date.
                                                {{ config('app.gSystemConfig.configCategoriesDate2Type') === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                // Task date.
                                                {{ config('app.gSystemConfig.configCategoriesDate2Type') === 5 || config('app.gSystemConfig.configCategoriesDate2Type') === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                // History date.
                                                {{ config('app.gSystemConfig.configCategoriesDate2Type') === 6 || config('app.gSystemConfig.configCategoriesDate2Type') === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
                                            );
                                        </script>
                                    @endif

                                    {{-- Complete and Semi-complete date. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate2Type') === 2 || config('app.gSystemConfig.configCategoriesDate2Type') === 3 || config('app.gSystemConfig.configCategoriesDate2Type') === 55 || config('app.gSystemConfig.configCategoriesDate2Type') === 66)
                                        -
                                        <select id="categories_date2_hour" name="date2_hour" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate2Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate2DateHour'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        :
                                        <select id="categories_date2_minute" name="date2_minute" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate2Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate2DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (config('app.gSystemConfig.configCategoriesDate2Type')=== 2)
                                            :
                                            <select id="categories_date2_seconds" name="date2_seconds" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate2Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate2DateSecond'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesDate3') === 1)
                            <tr id="inputRowCategories_date3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesDate3') }}:
                                </td>
                                <td>
                                    {{-- Dropdown menu. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate3FieldType') === 2)
                                        @if (config('app.gSystemConfig.configBackendDateFormat') === 1)
                                            <select id="categories_date3_day" name="date3_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate3Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate3DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date3_month" name="date3_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate3Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate3DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date3_year" name="date3_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate3Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate3DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select id="categories_date3_month" name="date3_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate3Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate3DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date3_day" name="date3_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate3Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate3DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date3_year" name="date3_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate3Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate3DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif


                                    {{-- js-datepicker. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate3FieldType') === 11)
                                        <input type="text" id="categories_date3" name="date3" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate3_print'] }}" />
                                        <script>
                                            const dpDate3 = datepicker("#categories_date3",
                                                // Generic date.
                                                {{ config('app.gSystemConfig.configCategoriesDate3Type') === 1 || config('app.gSystemConfig.configCategoriesDate3Type') === 2 || config('app.gSystemConfig.configCategoriesDate3Type') === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                // Birth date.
                                                {{ config('app.gSystemConfig.configCategoriesDate3Type') === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                // Task date.
                                                {{ config('app.gSystemConfig.configCategoriesDate3Type') === 5 || config('app.gSystemConfig.configCategoriesDate3Type') === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                // History date.
                                                {{ config('app.gSystemConfig.configCategoriesDate3Type') === 6 || config('app.gSystemConfig.configCategoriesDate3Type') === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
                                            );
                                        </script>
                                    @endif

                                    {{-- Complete and Semi-complete date. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate3Type') === 2 || config('app.gSystemConfig.configCategoriesDate3Type') === 3 || config('app.gSystemConfig.configCategoriesDate3Type') === 55 || config('app.gSystemConfig.configCategoriesDate3Type') === 66)
                                        -
                                        <select id="categories_date3_hour" name="date3_hour" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate3Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate3DateHour'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        :
                                        <select id="categories_date3_minute" name="date3_minute" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate3Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate3DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (config('app.gSystemConfig.configCategoriesDate3Type') === 2)
                                            :
                                            <select id="categories_date3_seconds" name="date3_seconds" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate3Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate3DateSecond'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesDate4') === 1)
                            <tr id="inputRowCategories_date4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesDate4') }}:
                                </td>
                                <td>
                                    {{-- Dropdown menu. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate4FieldType') === 2)
                                        @if (config('app.gSystemConfig.configBackendDateFormat') === 1)
                                            <select id="categories_date4_day" name="date4_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate4Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate4DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date4_month" name="date4_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate4Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate4DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date4_year" name="date4_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate4Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate4DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select id="categories_date4_month" name="date4_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate4Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate4DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date4_day" name="date4_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate4Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate4DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date4_year" name="date4_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate4Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate4DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif


                                    {{-- js-datepicker. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate4FieldType') === 11)
                                        <input type="text" id="categories_date4" name="date4" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate4_print'] }}" />
                                        <script>
                                            const dpDate4 = datepicker("#categories_date4",
                                                // Generic date.
                                                {{ config('app.gSystemConfig.configCategoriesDate4Type') === 1 || config('app.gSystemConfig.configCategoriesDate4Type') === 2 || config('app.gSystemConfig.configCategoriesDate4Type') === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                // Birth date.
                                                {{ config('app.gSystemConfig.configCategoriesDate4Type') === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                // Task date.
                                                {{ config('app.gSystemConfig.configCategoriesDate4Type') === 5 || config('app.gSystemConfig.configCategoriesDate4Type') === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                // History date.
                                                {{ config('app.gSystemConfig.configCategoriesDate4Type') === 6 || config('app.gSystemConfig.configCategoriesDate4Type') === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
                                            );
                                        </script>
                                    @endif

                                    {{-- Complete and Semi-complete date. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate4Type') === 2 || config('app.gSystemConfig.configCategoriesDate4Type') === 3 || config('app.gSystemConfig.configCategoriesDate4Type') === 55 || config('app.gSystemConfig.configCategoriesDate4Type') === 66)
                                        -
                                        <select id="categories_date4_hour" name="date4_hour" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate4Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate4DateHour'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        :
                                        <select id="categories_date4_minute" name="date4_minute" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate4Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate4DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (config('app.gSystemConfig.configCategoriesDate4Type') === 2)
                                            :
                                            <select id="categories_date4_seconds" name="date4_seconds" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate4Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate4DateSecond'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesDate5') === 1)
                            <tr id="inputRowCategories_date5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesDate5') }}:
                                </td>
                                <td>
                                    {{-- Dropdown menu. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate5FieldType') === 2)
                                        @if (config('app.gSystemConfig.configBackendDateFormat') === 1)
                                            <select id="categories_date5_day" name="date5_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate5Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate5DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date5_month" name="date5_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate5Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate5DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date5_year" name="date5_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate5Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate5DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select id="categories_date5_month" name="date5_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate5Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate5DateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date5_day" name="date5_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate5Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate5DateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="categories_date5_year" name="date5_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate5Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate5DateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif


                                    {{-- js-datepicker. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate5FieldType') === 11)
                                        <input type="text" id="categories_date5" name="date5" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate5_print'] }}" />
                                        <script>
                                            const dpDate5 = datepicker("#categories_date5",
                                                // Generic date.
                                                {{ config('app.gSystemConfig.configCategoriesDate5Type') === 1 || config('app.gSystemConfig.configCategoriesDate5Type') === 2 || config('app.gSystemConfig.configCategoriesDate5Type') === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                // Birth date.
                                                {{ config('app.gSystemConfig.configCategoriesDate5Type') === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                // Task date.
                                                {{ config('app.gSystemConfig.configCategoriesDate5Type') === 5 || config('app.gSystemConfig.configCategoriesDate5Type') === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                // History date.
                                                {{ config('app.gSystemConfig.configCategoriesDate5Type') === 6 || config('app.gSystemConfig.configCategoriesDate5Type') === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
                                            );
                                        </script>
                                    @endif

                                    {{-- Complete and Semi-complete date. --}}
                                    @if (config('app.gSystemConfig.configCategoriesDate5Type') === 2 || config('app.gSystemConfig.configCategoriesDate5Type') === 3 || config('app.gSystemConfig.configCategoriesDate5Type') === 55 || config('app.gSystemConfig.configCategoriesDate5Type') === 66)
                                        -
                                        <select id="categories_date5_hour" name="date5_hour" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate5Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate5DateHour'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        :
                                        <select id="categories_date5_minute" name="date5_minute" class="ss-backend-field-dropdown01">
                                            @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate5Type')]) as $arrayRow)
                                                <option
                                                    value="{{ $arrayRow }}"
                                                    {{ $ocdRecord['tblCategoriesDate5DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                >
                                                    {{ $arrayRow }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (config('app.gSystemConfig.configCategoriesDate5Type') === 2)
                                            :
                                            <select id="categories_date5_seconds" name="date5_seconds" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, ['dateType' => config('app.gSystemConfig.configCategoriesDate5Type')]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate5DateSecond'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesImageMain') === 1)
                            <tr id="inputRowCategories_image_main" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemImage') }}:
                                </td>
                                <td>
                                    {{-- TODO: test to check if this verification can be change to === (_resObjReturn.objReturn.returnStatus == true). --}}
                                    <input type="file" id="categories_image_main" name="image_main" class="ss-backend-field-file-upload" />
                                    @if ($ocdRecord['tblCategoriesImageMain'] !== '')
                                        <img id="imgCategoriesImageMain" src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $ocdRecord['tblCategoriesImageMain'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                        {{-- TODO: investigate why this stopped working after config refactor (configSystemURLSSL) - maybe it never worked and it was supposed to change to API. --}}
                                        <div id="divCategoriesImageMainDelete" style="position: relative; display: inline-block;">
                                            <a class="ss-backend-delete01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                            {
                                                                                idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                strTable: '{{ config('app.gSystemConfig.configSystemDBTableCategories') }}',
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
                                                                                    htmlGenericStyle01('imgCategoriesImageMain', 'display', 'none');
                                                                                    htmlGenericStyle01('divCategoriesImageMainDelete', 'display', 'none');

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

                        @if (config('app.gSystemConfig.enableCategoriesFile1') === 1)
                            <tr id="inputRowCategories_file1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFile1') }}:
                                </td>
                                <td>
                                    <input type="file" id="categories_file1" name="file1" class="ss-backend-field-file-upload" />
                                    @if ($ocdRecord['tblCategoriesFile1'] !== '')
                                        {{-- Image. --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile1Type') === 1)
                                            <img id="imgCategoriesFile1" src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $ocdRecord['tblCategoriesFile1'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                        @endif

                                        {{-- File (download). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile1Type') === 3)
                                            <a id="imgCategoriesFile1" download href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile1'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile1'] }}
                                            </a>
                                        @endif

                                        {{-- File (open direct). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile1Type') === 34)
                                            <a id="imgCategoriesFile1" href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile1'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile1'] }}
                                            </a>
                                        @endif

                                        <div id="divCategoriesFile1Delete" style="position: relative; display: inline-block;">
                                            <a class="ss-backend-delete01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                            {
                                                                                idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                strTable: '{{ config('app.gSystemConfig.configSystemDBTableCategories') }}',
                                                                                strField: 'file1',
                                                                                recordValue: '',
                                                                                patchType: 'fileDelete',
                                                                                ajaxFunction: true,
                                                                                apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                            },
                                                                            async function(_resObjReturn) {
                                                                                // alert(JSON.stringify(_resObjReturn));

                                                                                if (_resObjReturn.returnStatus === true) {
                                                                                    // Delete files.


                                                                                    // Hide elements.
                                                                                    htmlGenericStyle01('imgCategoriesFile1', 'display', 'none');
                                                                                    htmlGenericStyle01('divCategoriesFile1Delete', 'display', 'none');

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

                        @if (config('app.gSystemConfig.enableCategoriesFile2') === 1)
                            <tr id="inputRowCategories_file2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFile2') }}:
                                </td>
                                <td>
                                    <input type="file" id="categories_file2" name="file2" class="ss-backend-field-file-upload" />
                                    @if ($ocdRecord['tblCategoriesFile2'] !== '')
                                        {{-- Image. --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile2Type') === 1)
                                            <img id="imgCategoriesFile2" src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $ocdRecord['tblCategoriesFile2'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                        @endif

                                        {{-- File (download). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile2Type') === 3)
                                            <a id="imgCategoriesFile2" download href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile2'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile2'] }}
                                            </a>
                                        @endif

                                        {{-- File (open direct). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile2Type') === 34)
                                            <a id="imgCategoriesFile2" href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile2'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile2'] }}
                                            </a>
                                        @endif

                                        <div id="divCategoriesFile2Delete" style="position: relative; display: inline-block;">
                                            <a class="ss-backend-delete01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                            {
                                                                                idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                strTable: '{{ config('app.gSystemConfig.configSystemDBTableCategories') }}',
                                                                                strField: 'file2',
                                                                                recordValue: '',
                                                                                patchType: 'fileDelete',
                                                                                ajaxFunction: true,
                                                                                apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                            },
                                                                            async function(_resObjReturn) {
                                                                                // alert(JSON.stringify(_resObjReturn));

                                                                                if (_resObjReturn.returnStatus === true) {
                                                                                    // Delete files.


                                                                                    // Hide elements.
                                                                                    htmlGenericStyle01('imgCategoriesFile2', 'display', 'none');
                                                                                    htmlGenericStyle01('divCategoriesFile2Delete', 'display', 'none');

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

                        @if (config('app.gSystemConfig.enableCategoriesFile3') === 1)
                            <tr id="inputRowCategories_file3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFile3') }}:
                                </td>
                                <td>
                                    <input type="file" id="categories_file3" name="file3" class="ss-backend-field-file-upload" />
                                    @if ($ocdRecord['tblCategoriesFile3'] !== '')
                                        {{-- Image. --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile3Type') === 1)
                                            <img id="imgCategoriesFile3" src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $ocdRecord['tblCategoriesFile3'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                        @endif

                                        {{-- File (download). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile3Type') === 3)
                                            <a id="imgCategoriesFile3" download href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile3'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile3'] }}
                                            </a>
                                        @endif

                                        {{-- File (open direct). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile3Type') === 34)
                                            <a id="imgCategoriesFile3" href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile3'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile3'] }}
                                            </a>
                                        @endif

                                        <div id="divCategoriesFile3Delete" style="position: relative; display: inline-block;">
                                            <a class="ss-backend-delete01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                            {
                                                                                idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                strTable: '{{ config('app.gSystemConfig.configSystemDBTableCategories') }}',
                                                                                strField: 'file3',
                                                                                recordValue: '',
                                                                                patchType: 'fileDelete',
                                                                                ajaxFunction: true,
                                                                                apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                            },
                                                                            async function(_resObjReturn) {
                                                                                // alert(JSON.stringify(_resObjReturn));

                                                                                if (_resObjReturn.returnStatus === true) {
                                                                                    // Delete files.


                                                                                    // Hide elements.
                                                                                    htmlGenericStyle01('imgCategoriesFile3', 'display', 'none');
                                                                                    htmlGenericStyle01('divCategoriesFile3Delete', 'display', 'none');

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

                        @if (config('app.gSystemConfig.enableCategoriesFile4') === 1)
                            <tr id="inputRowCategories_file4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFile4') }}:
                                </td>
                                <td>
                                    <input type="file" id="categories_file4" name="file4" class="ss-backend-field-file-upload" />
                                    @if ($ocdRecord['tblCategoriesFile4'] !== '')
                                        {{-- Image. --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile4Type') === 1)
                                            <img id="imgCategoriesFile4" src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $ocdRecord['tblCategoriesFile4'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                        @endif

                                        {{-- File (download). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile4Type') === 3)
                                            <a id="imgCategoriesFile4" download href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile4'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile4'] }}
                                            </a>
                                        @endif

                                        {{-- File (open direct). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile4Type') === 34)
                                            <a id="imgCategoriesFile4" href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile4'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile4'] }}
                                            </a>
                                        @endif

                                        <div id="divCategoriesFile4Delete" style="position: relative; display: inline-block;">
                                            <a class="ss-backend-delete01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                            {
                                                                                idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                strTable: '{{ config('app.gSystemConfig.configSystemDBTableCategories') }}',
                                                                                strField: 'file4',
                                                                                recordValue: '',
                                                                                patchType: 'fileDelete',
                                                                                ajaxFunction: true,
                                                                                apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                            },
                                                                            async function(_resObjReturn) {
                                                                                // alert(JSON.stringify(_resObjReturn));

                                                                                if (_resObjReturn.returnStatus === true) {
                                                                                    // Delete files.


                                                                                    // Hide elements.
                                                                                    htmlGenericStyle01('imgCategoriesFile4', 'display', 'none');
                                                                                    htmlGenericStyle01('divCategoriesFile4Delete', 'display', 'none');

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

                        @if (config('app.gSystemConfig.enableCategoriesFile5') === 1)
                            <tr id="inputRowCategories_file5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFile5') }}:
                                </td>
                                <td>
                                    <input type="file" id="categories_file5" name="file5" class="ss-backend-field-file-upload" />
                                    @if ($ocdRecord['tblCategoriesFile5'] !== '')
                                        {{-- Image. --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile5Type') === 1)
                                            <img id="imgCategoriesFile5" src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $ocdRecord['tblCategoriesFile5'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                        @endif

                                        {{-- File (download). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile5Type') === 3)
                                            <a id="imgCategoriesFile5" download href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile5'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile5'] }}
                                            </a>
                                        @endif

                                        {{-- File (open direct). --}}
                                        @if (config('app.gSystemConfig.configCategoriesFile5Type') === 34)
                                            <a id="imgCategoriesFile5" href="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/' . $ocdRecord['tblCategoriesFile5'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                {{ $ocdRecord['tblCategoriesFile5'] }}
                                            </a>
                                        @endif

                                        <div id="divCategoriesFile5Delete" style="position: relative; display: inline-block;">
                                            <a class="ss-backend-delete01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                            {
                                                                                idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                strTable: '{{ config('app.gSystemConfig.configSystemDBTableCategories') }}',
                                                                                strField: 'file5',
                                                                                recordValue: '',
                                                                                patchType: 'fileDelete',
                                                                                ajaxFunction: true,
                                                                                apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                            },
                                                                            async function(_resObjReturn) {
                                                                                // alert(JSON.stringify(_resObjReturn));

                                                                                if (_resObjReturn.returnStatus === true) {
                                                                                    // Delete files.


                                                                                    // Hide elements.
                                                                                    htmlGenericStyle01('imgCategoriesFile5', 'display', 'none');
                                                                                    htmlGenericStyle01('divCategoriesFile5Delete', 'display', 'none');

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

                        <tr id="inputRowCategories_activation" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation') }}:
                            </td>
                            <td>
                                <select id="categories_activation" name="activation" class="ss-backend-field-dropdown01">
                                    <option value="1"{{ $ocdRecord['tblCategoriesActivation'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                    <option value="0"{{ $ocdRecord['tblCategoriesActivation'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                </select>
                            </td>
                        </tr>

                        @if (config('app.gSystemConfig.enableCategoriesActivation1') === 1)
                            <tr id="inputRowCategories_activation1" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesActivation1') }}:
                                </td>
                                <td>
                                    <select id="categories_activation1" name="activation1" class="ss-backend-field-dropdown01">
                                        <option value="1"{{ $ocdRecord['tblCategoriesActivation1'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ocdRecord['tblCategoriesActivation1'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesActivation2') === 1)
                            <tr id="inputRowCategories_activation2" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesActivation2') }}:
                                </td>
                                <td>
                                    <select id="categories_activation2" name="activation2" class="ss-backend-field-dropdown01">
                                        <option value="1"{{ $ocdRecord['tblCategoriesActivation2'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ocdRecord['tblCategoriesActivation2'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesActivation3') === 1)
                            <tr id="inputRowCategories_activation3" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesActivation3') }}:
                                </td>
                                <td>
                                    <select id="categories_activation3" name="activation3" class="ss-backend-field-dropdown01">
                                        <option value="1"{{ $ocdRecord['tblCategoriesActivation3'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ocdRecord['tblCategoriesActivation3'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesActivation4') === 1)
                            <tr id="inputRowCategories_activation4" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesActivation4') }}:
                                </td>
                                <td>
                                    <select id="categories_activation4" name="activation4" class="ss-backend-field-dropdown01">
                                        <option value="1"{{ $ocdRecord['tblCategoriesActivation4'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ocdRecord['tblCategoriesActivation4'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesActivation5') === 1)
                            <tr id="inputRowCategories_activation5" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesActivation5') }}:
                                </td>
                                <td>
                                    <select id="categories_activation5" name="activation5" class="ss-backend-field-dropdown01">
                                        <option value="1"{{ $ocdRecord['tblCategoriesActivation5'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ocdRecord['tblCategoriesActivation5'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesStatus') === 1)
                            <tr id="inputRowCategories_id_status" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesStatus') }}:
                                </td>
                                <td>
                                    <select id="categories_id_status" name="id_status" class="ss-backend-field-dropdown01">
                                        <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemDropDownSelectNone') }}</option>

                                        {{--${resultsCategoriesStatusListing
                                            .map((statusRow) => {
                                            return `
                                                <option value="${statusRow.id}">${SyncSystemNS.FunctionsGeneric.contentMaskRead(statusRow.title, 'db')}</option>
                                            `;
                                            })
                                            .join('')}--}}
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesRestrictedAccess') === 1)
                            <tr id="inputRowCategories_id_restricted_access" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemRestrictedAccess') }}:
                                </td>
                                <td>
                                    <select id="categories_restricted_access" name="restricted_access" class="ss-backend-field-dropdown01">
                                        <option value="0"{{ $ocdRecord['tblCategoriesRestrictedAccess'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemRestrictedAccess0') }}</option>
                                        <option value="1"{{ $ocdRecord['tblCategoriesRestrictedAccess'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemRestrictedAccess1') }}</option>
                                    </select>
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableCategoriesNotes') === 1)
                            <tr id="inputRowCategories_notes" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemNotesInternal') }}:
                                </td>
                                <td>
                                    <textarea id="categories_notes" name="notes" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesNotes_edit'] }}</textarea>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div> {{-- TODO: evaluate wrapping the div til the bottom (after the input hiddens). --}}
            {{-- TODO: transform into CSS class. --}}
            <div style="position: relative; display: block; overflow: hidden; clear: both; margin-top: 2px;">
                <button id="categories_include" name="categories_include" class="ss-backend-btn-base ss-backend-btn-action-execute" style="float: left;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendButtonUpdate') }}
                </button>

                <a onclick="history.go(-1);" class="ss-backend-btn-base ss-backend-btn-action-alert" style="float: right;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendButtonBack') }}
                </a>
            </div>

            <input type="hidden" id="categories_id" name="id" value="{{ $ocdRecord['tblCategoriesID'] }}" />
            @if (config('app.gSystemConfig.enableCategoriesIdParentEdit') === 1)
                <input type="hidden" id="categories_id_parent" name="id_parent" value="{{ $ocdRecord['tblCategoriesIdParent'] }}" />
            @endif

            <input type="hidden" id="categories_idParent" name="idParent" value="{{ $ocdRecord['tblCategoriesIdParent'] }}" />
            <input type="hidden" id="categories_pageNumber" name="pageNumber" value="{{ $pageNumber }}" />
            <input type="hidden" id="categories_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />
        </form>
    </section>
@endsection
