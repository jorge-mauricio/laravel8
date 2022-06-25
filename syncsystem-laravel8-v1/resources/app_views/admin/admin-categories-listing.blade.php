@php
    // Variables.
    $idParentCategories = $templateData['idParentCategories'];
    $titleCurrent = $templateData['cphTitleCurrent'];
    $arrCategoriesDetails = $templateData['cphBody']['arrCategoriesDetails'];
    $arrCategoriesListing = $templateData['cphBody']['arrCategoriesListing'];

    $cacheClear = '123';

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
            {{-- TODO: create css class for this part. --}}
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
            
            {{--Debug--}}
            {{-- @dd($arrCategoriesListing) --}}
            @php
                // Debug.
                //echo '_GET=' . $_GET['masterPageSelect'] . '<br />';
                //echo 'masterPageSelect=' . $masterPageSelect . '<br />';
                //echo 'masterPageSelect=' . $masterPageSelect . '<br />';

                //echo 'cphBody=<pre>';
                //var_dump($templateData['cphBody']);
                //echo '</pre><br />';
                //exit();
                //die();
            @endphp
            
            <form id="formCategoriesListing" name="formCategoriesListing" method="POST" action="" enctype="application/x-www-form-urlencoded">
                <input type="hidden" id="formCategoriesListing_method" name="_method" value="">

                <input type="hidden" id="formCategoriesListing_strTable" name="strTable" value="{{ $GLOBALS['configSystemDBTableCategories'] }}" />
                
                <input type="hidden" id="formCategoriesListing_idParent" name="idParent" value="{{ $idParentCategories }}" />
                <input type="hidden" id="formCategoriesListing_pageReturn" name="pageReturn" value="{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] }}" />
                <input type="hidden" id="formCategoriesListing_pageNumber" name="pageNumber" value="{{ $pageNumber }}" />
                <input type="hidden" id="formCategoriesListing_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />

                <div style="position: relative; display: block; overflow: hidden;">
                    <table class="ss-backend-table-listing01">
                        <caption class="ss-backend-table-header-text01 ss-backend-table-title">
                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesTitleMain') }}
                        </caption>
                        <thead class="ss-backend-table-bg-dark ss-backend-table-header-text01">
                            <tr>
                                @if ($GLOBALS['enableCategoriesSortOrder'] === 1)
                                    <td style="width: 40px; text-align: left;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemSortOrderA') }}  
                                    </td>
                                @endif

                                @if ($GLOBALS['enableCategoriesImageMain'] === 1)
                                    <td style="width: 100px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemImage') }}  
                                    </td>
                                @endif

                                <td style="text-align: left;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesCategory') }}  
                                </td>
                                <td style="width: 100px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemFunctions') }}  
                                </td>

                                @if ($GLOBALS['enableCategoriesStatus'] === 1)
                                    <td style="width: 100px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesStatus') }}  
                                    </td>
                                @endif

                                <td style="width: 40px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivationA') }}  
                                </td>

                                @if ($GLOBALS['enableCategoriesActivation1'] === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation1') }}  
                                    </td>
                                @endif
                                @if ($GLOBALS['enableCategoriesActivation2'] === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation2') }}  
                                    </td>
                                @endif
                                @if ($GLOBALS['enableCategoriesActivation3'] === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation3') }}  
                                    </td>
                                @endif
                                @if ($GLOBALS['enableCategoriesActivation4'] === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation4') }}  
                                    </td>
                                @endif
                                @if ($GLOBALS['enableCategoriesActivation5'] === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesActivation5') }}  
                                    </td>
                                @endif

                                @if ($GLOBALS['enableCategoriesRestrictedAccess'] === 1)
                                    <td style="width: 40px; text-align: center;">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccessA') }}  
                                    </td>
                                @endif

                                <td style="width: 40px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemEdit') }}  
                                </td>
                                <td style="width: 40px; text-align: center;">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemDelete') }}  
                                </td>
                            </tr>
                        </thead>

                        <tbody class="ss-backend-table-listing-text01">
                            @foreach ($arrCategoriesListing as $categoriesRow)
                            {{--Debug--}}
                            {{-- @dd($categoriesRow) --}}
                                <tr class="ss-backend-table-bg-light">
                                    @if ($GLOBALS['enableCategoriesSortOrder'] === 1)
                                        <td style="text-align: center;">
                                            {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['sort_order'], '', 3, null) }} 
                                        </td>
                                    @endif

                                    @if ($GLOBALS['enableCategoriesImageMain'] === 1)
                                        <td style="text-align: center;">
                                            @if ($categoriesRow['image_main'] !== '')
                                                {{-- No pop-up. --}}
                                                @if ($GLOBALS['configImagePopup'] === 0)
                                                    <img src="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/t' . $categoriesRow['image_main'] . '?v=' . $cacheClear }}" 
                                                        alt="{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['title'], 'db') }}" 
                                                        class="ss-backend-images-listing" />
                                                @endif

                                                {{-- GLightbox. --}}
                                                @if ($GLOBALS['configImagePopup'] === 4)
                                                    <a href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/g' . $categoriesRow['image_main'] . '?v=' . $cacheClear }}"
                                                        title="{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['title'], 'db') }}"
                                                        class="glightbox_categories_image_main{{ $categoriesRow['id'] }}"
                                                        data-glightbox="title:{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['title'], 'db') }};">

                                                        <img src="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/t' . $categoriesRow['image_main'] . '?v=' . $cacheClear }}" 
                                                            alt="{{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['title'], 'db') }}" 
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
                                                            selector: "glightbox_categories_image_main"
                                                        });
                                                        */

                                                        gLightboxBackendConfigOptions.selector = "glightbox_categories_image_main{{ $categoriesRow['id'] }}";
                                                        // Note: With ID in the selector, will open individual pop-ups. Without id (same class name in all links) will enable scroll.
                                                        // data-glightbox="title: Title example.; description: Description example."
                                                        let glightboxCategoriesImageMain = GLightbox(gLightboxBackendConfigOptions);
                                                    </script>
                                                @endif
                                            @endif
                                        </td>
                                    @endif
                                    
                                    <td style="text-align: left;">
                                        <a href="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/' . $categoriesRow['id'] }}" class="ss-backend-links01">
                                            {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['title'], 'db') }} 
                                        </a>
                                        @if ($GLOBALS['enableCategoriesDescription'] === 1)
                                            <div>
                                                <strong>
                                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDescription') }}:
                                                </strong>

                                                {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['description'], 'db') }}
                                            </div>
                                        @endif

                                        <div style="display: block;">
                                            @if ($GLOBALS['enableCategoriesInfo1'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo1') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo1FieldType'] === 1 || $GLOBALS['configCategoriesInfo1FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info1'], 'db')
                                                        : ''
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                        $GLOBALS['configCategoriesInfo1FieldType'] === 11 || $GLOBALS['configCategoriesInfo1FieldType'] === 12 ? 
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info1'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfo2'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo2') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo2FieldType'] === 1 || $GLOBALS['configCategoriesInfo2FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info2'], 'db')
                                                        : ''
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                        $GLOBALS['configCategoriesInfo2FieldType'] === 11 || $GLOBALS['configCategoriesInfo2FieldType'] === 12 ?
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info2'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfo3'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo3') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo3FieldType'] === 1 || $GLOBALS['configCategoriesInfo3FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info3'], 'db')
                                                        : ''
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                        $GLOBALS['configCategoriesInfo3FieldType'] === 11 || $GLOBALS['configCategoriesInfo3FieldType'] === 12 ? 
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info3'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfo4'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo4') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo4FieldType'] === 1 || $GLOBALS['configCategoriesInfo4FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info4'], 'db')
                                                        : ''
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                        $GLOBALS['configCategoriesInfo4FieldType'] === 11 || $GLOBALS['configCategoriesInfo4FieldType'] === 12 ? 
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info4'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfo5'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo5') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo5FieldType'] === 1 || $GLOBALS['configCategoriesInfo5FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info5'], 'db')
                                                        : ''
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                        $GLOBALS['configCategoriesInfo5FieldType'] === 11 || $GLOBALS['configCategoriesInfo5FieldType'] === 12 ?
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info5'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfo6'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo6') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo6FieldType'] === 1 || $GLOBALS['configCategoriesInfo6FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info6'], 'db')
                                                        : ``
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                        $GLOBALS['configCategoriesInfo6FieldType'] === 11 || $GLOBALS['configCategoriesInfo6FieldType'] === 12 ? 
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info6'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfo7'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo7') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo7FieldType'] === 1 || $GLOBALS['configCategoriesInfo7FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info7'], 'db')
                                                        : ''
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                        $GLOBALS['configCategoriesInfo7FieldType'] === 11 || $GLOBALS['configCategoriesInfo7FieldType'] === 12 ? 
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info7'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfo8'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo8') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo8FieldType'] === 1 || $GLOBALS['configCategoriesInfo8FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info8'], 'db')
                                                        : ''
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                        $GLOBALS['configCategoriesInfo8FieldType'] === 11 || $GLOBALS['configCategoriesInfo8FieldType'] === 12 ?
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info8'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfo9'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo9') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo9FieldType'] === 1 || $GLOBALS['configCategoriesInfo9FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info9'], 'db')
                                                        : ''
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                    $GLOBALS['configCategoriesInfo9FieldType'] === 11 || $GLOBALS['configCategoriesInfo9FieldType'] === 12 ? 
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info9'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfo10'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfo10') }}:
                                                    </strong>
                                                    {{
                                                        $GLOBALS['configCategoriesInfo10FieldType'] === 1 || $GLOBALS['configCategoriesInfo10FieldType'] === 2 ? 
                                                            \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info10'], 'db')
                                                        : ''
                                                    }}

                                                    {{-- Encrypted. --}}
                                                    {{
                                                    $GLOBALS['configCategoriesInfo10FieldType'] === 11 || $GLOBALS['configCategoriesInfo10FieldType'] === 12 ?
                                                            \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info10'], 'db'), 2)
                                                        : ''
                                                    }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfoS1'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS1' )}}:
                                                    </strong>

                                                    {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info_small1'], 'db') }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfoS2'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS2' )}}:
                                                    </strong>

                                                    {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info_small2'], 'db') }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfoS3'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS3' )}}:
                                                    </strong>

                                                    {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info_small3'], 'db') }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfoS4'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS4' )}}:
                                                    </strong>

                                                    {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info_small4'], 'db') }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesInfoS5'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesInfoS5' )}}:
                                                    </strong>

                                                    {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['info_small5'], 'db') }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumber1'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber1') }}:
                                                    </strong>

                                                    {{
                                                        $GLOBALS['configCategoriesNumber1FieldType'] === 2 || $GLOBALS['configCategoriesNumber1FieldType'] === 4 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number1'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumber1FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumber2'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber2') }}:
                                                    </strong>

                                                    {{
                                                        $GLOBALS['configCategoriesNumber2FieldType'] === 2 || $GLOBALS['configCategoriesNumber2FieldType'] === 4 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number2'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumber2FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumber3'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber3') }}:
                                                    </strong>

                                                    {{
                                                        $GLOBALS['configCategoriesNumber3FieldType'] === 2 || $GLOBALS['configCategoriesNumber3FieldType'] === 4 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number3'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumber3FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumber4'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber4') }}:
                                                    </strong>

                                                    {{
                                                        $GLOBALS['configCategoriesNumber4FieldType'] === 2 || $GLOBALS['configCategoriesNumber4FieldType'] === 4 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number4'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumber4FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumber5'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumber5') }}:
                                                    </strong>

                                                    {{
                                                        $GLOBALS['configCategoriesNumber5FieldType'] === 2 || $GLOBALS['configCategoriesNumber5FieldType'] === 4 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number5'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumber5FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumberS1'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS1') }}:
                                                    </strong>

                                                    {{
                                                        $GLOBALS['configCategoriesNumberS1FieldType'] === 2 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number_small1'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumberS1FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumberS2'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS2') }}:
                                                    </strong>

                                                    {{
                                                        $GLOBALS['configCategoriesNumberS2FieldType'] === 2 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number_small2'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumberS2FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumberS3'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS3') }}:
                                                    </strong>

                                                    {{
                                                    $GLOBALS['configCategoriesNumberS3FieldType'] === 2 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number_small3'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumberS3FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumberS4'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS4') }}:
                                                    </strong>

                                                    {{
                                                        $GLOBALS['configCategoriesNumberS4FieldType'] === 2 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number_small4'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumberS4FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesNumberS5'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesNumberS5') }}:
                                                    </strong>

                                                    {{
                                                    $GLOBALS['configCategoriesNumberS5FieldType'] === 2 ? 
                                                            $GLOBALS['configSystemCurrency'] . ' '
                                                        : ''
                                                    }}

                                                    {{ \SyncSystemNS\FunctionsGeneric::valueMaskRead($categoriesRow['number_small1'], $GLOBALS['configSystemCurrency'], $GLOBALS['configCategoriesNumberS5FieldType']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesDate1'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate1') }}:
                                                    </strong>
                                                    {{ \SyncSystemNS\FunctionsGeneric::dateRead01($categoriesRow['date1'], $GLOBALS['configBackendDateFormat'], 0, $GLOBALS['configCategoriesDate1Type']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesDate2'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate2') }}:
                                                    </strong>
                                                    {{ \SyncSystemNS\FunctionsGeneric::dateRead01($categoriesRow['date2'], $GLOBALS['configBackendDateFormat'], 0, $GLOBALS['configCategoriesDate2Type']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesDate3'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate3') }}:
                                                    </strong>
                                                    {{ \SyncSystemNS\FunctionsGeneric::dateRead01($categoriesRow['date3'], $GLOBALS['configBackendDateFormat'], 0, $GLOBALS['configCategoriesDate3Type']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesDate4'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate4') }}:
                                                    </strong>
                                                    {{ \SyncSystemNS\FunctionsGeneric::dateRead01($categoriesRow['date4'], $GLOBALS['configBackendDateFormat'], 0, $GLOBALS['configCategoriesDate4Type']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesDate5'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesDate5') }}:
                                                    </strong>
                                                    {{ \SyncSystemNS\FunctionsGeneric::dateRead01($categoriesRow['date5'], $GLOBALS['configBackendDateFormat'], 0, $GLOBALS['configCategoriesDate5Type']) }}
                                                </div>
                                            @endif

                                            @if ($GLOBALS['enableCategoriesFile1'] === 1)
                                                @if ($GLOBALS['configCategoriesFile1Type'] === 3 || $GLOBALS['configCategoriesFile1Type'] === 34)
                                                    <div>
                                                        <strong>
                                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile1') }}:
                                                        </strong>
                                                        
                                                        {{-- file (download). --}}
                                                        @if ($GLOBALS['configCategoriesFile1Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file1'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file1'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file1}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file1}
                                                            </a-->
                                                        @endif

                                                        {{-- file (open direct). --}}
                                                        @if ($GLOBALS['configCategoriesFile1Type'] === 34)
                                                            <a href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file1'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file1'] }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif

                                            @if ($GLOBALS['enableCategoriesFile2'] === 1)
                                                @if ($GLOBALS['configCategoriesFile2Type'] === 3 || $GLOBALS['configCategoriesFile2Type'] === 34)
                                                    <div>
                                                        <strong>
                                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile2') }}:
                                                        </strong>
                                                        
                                                        {{-- file (download). --}}
                                                        @if ($GLOBALS['configCategoriesFile2Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file2'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file2'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file2}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file2}
                                                            </a-->
                                                        @endif

                                                        {{-- file (open direct). --}}
                                                        @if ($GLOBALS['configCategoriesFile2Type'] === 34)
                                                            <a href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file2'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file2'] }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif

                                            @if ($GLOBALS['enableCategoriesFile3'] === 1)
                                                @if ($GLOBALS['configCategoriesFile3Type'] === 3 || $GLOBALS['configCategoriesFile3Type'] === 34)
                                                    <div>
                                                        <strong>
                                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile3') }}:
                                                        </strong>
                                                        
                                                        {{-- file (download). --}}
                                                        @if ($GLOBALS['configCategoriesFile3Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file3'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file3'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file3}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file3}
                                                            </a-->
                                                        @endif

                                                        {{-- file (open direct). --}}
                                                        @if ($GLOBALS['configCategoriesFile3Type'] === 34)
                                                            <a href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file3'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file3'] }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif

                                            @if ($GLOBALS['enableCategoriesFile4'] === 1)
                                                @if ($GLOBALS['configCategoriesFile4Type'] === 3 || $GLOBALS['configCategoriesFile4Type'] === 34)
                                                    <div>
                                                        <strong>
                                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile4') }}:
                                                        </strong>
                                                        
                                                        {{-- file (download). --}}
                                                        @if ($GLOBALS['configCategoriesFile4Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file4'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file4'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file4}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file4}
                                                            </a-->
                                                        @endif

                                                        {{-- file (open direct). --}}
                                                        @if ($GLOBALS['configCategoriesFile4Type'] === 34)
                                                            <a href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file4'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file4'] }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif

                                            @if ($GLOBALS['enableCategoriesFile5'] === 1)
                                                @if ($GLOBALS['configCategoriesFile5Type'] === 3 || $GLOBALS['configCategoriesFile5Type'] === 34)
                                                    <div>
                                                        <strong>
                                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendCategoriesFile5') }}:
                                                        </strong>
                                                        
                                                        {{-- file (download). --}}
                                                        @if ($GLOBALS['configCategoriesFile5Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file5'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file5'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file5}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file5}
                                                            </a-->
                                                        @endif

                                                        {{-- file (open direct). --}}
                                                        @if ($GLOBALS['configCategoriesFile5Type'] === 34)
                                                            <a href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file5'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file5'] }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                            
                                            @if ($GLOBALS['enableCategoriesNotes'] === 1)
                                                <div>
                                                    <strong>
                                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemNotesInternal') }}:
                                                    </strong>

                                                    {{ \SyncSystemNS\FunctionsGeneric::contentMaskRead($categoriesRow['notes'], 'db') }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td style="text-align: center;">
                                        @if (\SyncSystemNS\FunctionsGeneric::categoryConfigSelect($categoriesRow['category_type'], 0) === '-')
                                            {{ \SyncSystemNS\FunctionsGeneric::categoryConfigSelect($categoriesRow['category_type'], 5) }}
                                        @else
                                            <a href="/{{ $GLOBALS['configRouteBackend'] . '/' . \SyncSystemNS\FunctionsGeneric::categoryConfigSelect($categoriesRow['category_type'], 3) . '/' . $categoriesRow['id'] }}" class="ss-backend-links01" style="position: relative; display: block;">
                                                {{ \SyncSystemNS\FunctionsGeneric::categoryConfigSelect($categoriesRow['category_type'], 5) }}
                                            </a> 
                                        @endif

                                        <a href="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/' . $GLOBALS['configRouteBackendDetails'] . '/' . $categoriesRow['id'] }}" target="_blank" class="ss-backend-links01" style="position: relative; display: block;">
                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemDetailsView') }}
                                        </a> 
                                        <!--a href="/${gSystemConfig.configRouteFrontend + '/' + gSystemConfig.configRouteFrontendCategories + '/' + gSystemConfig.configRouteFrontendDetails + '/' + categoriesRow.id}" target="_blank" class="ss-backend-links01" style="position: relative; display: block;">
                                            ${SyncSystemNS.FunctionsGeneric.appLabelsGet(gSystemConfig.configLanguageBackend.appLabels, 'backendItemDetailsView')}
                                        </a--> {{-- TODO: Change address to access frontend. --}}


                                        {{-- Images. --}}
                                        {{-- TODO: create CSS class for links. --}}
                                        @if ($GLOBALS['enableCategoriesImages'] === 1)
                                            <a href="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendFiles'] . '/' . $categoriesRow['id'] . '?fileType=1&masterPageSelect=layout-backend-blank' }}" target="_blank" class="ss-backend-links01" style="position: relative; display: block;">
                                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemInsertImages') }}
                                            </a> 
                                        @endif

                                        {{-- Videos. --}}
                                        @if ($GLOBALS['enableCategoriesVideos'] === 1)
                                            <a href="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendFiles'] . '/' . $categoriesRow['id'] . '?fileType=2&masterPageSelect=layout-backend-blank' }}" target="_blank" class="ss-backend-links01" style="position: relative; display: block;">
                                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemInsertVideos') }}
                                            </a> 
                                        @endif
                                        
                                        {{-- Files. --}}
                                        @if ($GLOBALS['enableCategoriesFiles'] === 1)
                                            <a href="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendFiles'] . '/' . $categoriesRow['id'] . '?fileType=3&masterPageSelect=layout-backend-blank' }}" target="_blank" class="ss-backend-links01" style="position: relative; display: block;">
                                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemInsertFiles') }}
                                            </a> 
                                        @endif

                                        {{-- Zip files. --}}
                                        @if ($GLOBALS['enableCategoriesZip'] === 1)
                                            <a href="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendFiles'] . '/' . $categoriesRow['id'] . '?fileType=4&masterPageSelect=layout-backend-blank' }}" target="_blank" class="ss-backend-links01" style="position: relative; display: block;">
                                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemInsertFilesZip') }}
                                            </a> 
                                        @endif
                                    </td>

                                    @if ($GLOBALS['enableCategoriesStatus'] === 1)
                                        <td style="text-align: center;">
                                            {{
                                                $categoriesRow['id_status'] === 0 ? 
                                                    \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemDropDownSelectNone')
                                                : `
                                                    {ofglRecords.resultsFiltersGenericListing
                                                    .filter(function (objFiltered) {
                                                        return objFiltered.id == categoriesRow.id_status;
                                                    })
                                                    .map(function (objMapped) {
                                                        // return objMapped.title
                                                        return SyncSystemNS.FunctionsGeneric.contentMaskRead(objMapped.title, 'db');
                                                    })}

                                                    {/* categoriesRow.id_status */ ''}
                                                `
                                            }}
                                        </td>
                                    @endif

                                    <td id="formCategoriesListing_elementActivation{{ $categoriesRow['id'] }}" style="text-align: center;" class="{{ $categoriesRow['activation'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                        <a id="linkActivation{{ $categoriesRow['id'] }}" class="ss-backend-links01" 
                                            onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                      ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                {
                                                                                    idRecord: '{{ $categoriesRow['id'] }}', 
                                                                                    strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}', 
                                                                                    strField:'activation', 
                                                                                    recordValue: '{{ $categoriesRow['activation'] === 1 ? 0 : 1 }}', 
                                                                                    patchType: 'toggleValue', 
                                                                                    ajaxFunction: true, 
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                }, 
                                                                                async function(_resObjReturn) {
                                                                                    // alert(JSON.stringify(_resObjReturn));
                                                                                    
                                                                                    if (_resObjReturn.objReturn.returnStatus === true) {
                                                                                        // Check status.
                                                                                        if (_resObjReturn.objReturn.recordUpdatedValue === 0) { //TODO: check type to change comparison (string or int)
                                                                                            // Change cell color.
                                                                                            elementCSSAdd('formCategoriesListing_elementActivation{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkActivation{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                        }

                                                                                        if (_resObjReturn.objReturn.recordUpdatedValue === 1) {
                                                                                            // Change cell color.
                                                                                            elementCSSRemove('formCategoriesListing_elementActivation{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkActivation{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') }}');
                                                                                        }

                                                                                        // Success message.
                                                                                        elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage11') }}');

                                                                                    } else {
                                                                                        // Show error.
                                                                                        elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                    }

                                                                                    // Hide ajax progress bar.
                                                                                    htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                });">
                                            {{ $categoriesRow['activation'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }} 
                                        </a>
                                    </td>

                                    @if ($GLOBALS['enableCategoriesActivation1'] === 1)
                                        <td id="formCategoriesListing_elementActivation1{{ $categoriesRow['id'] }}" style="text-align: center;" class="{{ $categoriesRow['activation1'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation1{{ $categoriesRow['id'] }}" class="ss-backend-links01" 
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                    {
                                                                                        idRecord: '{{ $categoriesRow['id'] }}', 
                                                                                        strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}', 
                                                                                        strField:'activation1', 
                                                                                        recordValue: '{{ $categoriesRow['activation1'] === 1 ? 0 : 1 }}', 
                                                                                        patchType: 'toggleValue', 
                                                                                        ajaxFunction: true, 
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                    }, 
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));
                                                                                        
                                                                                        if (_resObjReturn.objReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 0) { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation1{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation1{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 1) {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formCategoriesListing_elementActivation1{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation1{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $categoriesRow['activation1'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }} 
                                            </a>
                                        </td>
                                    @endif

                                    @if ($GLOBALS['enableCategoriesActivation2'] === 1)
                                        <td id="formCategoriesListing_elementActivation2{{ $categoriesRow['id'] }}" style="text-align: center;" class="{{ $categoriesRow['activation2'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation2{{ $categoriesRow['id'] }}" class="ss-backend-links01" 
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                    {
                                                                                        idRecord: '{{ $categoriesRow['id'] }}', 
                                                                                        strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}', 
                                                                                        strField:'activation2', 
                                                                                        recordValue: '{{ $categoriesRow['activation2'] === 1 ? 0 : 1 }}', 
                                                                                        patchType: 'toggleValue', 
                                                                                        ajaxFunction: true, 
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                    }, 
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));
                                                                                        
                                                                                        if (_resObjReturn.objReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 0) { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation2{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation2{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 1) {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formCategoriesListing_elementActivation2{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation2{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $categoriesRow['activation2'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }} 
                                            </a>
                                        </td>
                                    @endif

                                    @if ($GLOBALS['enableCategoriesActivation3'] === 1)
                                        <td id="formCategoriesListing_elementActivation3{{ $categoriesRow['id'] }}" style="text-align: center;" class="{{ $categoriesRow['activation3'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation3{{ $categoriesRow['id'] }}" class="ss-backend-links01" 
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                    {
                                                                                        idRecord: '{{ $categoriesRow['id'] }}', 
                                                                                        strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}', 
                                                                                        strField:'activation3', 
                                                                                        recordValue: '{{ $categoriesRow['activation3'] === 1 ? 0 : 1 }}', 
                                                                                        patchType: 'toggleValue', 
                                                                                        ajaxFunction: true, 
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                    }, 
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));
                                                                                        
                                                                                        if (_resObjReturn.objReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 0) { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation3{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation3{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 1) {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formCategoriesListing_elementActivation3{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation3{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $categoriesRow['activation3'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }} 
                                            </a>
                                        </td>
                                    @endif

                                    @if ($GLOBALS['enableCategoriesActivation4'] === 1)
                                        <td id="formCategoriesListing_elementActivation4{{ $categoriesRow['id'] }}" style="text-align: center;" class="{{ $categoriesRow['activation4'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation4{{ $categoriesRow['id'] }}" class="ss-backend-links01" 
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                    {
                                                                                        idRecord: '{{ $categoriesRow['id'] }}', 
                                                                                        strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}', 
                                                                                        strField:'activation4', 
                                                                                        recordValue: '{{ $categoriesRow['activation4'] === 1 ? 0 : 1 }}', 
                                                                                        patchType: 'toggleValue', 
                                                                                        ajaxFunction: true, 
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                    }, 
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));
                                                                                        
                                                                                        if (_resObjReturn.objReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 0) { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation4{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation4{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 1) {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formCategoriesListing_elementActivation4{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation4{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $categoriesRow['activation4'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }} 
                                            </a>
                                        </td>
                                    @endif

                                    @if ($GLOBALS['enableCategoriesActivation5'] === 1)
                                        <td id="formCategoriesListing_elementActivation5{{ $categoriesRow['id'] }}" style="text-align: center;" class="{{ $categoriesRow['activation5'] === 1 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkActivation5{{ $categoriesRow['id'] }}" class="ss-backend-links01" 
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                        ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                    {
                                                                                        idRecord: '{{ $categoriesRow['id'] }}', 
                                                                                        strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}', 
                                                                                        strField:'activation5', 
                                                                                        recordValue: '{{ $categoriesRow['activation5'] === 1 ? 0 : 1 }}', 
                                                                                        patchType: 'toggleValue', 
                                                                                        ajaxFunction: true, 
                                                                                        apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                    }, 
                                                                                    async function(_resObjReturn) {
                                                                                        // alert(JSON.stringify(_resObjReturn));
                                                                                        
                                                                                        if (_resObjReturn.objReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 0) { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation5{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation5{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.objReturn.recordUpdatedValue === 1) {
                                                                                                // Change cell color.
                                                                                                elementCSSRemove('formCategoriesListing_elementActivation5{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation5{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') }}');
                                                                                            }

                                                                                            // Success message.
                                                                                            elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage11') }}');

                                                                                        } else {
                                                                                            // Show error.
                                                                                            elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                        }

                                                                                        // Hide ajax progress bar.
                                                                                        htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                    });">
                                                {{ $categoriesRow['activation5'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }} 
                                            </a>
                                        </td>
                                    @endif

                                    @if ($GLOBALS['enableCategoriesRestrictedAccess'] === 1)
                                        <td id="formCategoriesListing_elementRestrictedAccess{{ $categoriesRow['id'] }}" style="text-align: center;" class="{{ $categoriesRow['restricted_access'] === 0 ? '' : 'ss-backend-table-bg-deactive' }}">
                                            <a id="linkRestrictedAccess{{ $categoriesRow['id'] }}" class="ss-backend-links01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                          ajaxRecordsPatch01_async('{{ $GLOBALS['configSystemURLSSL'] . '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
                                                                                {
                                                                                    idRecord: '{{ $categoriesRow['id'] }}', 
                                                                                    strTable: '{{ $GLOBALS['configSystemDBTableCategories'] }}', 
                                                                                    strField:'restricted_access', 
                                                                                    recordValue: '{{ $categoriesRow['restricted_access'] === 1 ? 0 : 1 }}', 
                                                                                    patchType: 'toggleValue', 
                                                                                    ajaxFunction: true, 
                                                                                    apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) }}'
                                                                                }, 
                                                                                async function(_resObjReturn) {
                                                                                    if(_resObjReturn.objReturn.returnStatus === true) {
                                                                                        // Check status.
                                                                                        if(_resObjReturn.objReturn.recordUpdatedValue === 0)
                                                                                        {
                                                                                            // Change cell color.
                                                                                            elementCSSRemove('formCategoriesListing_elementRestrictedAccess{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkRestrictedAccess{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess0A') }}');
                                                                                        }

                                                                                        if(_resObjReturn.objReturn.recordUpdatedValue === 1)
                                                                                        {
                                                                                            // Change cell color.
                                                                                            elementCSSAdd('formCategoriesListing_elementRestrictedAccess{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkRestrictedAccess{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess1A') }}');
                                                                                        }

                                                                                        // Success message.
                                                                                        elementMessage01('divMessageSuccess', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage11') }}');
                                                                                    }else{
                                                                                        // Show error.
                                                                                        elementMessage01('divMessageError', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI2e') }}');
                                                                                    }

                                                                                    // Hide ajax progress bar.
                                                                                    htmlGenericStyle01('updtProgressGeneric', 'display', 'none');
                                                                                });">
                                                {{ $categoriesRow['restricted_access'] === 1 ? \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess1A') : \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess0A') }} 
                                            </a>
                                        </td>
                                    @endif

                                    <td style="text-align: center;">
                                        <a href="/${gSystemConfig.configRouteBackend + '/' + gSystemConfig.configRouteBackendCategories + '/' + gSystemConfig.configRouteBackendActionEdit + '/' + categoriesRow.id + '/?' + this.queryDefault}" class="ss-backend-links01">
                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemEdit') }} 
                                        </a>
                                    </td>
                                    <td style="text-align: center;">
                                        <!--input type="checkbox" name="idsRecordsDelete[]" value="${categoriesRow.id}" class="ss-backend-field-checkbox" /--> 
                                        <input type="checkbox" name="idsRecordsDelete" value="{{ $categoriesRow['id'] }}" class="ss-backend-field-checkbox" /> 
                                        <!--input type="checkbox" name="arrIdsRecordsDelete" value="${categoriesRow.id}" class="ss-backend-field-checkbox" /--> 
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

                {{-- pagination --}}
            </form>
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