@php
    // Variables.
    $idTbCategories = $templateData['idTbCategories'];
    $titleCurrent = $templateData['cphTitleCurrent'];
    //$arrCategoriesDetails = $templateData['cphBody']['arrCategoriesDetails'];
    $ocdRecord = $templateData['cphBody']['ocdRecord'];

    // Meta title.
    $metaTitle = '';
    $metaTitle .= \SyncSystemNS\FunctionsGeneric::contentMaskRead($GLOBALS['configSystemClientName'], 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesTitleEdit');
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
    $metaURLCurrent .= $GLOBALS['configRouteBackendActionEdit'] . '/';
    $metaURLCurrent .= $ocdRecord['tblCategoriesID'] . '/';
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
    {{-- TODO: evaluate changing these outputs to {{}} (or {!! !!}). --}}
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
    @include('admin.partials.messages-status')

    <pre>
        @php
            // Debug.
            // var_dump($templateData['cphBody']);
            // var_dump($ocdRecord);
        @endphp
    </pre>
        {{-- Form. --}}
        <section class="ss-backend-layout-section-form01">
            <form id="formCategories" name="formCategories" method="POST" action="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/' . $GLOBALS['configRouteBackendActionEdit'] }}/?_method=PUT" enctype="multipart/form-data">
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

                          inputDataReorder([{{ implode(',', $GLOBALS['configCategoriesInputOrder']) }}]); // necessary to map the array in order to display as an array inside template literals

                        }, false);
                    </script>

                    <table id="input_table_categories" class="ss-backend-table-input01">
                        <caption class="ss-backend-table-header-text01 ss-backend-table-title">
                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesTitleTable') }}
                        </caption>
                        <thead class="ss-backend-table-bg-dark ss-backend-table-header-text01">

                        </thead>
                        <tbody class="ss-backend-table-listing-text01">
                            @if ($GLOBALS['enableCategoriesIdParentEdit'] === 1)
                                <tr id="inputRowCategories_id_parent" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemParentLink') }}:
                                    </td>
                                    <td>
                                        {{-- TODO: Convert to ajax. --}}
                                        <select id="categories_id_parent" name="id_parent" class="ss-backend-field-dropdown01">
                                            <option value="0"{{ $ocdRecord['tblCategoriesIdParent'] === 0 ? ' selected' : '' }}>
                                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemDropDownSelectRoot') }}
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

                            @if ($GLOBALS['enableCategoriesSortOrder'] === 1)
                                <tr id="inputRowCategories_sort_order" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemSortOrder') }}:
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
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesType') }}:
                                </td>
                                <td>
                                    <select id="categories_category_type" name="category_type" class="ss-backend-field-dropdown01">
                                        @foreach ($GLOBALS['configCategoryType'] as $categoryTypeRow)
                                            <option value="{{ $categoryTypeRow['category_type'] }}"{{ $ocdRecord['tblCategoriesCategoryType'] === $categoryTypeRow['category_type'] ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, $categoryTypeRow['category_type_function_label']) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            @if ($GLOBALS['enableCategoriesBindRegisterUser'] === 1)
                                <tr id="inputRowCategories_id_register_user" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesRU') }}:
                                    </td>
                                    <td>
                                        <select id="categories_id_register_user" name="id_register_user" class="ss-backend-field-dropdown01">
                                            <option value="0" selected="true">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemDropDownSelectNone') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @else
                                <input type="hidden" id="categories_id_register_user" name="id_register_user" value="0" />
                            @endif

                            <tr id="inputRowCategories_title" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesCategory') }}:
                                </td>
                                <td>
                                    <input type="text" id="categories_title" name="title" class="ss-backend-field-text01" maxlength="255" value="{{ $ocdRecord['tblCategoriesTitle'] }}" />
                                </td>
                            </tr>

                            @if ($GLOBALS['enableCategoriesDescription'] === 1)
                            <tr id="inputRowCategories_description" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDescription') }}:
                                </td>
                                <td>
                                    {{-- No formatting. --}}
                                    @if ($GLOBALS['configBackendTextBox'] === 1)
                                        <textarea id="categories_description" name="description" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesDescription_edit'] }}</textarea>
                                    @endif


                                    {{-- Quill. --}}
                                    @if ($GLOBALS['configBackendTextBox'] === 13)
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
                                    @if ($GLOBALS['configBackendTextBox'] === 15)
                                        <textarea id="categories_description" name="description" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesDescription_edit'] }}</textarea>
                                        <script>
                                            new FroalaEditor("#categories_description");
                                        </script>
                                    @endif


                                    {{-- TinyMCE. --}}
                                    @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
                                        <textarea id="categories_description" name="description" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesDescription_edit'] }}</textarea>
                                        <script>
                                            tinyMCEBackendConfig.selector = "#categories_description";
                                            tinymce.init(tinyMCEBackendConfig);
                                        </script>
                                   @endif
                                </td>
                            </tr>
                            @endif

                            @if ($GLOBALS['configCategoriesURLAlias'] === 1)
                                <tr id="inputRowCategories_url_alias" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemURLAlias') }}:
                                    </td>
                                    <td>
                                        <input type="text" id="categories_url_alias" name="url_alias" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesURLAlias'] }}" />
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesKeywordsTags'] === 1)
                                <tr id="inputRowCategories_keywords_tags" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemKeywords') }}:
                                    </td>
                                    <td>
                                        <textarea id="categories_keywords_tags" name="keywords_tags" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesKeywordsTags'] }}</textarea>
                                        <div>
                                            ({{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemKeywordsInstruction01') }})
                                        </div>
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesMetaDescription'] === 1)
                                <tr id="inputRowCategories_meta_description" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemMetaDescription') }}:
                                    </td>
                                    <td>
                                        <textarea id="categories_meta_description" name="meta_description" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesMetaDescription_edit'] }}</textarea>
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesMetaTitle'] === 1)
                                <tr id="inputRowCategories_meta_title" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemMetaTitle') }}:
                                    </td>
                                    <td>
                                        <input type="text" id="categories_meta_title" name="meta_title" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesMetaTitle'] }}" />
                                    </td>
                                </tr>
                            @endif

                            {{-- TODO: filters. --}}


                            @if ($GLOBALS['enableCategoriesInfo1'] === 1)
                                <tr id="inputRowCategories_info1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo1') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo1FieldType'] === 1)
                                            <input type="text" id="categories_info1" name="info1" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo1_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo1FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info1" name="info1" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo1_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info1" name="info1" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo1_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info1";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo1FieldType'] === 11)
                                            <input type="text" id="categories_info1" name="info1" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo1_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo1FieldType'] === 12)
                                            <textarea id="categories_info1" name="info1" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo1_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfo2'] === 1)
                                <tr id="inputRowCategories_info2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo2') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo2FieldType'] === 1)
                                            <input type="text" id="categories_info2" name="info2" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo2_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo2FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info2" name="info2" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo2_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info2" name="info2" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo2_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info2";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo2FieldType'] === 11)
                                            <input type="text" id="categories_info2" name="info2" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo2_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo2FieldType'] === 12)
                                            <textarea id="categories_info2" name="info2" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo2_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfo3'] === 1)
                                <tr id="inputRowCategories_info3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo3') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo3FieldType'] === 1)
                                            <input type="text" id="categories_info3" name="info3" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo3_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo3FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info3" name="info3" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo3_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info3" name="info3" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo3_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info3";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo3FieldType'] === 11)
                                            <input type="text" id="categories_info3" name="info3" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo3_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo3FieldType'] === 12)
                                            <textarea id="categories_info3" name="info3" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo3_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfo4'] === 1)
                                <tr id="inputRowCategories_info4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo4') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo4FieldType'] === 1)
                                            <input type="text" id="categories_info4" name="info4" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo4_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo4FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info4" name="info4" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo4_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info4" name="info4" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo4_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info4";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo4FieldType'] === 11)
                                            <input type="text" id="categories_info4" name="info4" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo4_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo4FieldType'] === 12)
                                            <textarea id="categories_info4" name="info4" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo4_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfo5'] === 1)
                                <tr id="inputRowCategories_info5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo5') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo5FieldType'] === 1)
                                            <input type="text" id="categories_info5" name="info5" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo5_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo5FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info5" name="info5" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo5_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info5" name="info5" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo5_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info5";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo5FieldType'] === 11)
                                            <input type="text" id="categories_info5" name="info5" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo5_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo5FieldType'] === 12)
                                            <textarea id="categories_info5" name="info5" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo5_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfo6'] === 1)
                                <tr id="inputRowCategories_info6" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo6') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo6FieldType'] === 1)
                                            <input type="text" id="categories_info6" name="info6" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo6_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo6FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info6" name="info6" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo6_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info6" name="info6" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo6_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info6";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo6FieldType'] === 11)
                                            <input type="text" id="categories_info6" name="info6" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo6_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo6FieldType'] === 12)
                                            <textarea id="categories_info6" name="info6" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo6_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfo7'] === 1)
                                <tr id="inputRowCategories_info7" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo7') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo7FieldType'] === 1)
                                            <input type="text" id="categories_info7" name="info7" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo7_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo7FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info7" name="info7" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo7_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info7" name="info7" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo7_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info7";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo7FieldType'] === 11)
                                            <input type="text" id="categories_info7" name="info7" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo7_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo7FieldType'] === 12)
                                            <textarea id="categories_info7" name="info7" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo7_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfo8'] === 1)
                                <tr id="inputRowCategories_info8" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo8') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo8FieldType'] === 1)
                                            <input type="text" id="categories_info8" name="info8" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo8_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo8FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info8" name="info8" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo8_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info8" name="info8" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo8_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info8";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo8FieldType'] === 11)
                                            <input type="text" id="categories_info8" name="info8" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo8_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo8FieldType'] === 12)
                                            <textarea id="categories_info8" name="info8" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo8_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfo9'] === 1)
                                <tr id="inputRowCategories_info9" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo9') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo9FieldType'] === 1)
                                            <input type="text" id="categories_info9" name="info9" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo9_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo9FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info9" name="info9" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo9_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info9" name="info9" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo9_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info9";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo9FieldType'] === 11)
                                            <input type="text" id="categories_info9" name="info9" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo9_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo9FieldType'] === 12)
                                            <textarea id="categories_info9" name="info9" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo9_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfo10'] === 1)
                                <tr id="inputRowCategories_info10" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo10') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfo10FieldType'] === 1)
                                            <input type="text" id="categories_info10" name="info10" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo10_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo10FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info10" name="info10" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo10_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info10" name="info10" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo10_edit'] }}</textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info10";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo10FieldType'] === 11)
                                            <input type="text" id="categories_info10" name="info10" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfo10_edit'] }}" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo10FieldType'] === 12)
                                            <textarea id="categories_info10" name="info10" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfo10_edit'] }}</textarea>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesInfoS1'] === 1)
                                <tr id="inputRowCategories_info_small1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS1') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfoS1FieldType'] === 1)
                                            <input type="text" id="categories_info_small1" name="info_small1" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall1_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS1FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small1" name="info_small1" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall1_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
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

                            @if ($GLOBALS['enableCategoriesInfoS2'] === 1)
                                <tr id="inputRowCategories_info_small2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS2') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfoS2FieldType'] === 1)
                                            <input type="text" id="categories_info_small2" name="info_small2" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall2_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS2FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small2" name="info_small2" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall2_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
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

                            @if ($GLOBALS['enableCategoriesInfoS3'] === 1)
                                <tr id="inputRowCategories_info_small3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS3') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfoS3FieldType'] === 1)
                                            <input type="text" id="categories_info_small3" name="info_small3" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall3_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS3FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small3" name="info_small3" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall3_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
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

                            @if ($GLOBALS['enableCategoriesInfoS4'] === 1)
                                <tr id="inputRowCategories_info_small4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS4') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfoS4FieldType'] === 1)
                                            <input type="text" id="categories_info_small4" name="info_small4" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall4_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS4FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small4" name="info_small4" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall4_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
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

                            @if ($GLOBALS['enableCategoriesInfoS5'] === 1)
                                <tr id="inputRowCategories_info_small5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS5') }}:
                                    </td>
                                    <td>
                                        {{-- Single line. --}}
                                        @if ($GLOBALS['configCategoriesInfoS5FieldType'] === 1)
                                            <input type="text" id="categories_info_small5" name="info_small5" class="ss-backend-field-text01" value="{{ $ocdRecord['tblCategoriesInfoSmall5_edit'] }}" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS5FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small5" name="info_small5" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesInfoSmall5_edit'] }}</textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
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

                            @if ($GLOBALS['enableCategoriesNumber1'] === 1)
                                <tr id="inputRowCategories_number1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber1') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumber1FieldType'] === 1)
                                            <input type="text" id="categories_number1" name="number1" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber1_print'] }}" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number1");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber1FieldType'] === 2 || $GLOBALS['configCategoriesNumber1FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number1" name="number1" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber1_print'] }}" maxlength="45" />

                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number1");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber1FieldType'] === 3)
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

                            @if ($GLOBALS['enableCategoriesNumber2'] === 1)
                                <tr id="inputRowCategories_number2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber2') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumber2FieldType'] === 1)
                                            <input type="text" id="categories_number2" name="number2" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber2_print'] }}" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number2");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber2FieldType'] === 2 || $GLOBALS['configCategoriesNumber2FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number2" name="number2" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber2_print'] }}" maxlength="45" />

                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number2");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber2FieldType'] === 3)
                                            <input type="text" id="categories_number2" name="number2" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber2_print'] }}" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number2");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesNumber3'] === 1)
                                <tr id="inputRowCategories_number3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber3') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumber3FieldType'] === 1)
                                            <input type="text" id="categories_number3" name="number3" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber3_print'] }}" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number3");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber3FieldType'] === 2 || $GLOBALS['configCategoriesNumber3FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number3" name="number3" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber3_print'] }}" maxlength="45" />

                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number3");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber3FieldType'] === 3)
                                            <input type="text" id="categories_number3" name="number3" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber3_print'] }}" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number3");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesNumber4'] === 1)
                                <tr id="inputRowCategories_number4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber4') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumber4FieldType'] === 1)
                                            <input type="text" id="categories_number4" name="number4" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber4_print'] }}" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number4");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber4FieldType'] === 2 || $GLOBALS['configCategoriesNumber4FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number4" name="number4" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber4_print'] }}" maxlength="45" />

                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number4");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber4FieldType'] === 3)
                                            <input type="text" id="categories_number4" name="number4" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber4_print'] }}" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number4");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesNumber5'] === 1)
                                <tr id="inputRowCategories_number5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber5') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumber5FieldType'] === 1)
                                            <input type="text" id="categories_number5" name="number5" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber5_print'] }}" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number5");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber5FieldType'] === 2 || $GLOBALS['configCategoriesNumber5FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number5" name="number5" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumber5_print'] }}" maxlength="45" />

                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number5");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber5FieldType'] === 3)
                                            <input type="text" id="categories_number5" name="number5" class="ss-backend-field-numeric02" value="{{ $ocdRecord['tblCategoriesNumber5_print'] }}" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number5");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesNumberS1'] === 1)
                                <tr id="inputRowCategories_number_small1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS1') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumberS1FieldType'] === 1)
                                            <input type="text" id="categories_number_small1" name="number_small1" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall1_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small1");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS1FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small1" name="number_small1" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall1_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small1");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesNumberS2'] === 1)
                                <tr id="inputRowCategories_number_small2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS2') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumberS2FieldType'] === 1)
                                            <input type="text" id="categories_number_small2" name="number_small2" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall2_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small2");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS2FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small2" name="number_small2" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall2_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small2");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesNumberS3'] === 1)
                                <tr id="inputRowCategories_number_small3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS3') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumberS3FieldType'] === 1)
                                            <input type="text" id="categories_number_small3" name="number_small3" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall3_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small3");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS3FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small3" name="number_small3" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall3_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small3");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesNumberS4'] === 1)
                                <tr id="inputRowCategories_number_small4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS4') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumberS4FieldType'] === 1)
                                            <input type="text" id="categories_number_small4" name="number_small4" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall4_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small4");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS4FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small4" name="number_small4" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall4_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small4");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesNumberS5'] === 1)
                                <tr id="inputRowCategories_number_small5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS5') }}:
                                    </td>
                                    <td>
                                        {{-- General number. --}}
                                        @if ($GLOBALS['configCategoriesNumberS5FieldType'] === 1)
                                            <input type="text" id="categories_number_small5" name="number_small5" class="ss-backend-field-numeric01" value="{{ $ocdRecord['tblCategoriesNumberSmall5_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small5");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS5FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small5" name="number_small5" class="ss-backend-field-currency01" value="{{ $ocdRecord['tblCategoriesNumberSmall5_print'] }}" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small5");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesDate1'] === 1)
                                <tr id="inputRowCategories_date1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate1') }}:
                                    </td>
                                    <td>
                                        {{-- Dropdown menu. --}}
                                        @if ($GLOBALS['configCategoriesDate1FieldType'] === 2)
                                            @if ($GLOBALS['configBackendDateFormat'] === 1)
                                                <select id="categories_date1_day" name="date1_day" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate1Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate1Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate1Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate1Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate1Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate1Type']]) as $arrayRow)
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
                                        @if ($GLOBALS['configCategoriesDate1FieldType'] === 11)
                                            <input type="text" id="categories_date1" name="date1" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate1_print'] }}" />
                                            <script>
                                                const dpDate1 = datepicker("#categories_date1",
                                                    // Generic date.
                                                    {{ $GLOBALS['configCategoriesDate1Type'] === 1 || $GLOBALS['configCategoriesDate1Type'] === 2 || $GLOBALS['configCategoriesDate1Type'] === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                    // Birth date.
                                                    {{ $GLOBALS['configCategoriesDate1Type'] === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                    // Task date.
                                                    {{ $GLOBALS['configCategoriesDate1Type'] === 5 || $GLOBALS['configCategoriesDate1Type'] === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                    // History date.
                                                    {{ $GLOBALS['configCategoriesDate1Type'] === 6 || $GLOBALS['configCategoriesDate1Type'] === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
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
                                        @if ($GLOBALS['configCategoriesDate1Type'] === 2 || $GLOBALS['configCategoriesDate1Type'] === 3 || $GLOBALS['configCategoriesDate1Type'] === 55 || $GLOBALS['configCategoriesDate1Type'] === 66)
                                            -
                                            <select id="categories_date1_hour" name="date1_hour" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, [ 'dateType' => $GLOBALS['configCategoriesDate1Type']]) as $arrayRow)
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
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, [ 'dateType' => $GLOBALS['configCategoriesDate1Type']]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate1DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($GLOBALS['configCategoriesDate1Type'] === 2)
                                                :
                                                <select id="categories_date1_seconds" name="date1_seconds" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, [ 'dateType' => $GLOBALS['configCategoriesDate1Type']]) as $arrayRow)
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

                            @if ($GLOBALS['enableCategoriesDate2'] === 1)
                                <tr id="inputRowCategories_date2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate2') }}:
                                    </td>
                                    <td>
                                        {{-- Dropdown menu. --}}
                                        @if ($GLOBALS['configCategoriesDate2FieldType'] === 2)
                                            @if ($GLOBALS['configBackendDateFormat'] === 1)
                                                <select id="categories_date2_day" name="date2_day" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate2Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate2Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate2Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate2Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate2Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate2Type']]) as $arrayRow)
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
                                        @if ($GLOBALS['configCategoriesDate2FieldType'] === 11)
                                            <input type="text" id="categories_date2" name="date2" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate2_print'] }}" />
                                            <script>
                                                const dpDate2 = datepicker("#categories_date2",
                                                    // Generic date.
                                                    {{ $GLOBALS['configCategoriesDate2Type'] === 1 || $GLOBALS['configCategoriesDate2Type'] === 2 || $GLOBALS['configCategoriesDate2Type'] === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                    // Birth date.
                                                    {{ $GLOBALS['configCategoriesDate2Type'] === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                    // Task date.
                                                    {{ $GLOBALS['configCategoriesDate2Type'] === 5 || $GLOBALS['configCategoriesDate2Type'] === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                    // History date.
                                                    {{ $GLOBALS['configCategoriesDate2Type'] === 6 || $GLOBALS['configCategoriesDate2Type'] === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
                                                );
                                            </script>
                                        @endif

                                        {{-- Complete and Semi-complete date. --}}
                                        @if ($GLOBALS['configCategoriesDate2Type'] === 2 || $GLOBALS['configCategoriesDate2Type'] === 3 || $GLOBALS['configCategoriesDate2Type'] === 55 || $GLOBALS['configCategoriesDate2Type'] === 66)
                                            -
                                            <select id="categories_date2_hour" name="date2_hour" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, [ 'dateType' => $GLOBALS['configCategoriesDate2Type']]) as $arrayRow)
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
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, [ 'dateType' => $GLOBALS['configCategoriesDate2Type']]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate2DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($GLOBALS['configCategoriesDate2Type'] === 2)
                                                :
                                                <select id="categories_date2_seconds" name="date2_seconds" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, [ 'dateType' => $GLOBALS['configCategoriesDate2Type']]) as $arrayRow)
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

                            @if ($GLOBALS['enableCategoriesDate3'] === 1)
                                <tr id="inputRowCategories_date3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate3') }}:
                                    </td>
                                    <td>
                                        {{-- Dropdown menu. --}}
                                        @if ($GLOBALS['configCategoriesDate3FieldType'] === 2)
                                            @if ($GLOBALS['configBackendDateFormat'] === 1)
                                                <select id="categories_date3_day" name="date3_day" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate3Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate3Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate3Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate3Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate3Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate3Type']]) as $arrayRow)
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
                                        @if ($GLOBALS['configCategoriesDate3FieldType'] === 11)
                                            <input type="text" id="categories_date3" name="date3" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate3_print'] }}" />
                                            <script>
                                                const dpDate3 = datepicker("#categories_date3",
                                                    // Generic date.
                                                    {{ $GLOBALS['configCategoriesDate3Type'] === 1 || $GLOBALS['configCategoriesDate3Type'] === 2 || $GLOBALS['configCategoriesDate3Type'] === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                    // Birth date.
                                                    {{ $GLOBALS['configCategoriesDate3Type'] === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                    // Task date.
                                                    {{ $GLOBALS['configCategoriesDate3Type'] === 5 || $GLOBALS['configCategoriesDate3Type'] === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                    // History date.
                                                    {{ $GLOBALS['configCategoriesDate3Type'] === 6 || $GLOBALS['configCategoriesDate3Type'] === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
                                                );
                                            </script>
                                        @endif

                                        {{-- Complete and Semi-complete date. --}}
                                        @if ($GLOBALS['configCategoriesDate3Type'] === 2 || $GLOBALS['configCategoriesDate3Type'] === 3 || $GLOBALS['configCategoriesDate3Type'] === 55 || $GLOBALS['configCategoriesDate3Type'] === 66)
                                            -
                                            <select id="categories_date3_hour" name="date3_hour" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, [ 'dateType' => $GLOBALS['configCategoriesDate3Type']]) as $arrayRow)
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
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, [ 'dateType' => $GLOBALS['configCategoriesDate3Type']]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate3DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($GLOBALS['configCategoriesDate3Type'] === 2)
                                                :
                                                <select id="categories_date3_seconds" name="date3_seconds" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, [ 'dateType' => $GLOBALS['configCategoriesDate3Type']]) as $arrayRow)
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

                            @if ($GLOBALS['enableCategoriesDate4'] === 1)
                                <tr id="inputRowCategories_date4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate4') }}:
                                    </td>
                                    <td>
                                        {{-- Dropdown menu. --}}
                                        @if ($GLOBALS['configCategoriesDate4FieldType'] === 2)
                                            @if ($GLOBALS['configBackendDateFormat'] === 1)
                                                <select id="categories_date4_day" name="date4_day" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate4Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate4Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate4Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate4Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate4Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate4Type']]) as $arrayRow)
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
                                        @if ($GLOBALS['configCategoriesDate4FieldType'] === 11)
                                            <input type="text" id="categories_date4" name="date4" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate4_print'] }}" />
                                            <script>
                                                const dpDate4 = datepicker("#categories_date4",
                                                    // Generic date.
                                                    {{ $GLOBALS['configCategoriesDate4Type'] === 1 || $GLOBALS['configCategoriesDate4Type'] === 2 || $GLOBALS['configCategoriesDate4Type'] === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                    // Birth date.
                                                    {{ $GLOBALS['configCategoriesDate4Type'] === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                    // Task date.
                                                    {{ $GLOBALS['configCategoriesDate4Type'] === 5 || $GLOBALS['configCategoriesDate4Type'] === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                    // History date.
                                                    {{ $GLOBALS['configCategoriesDate4Type'] === 6 || $GLOBALS['configCategoriesDate4Type'] === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
                                                );
                                            </script>
                                        @endif

                                        {{-- Complete and Semi-complete date. --}}
                                        @if ($GLOBALS['configCategoriesDate4Type'] === 2 || $GLOBALS['configCategoriesDate4Type'] === 3 || $GLOBALS['configCategoriesDate4Type'] === 55 || $GLOBALS['configCategoriesDate4Type'] === 66)
                                            -
                                            <select id="categories_date4_hour" name="date4_hour" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, [ 'dateType' => $GLOBALS['configCategoriesDate4Type']]) as $arrayRow)
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
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, [ 'dateType' => $GLOBALS['configCategoriesDate4Type']]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate4DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($GLOBALS['configCategoriesDate4Type'] === 2)
                                                :
                                                <select id="categories_date4_seconds" name="date4_seconds" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, [ 'dateType' => $GLOBALS['configCategoriesDate4Type']]) as $arrayRow)
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

                            @if ($GLOBALS['enableCategoriesDate5'] === 1)
                                <tr id="inputRowCategories_date5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate5') }}:
                                    </td>
                                    <td>
                                        {{-- Dropdown menu. --}}
                                        @if ($GLOBALS['configCategoriesDate5FieldType'] === 2)
                                            @if ($GLOBALS['configBackendDateFormat'] === 1)
                                                <select id="categories_date5_day" name="date5_day" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate5Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate5Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate5Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, [ 'dateType' => $GLOBALS['configCategoriesDate5Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, [ 'dateType' => $GLOBALS['configCategoriesDate5Type']]) as $arrayRow)
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
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, [ 'dateType' => $GLOBALS['configCategoriesDate5Type']]) as $arrayRow)
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
                                        @if ($GLOBALS['configCategoriesDate5FieldType'] === 11)
                                            <input type="text" id="categories_date5" name="date5" class="ss-backend-field-date01" autocomplete="off" value="{{ $ocdRecord['tblCategoriesDate5_print'] }}" />
                                            <script>
                                                const dpDate5 = datepicker("#categories_date5",
                                                    // Generic date.
                                                    {{ $GLOBALS['configCategoriesDate5Type'] === 1 || $GLOBALS['configCategoriesDate5Type'] === 2 || $GLOBALS['configCategoriesDate5Type'] === 3 ? 'jsDatepickerGenericBackendConfigOptions' : '' }}

                                                    // Birth date.
                                                    {{ $GLOBALS['configCategoriesDate5Type'] === 4 ? 'jsDatepickerBirthBackendConfigOptions' : '' }}

                                                    // Task date.
                                                    {{ $GLOBALS['configCategoriesDate5Type'] === 5 || $GLOBALS['configCategoriesDate5Type'] === 5  ? 'jsDatepickerTaskBackendConfigOptions' : '' }}

                                                    // History date.
                                                    {{ $GLOBALS['configCategoriesDate5Type'] === 6 || $GLOBALS['configCategoriesDate5Type'] === 66  ? 'jsDatepickerHistoryBackendConfigOptions' : '' }}
                                                );
                                            </script>
                                        @endif

                                        {{-- Complete and Semi-complete date. --}}
                                        @if ($GLOBALS['configCategoriesDate5Type'] === 2 || $GLOBALS['configCategoriesDate5Type'] === 3 || $GLOBALS['configCategoriesDate5Type'] === 55 || $GLOBALS['configCategoriesDate5Type'] === 66)
                                            -
                                            <select id="categories_date5_hour" name="date5_hour" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('h', 1, [ 'dateType' => $GLOBALS['configCategoriesDate5Type']]) as $arrayRow)
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
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('m', 1, [ 'dateType' => $GLOBALS['configCategoriesDate5Type']]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $ocdRecord['tblCategoriesDate5DateMinute'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($GLOBALS['configCategoriesDate5Type'] === 2)
                                                :
                                                <select id="categories_date5_seconds" name="date5_seconds" class="ss-backend-field-dropdown01">
                                                    @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('s', 1, [ 'dateType' => $GLOBALS['configCategoriesDate5Type']]) as $arrayRow)
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

                            @if ($GLOBALS['enableCategoriesImageMain'] === 1)
                                <tr id="inputRowCategories_image_main" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemImage') }}:
                                    </td>
                                    <td>
                                        {{-- TODO: test to check if this verification can be change to === (_resObjReturn.objReturn.returnStatus == true). --}}
                                        <input type="file" id="categories_image_main" name="image_main" class="ss-backend-field-file-upload" />
                                        @if ($ocdRecord['tblCategoriesImageMain'] !== '')
                                            <img id="imgCategoriesImageMain" src="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/t' . $ocdRecord['tblCategoriesImageMain'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                            <div id="divCategoriesImageMainDelete" style="position: relative; display: inline-block;">
                                                <a class="ss-backend-delete01"
                                                    onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                    ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                {
                                                                                    idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                    strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}',
                                                                                    strField:'image_main',
                                                                                    recordValue: '',
                                                                                    patchType: 'fileDelete',
                                                                                    ajaxFunction: true,
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                },
                                                                                async function(_resObjReturn){
                                                                                    // alert(JSON.stringify(_resObjReturn));

                                                                                    if(_resObjReturn.objReturn.returnStatus == true)
                                                                                    {
                                                                                        // Delete files.


                                                                                        // Hide elements.
                                                                                        htmlGenericStyle01('imgCategoriesImageMain', 'display', 'none');
                                                                                        htmlGenericStyle01('divCategoriesImageMainDelete', 'display', 'none');

                                                                                        // Success message.
                                                                                        elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage6') }}');

                                                                                    }else{
                                                                                        // Show error.
                                                                                        elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                    }

                                                                                    // Hide ajax progress bar.
                                                                                    htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                });">
                                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemImageDelete') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesFile1'] === 1)
                                <tr id="inputRowCategories_file1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile1') }}:
                                    </td>
                                    <td>
                                        <input type="file" id="categories_file1" name="file1" class="ss-backend-field-file-upload" />
                                        @if ($ocdRecord['tblCategoriesFile1'] !== '')
                                            {{-- Image. --}}
                                            @if ($GLOBALS['configCategoriesFile1Type'] === 1)
                                                <img id="imgCategoriesFile1" src="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/t' . $ocdRecord['tblCategoriesFile1'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                            @endif

                                            {{-- File (download). --}}
                                            @if ($GLOBALS['configCategoriesFile1Type'] === 3)
                                                <a id="imgCategoriesFile1" download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile1'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile1'] }}
                                                </a>
                                            @endif

                                            {{-- File (open direct). --}}
                                            @if ($GLOBALS['configCategoriesFile1Type'] === 34)
                                                <a id="imgCategoriesFile1" href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile1'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile1'] }}
                                                </a>
                                            @endif

                                            <div id="divCategoriesFile1Delete" style="position: relative; display: inline-block;">
                                                <a class="ss-backend-delete01"
                                                    onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                    ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                {
                                                                                    idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                    strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}',
                                                                                    strField:'file1',
                                                                                    recordValue: '',
                                                                                    patchType: 'fileDelete',
                                                                                    ajaxFunction: true,
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                },
                                                                                async function(_resObjReturn){
                                                                                    // alert(JSON.stringify(_resObjReturn));

                                                                                    if(_resObjReturn.objReturn.returnStatus == true)
                                                                                    {
                                                                                        // Delete files.


                                                                                        // Hide elements.
                                                                                        htmlGenericStyle01('imgCategoriesFile1', 'display', 'none');
                                                                                        htmlGenericStyle01('divCategoriesFile1Delete', 'display', 'none');

                                                                                        // Success message.
                                                                                        elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage6') }}');

                                                                                    }else{
                                                                                        // Show error.
                                                                                        elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                    }

                                                                                    // Hide ajax progress bar.
                                                                                    htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                });">
                                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemImageDelete') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesFile2'] === 1)
                                <tr id="inputRowCategories_file2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile2') }}:
                                    </td>
                                    <td>
                                        <input type="file" id="categories_file2" name="file2" class="ss-backend-field-file-upload" />
                                        @if ($ocdRecord['tblCategoriesFile2'] !== '')
                                            {{-- Image. --}}
                                            @if ($GLOBALS['configCategoriesFile2Type'] === 1)
                                                <img id="imgCategoriesFile2" src="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/t' . $ocdRecord['tblCategoriesFile2'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                            @endif

                                            {{-- File (download). --}}
                                            @if ($GLOBALS['configCategoriesFile2Type'] === 3)
                                                <a id="imgCategoriesFile2" download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile2'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile2'] }}
                                                </a>
                                            @endif

                                            {{-- File (open direct). --}}
                                            @if ($GLOBALS['configCategoriesFile2Type'] === 34)
                                                <a id="imgCategoriesFile2" href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile2'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile2'] }}
                                                </a>
                                            @endif

                                            <div id="divCategoriesFile2Delete" style="position: relative; display: inline-block;">
                                                <a class="ss-backend-delete01"
                                                    onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                    ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                {
                                                                                    idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                    strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}',
                                                                                    strField:'file2',
                                                                                    recordValue: '',
                                                                                    patchType: 'fileDelete',
                                                                                    ajaxFunction: true,
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                },
                                                                                async function(_resObjReturn){
                                                                                    // alert(JSON.stringify(_resObjReturn));

                                                                                    if(_resObjReturn.objReturn.returnStatus == true)
                                                                                    {
                                                                                        // Delete files.


                                                                                        // Hide elements.
                                                                                        htmlGenericStyle01('imgCategoriesFile2', 'display', 'none');
                                                                                        htmlGenericStyle01('divCategoriesFile2Delete', 'display', 'none');

                                                                                        // Success message.
                                                                                        elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage6') }}');

                                                                                    }else{
                                                                                        // Show error.
                                                                                        elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                    }

                                                                                    // Hide ajax progress bar.
                                                                                    htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                });">
                                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemImageDelete') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesFile3'] === 1)
                                <tr id="inputRowCategories_file3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile3') }}:
                                    </td>
                                    <td>
                                        <input type="file" id="categories_file3" name="file3" class="ss-backend-field-file-upload" />
                                        @if ($ocdRecord['tblCategoriesFile3'] !== '')
                                            {{-- Image. --}}
                                            @if ($GLOBALS['configCategoriesFile3Type'] === 1)
                                                <img id="imgCategoriesFile3" src="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/t' . $ocdRecord['tblCategoriesFile3'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                            @endif

                                            {{-- File (download). --}}
                                            @if ($GLOBALS['configCategoriesFile3Type'] === 3)
                                                <a id="imgCategoriesFile3" download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile3'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile3'] }}
                                                </a>
                                            @endif

                                            {{-- File (open direct). --}}
                                            @if ($GLOBALS['configCategoriesFile3Type'] === 34)
                                                <a id="imgCategoriesFile3" href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile3'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile3'] }}
                                                </a>
                                            @endif

                                            <div id="divCategoriesFile3Delete" style="position: relative; display: inline-block;">
                                                <a class="ss-backend-delete01"
                                                    onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                    ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                {
                                                                                    idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                    strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}',
                                                                                    strField:'file3',
                                                                                    recordValue: '',
                                                                                    patchType: 'fileDelete',
                                                                                    ajaxFunction: true,
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                },
                                                                                async function(_resObjReturn){
                                                                                    // alert(JSON.stringify(_resObjReturn));

                                                                                    if(_resObjReturn.objReturn.returnStatus == true)
                                                                                    {
                                                                                        // Delete files.


                                                                                        // Hide elements.
                                                                                        htmlGenericStyle01('imgCategoriesFile3', 'display', 'none');
                                                                                        htmlGenericStyle01('divCategoriesFile3Delete', 'display', 'none');

                                                                                        // Success message.
                                                                                        elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage6') }}');

                                                                                    }else{
                                                                                        // Show error.
                                                                                        elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                    }

                                                                                    // Hide ajax progress bar.
                                                                                    htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                });">
                                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemImageDelete') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesFile4'] === 1)
                                <tr id="inputRowCategories_file4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile4') }}:
                                    </td>
                                    <td>
                                        <input type="file" id="categories_file4" name="file4" class="ss-backend-field-file-upload" />
                                        @if ($ocdRecord['tblCategoriesFile4'] !== '')
                                            {{-- Image. --}}
                                            @if ($GLOBALS['configCategoriesFile4Type'] === 1)
                                                <img id="imgCategoriesFile4" src="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/t' . $ocdRecord['tblCategoriesFile4'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                            @endif

                                            {{-- File (download). --}}
                                            @if ($GLOBALS['configCategoriesFile4Type'] === 3)
                                                <a id="imgCategoriesFile4" download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile4'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile4'] }}
                                                </a>
                                            @endif

                                            {{-- File (open direct). --}}
                                            @if ($GLOBALS['configCategoriesFile4Type'] === 34)
                                                <a id="imgCategoriesFile4" href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile4'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile4'] }}
                                                </a>
                                            @endif

                                            <div id="divCategoriesFile4Delete" style="position: relative; display: inline-block;">
                                                <a class="ss-backend-delete01"
                                                    onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                    ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                {
                                                                                    idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                    strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}',
                                                                                    strField:'file4',
                                                                                    recordValue: '',
                                                                                    patchType: 'fileDelete',
                                                                                    ajaxFunction: true,
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                },
                                                                                async function(_resObjReturn){
                                                                                    // alert(JSON.stringify(_resObjReturn));

                                                                                    if(_resObjReturn.objReturn.returnStatus == true)
                                                                                    {
                                                                                        // Delete files.


                                                                                        // Hide elements.
                                                                                        htmlGenericStyle01('imgCategoriesFile4', 'display', 'none');
                                                                                        htmlGenericStyle01('divCategoriesFile4Delete', 'display', 'none');

                                                                                        // Success message.
                                                                                        elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage6') }}');

                                                                                    }else{
                                                                                        // Show error.
                                                                                        elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                    }

                                                                                    // Hide ajax progress bar.
                                                                                    htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                });">
                                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemImageDelete') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesFile5'] === 1)
                                <tr id="inputRowCategories_file5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile5') }}:
                                    </td>
                                    <td>
                                        <input type="file" id="categories_file5" name="file5" class="ss-backend-field-file-upload" />
                                        @if ($ocdRecord['tblCategoriesFile5'] !== '')
                                            {{-- Image. --}}
                                            @if ($GLOBALS['configCategoriesFile5Type'] === 1)
                                                <img id="imgCategoriesFile5" src="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/t' . $ocdRecord['tblCategoriesFile5'] . '?v=' . $cacheClear }}" alt="{{ $ocdRecord['tblCategoriesTitle'] }}" class="ss-backend-images-edit" />
                                            @endif

                                            {{-- File (download). --}}
                                            @if ($GLOBALS['configCategoriesFile5Type'] === 3)
                                                <a id="imgCategoriesFile5" download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile5'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile5'] }}
                                                </a>
                                            @endif

                                            {{-- File (open direct). --}}
                                            @if ($GLOBALS['configCategoriesFile5Type'] === 34)
                                                <a id="imgCategoriesFile5" href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' . $ocdRecord['tblCategoriesFile5'] }}" target="_blank" class="ss-backend-links01 ss-backend-images-edit">
                                                    {{ $ocdRecord['tblCategoriesFile5'] }}
                                                </a>
                                            @endif

                                            <div id="divCategoriesFile5Delete" style="position: relative; display: inline-block;">
                                                <a class="ss-backend-delete01"
                                                    onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                    ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                {
                                                                                    idRecord: '{{ $ocdRecord['tblCategoriesID'] }}',
                                                                                    strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}',
                                                                                    strField:'file5',
                                                                                    recordValue: '',
                                                                                    patchType: 'fileDelete',
                                                                                    ajaxFunction: true,
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                },
                                                                                async function(_resObjReturn){
                                                                                    // alert(JSON.stringify(_resObjReturn));

                                                                                    if(_resObjReturn.objReturn.returnStatus == true)
                                                                                    {
                                                                                        // Delete files.


                                                                                        // Hide elements.
                                                                                        htmlGenericStyle01('imgCategoriesFile5', 'display', 'none');
                                                                                        htmlGenericStyle01('divCategoriesFile5Delete', 'display', 'none');

                                                                                        // Success message.
                                                                                        elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage6') }}');

                                                                                    }else{
                                                                                        // Show error.
                                                                                        elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                    }

                                                                                    // Hide ajax progress bar.
                                                                                    htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                });">
                                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemImageDelete') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            <tr id="inputRowCategories_activation" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation') }}:
                                </td>
                                <td>
                                    <select id="categories_activation" name="activation" class="ss-backend-field-dropdown01">
                                        <option value="1"{{ $ocdRecord['tblCategoriesActivation'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0"{{ $ocdRecord['tblCategoriesActivation'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
                                    </select>
                                </td>
                            </tr>

                            @if ($GLOBALS['enableCategoriesActivation1'] === 1)
                                <tr id="inputRowCategories_activation1" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation1') }}:
                                    </td>
                                    <td>
                                        <select id="categories_activation1" name="activation1" class="ss-backend-field-dropdown01">
                                            <option value="1"{{ $ocdRecord['tblCategoriesActivation1'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0"{{ $ocdRecord['tblCategoriesActivation1'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesActivation2'] === 1)
                                <tr id="inputRowCategories_activation2" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation2') }}:
                                    </td>
                                    <td>
                                        <select id="categories_activation2" name="activation2" class="ss-backend-field-dropdown01">
                                            <option value="1"{{ $ocdRecord['tblCategoriesActivation2'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0"{{ $ocdRecord['tblCategoriesActivation2'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesActivation3'] === 1)
                                <tr id="inputRowCategories_activation3" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation3') }}:
                                    </td>
                                    <td>
                                        <select id="categories_activation3" name="activation3" class="ss-backend-field-dropdown01">
                                            <option value="1"{{ $ocdRecord['tblCategoriesActivation3'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0"{{ $ocdRecord['tblCategoriesActivation3'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesActivation4'] === 1)
                                <tr id="inputRowCategories_activation4" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation4') }}:
                                    </td>
                                    <td>
                                        <select id="categories_activation4" name="activation4" class="ss-backend-field-dropdown01">
                                            <option value="1"{{ $ocdRecord['tblCategoriesActivation4'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0"{{ $ocdRecord['tblCategoriesActivation4'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesActivation5'] === 1)
                                <tr id="inputRowCategories_activation5" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation5') }}:
                                    </td>
                                    <td>
                                        <select id="categories_activation5" name="activation5" class="ss-backend-field-dropdown01">
                                            <option value="1"{{ $ocdRecord['tblCategoriesActivation5'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0"{{ $ocdRecord['tblCategoriesActivation5'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesStatus'] === 1)
                                <tr id="inputRowCategories_id_status" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesStatus') }}:
                                    </td>
                                    <td>
                                        <select id="categories_id_status" name="id_status" class="ss-backend-field-dropdown01">
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemDropDownSelectNone') }}</option>

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

                            @if ($GLOBALS['enableCategoriesRestrictedAccess'] === 1)
                                <tr id="inputRowCategories_id_restricted_access" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess') }}:
                                    </td>
                                    <td>
                                        <select id="categories_restricted_access" name="restricted_access" class="ss-backend-field-dropdown01">
                                            <option value="0"{{ $ocdRecord['tblCategoriesRestrictedAccess'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess0') }}</option>
                                            <option value="1"{{ $ocdRecord['tblCategoriesRestrictedAccess'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess1') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesNotes'] === 1)
                                <tr id="inputRowCategories_notes" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemNotesInternal') }}:
                                    </td>
                                    <td>
                                        <textarea id="categories_notes" name="notes" class="ss-backend-field-text-area01">{{ $ocdRecord['tblCategoriesNotes_edit'] }}</textarea>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{-- TODO: transform into CSS class. --}}
                <div style="position: relative; display: block; overflow: hidden; clear: both; margin-top: 2px;">
                    <button id="categories_include" name="categories_include" class="ss-backend-btn-base ss-backend-btn-action-execute" style="float: left;">
                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendButtonUpdate') }}
                    </button>

                    <a onclick="history.go(-1);" class="ss-backend-btn-base ss-backend-btn-action-alert" style="float: right;">
                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendButtonBack') }}
                    </a>
                </div>

                <input type="hidden" id="categories_id" name="id" value="{{ $ocdRecord['tblCategoriesID'] }}" />
                @if ($GLOBALS['enableCategoriesIdParentEdit'] === 1)
                    <input type="hidden" id="categories_id_parent" name="id_parent" value="{{ $ocdRecord['tblCategoriesIdParent'] }}" />
                @endif

                <input type="hidden" id="categories_idParent" name="idParent" value="{{ $ocdRecord['tblCategoriesIdParent'] }}" />
                <input type="hidden" id="categories_pageNumber" name="pageNumber" value="{{ $pageNumber }}" />
                <input type="hidden" id="categories_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />
            </form>
        </section>
@endsection
