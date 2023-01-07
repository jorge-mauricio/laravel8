@php
    // Variables.
    $idParentCategories = $templateData['idParentCategories'];
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
    // $metaURLCurrent .= $templateData['cphBody']['arrCategoriesDetails']['tblCategoriesIdParent'] . '/';
    $metaURLCurrent .= $idParentCategories . '/';
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
    @include('admin.partial-messages-status')

    <script>
        // Debug.
        // alert(document.location);
        // alert(window.location.hostname);
        // alert(window.location.host);
        // alert(window.location.origin);
    </script>

    <pre>
        @php
            // Debug.
            //echo '_GET=' . $_GET['masterPageSelect'] . '<br />';
            //echo 'masterPageSelect=' . $masterPageSelect . '<br />';
            //echo 'masterPageSelect=' . $masterPageSelect . '<br />';

            //echo 'apiKey=' . \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(env('CONFIG_API_KEY_SYSTEM'), 'env'), 2) . '<br />';

            // var_dump($templateData['cphBody']);
            // var_dump($templateData['additionalData']);
        @endphp
    </pre>

    <section class="ss-backend-layout-section-data01">
        @if (count($arrCategoriesListing) < 1)
            <div class="ss-backend-alert ss-backend-layout-div-records-empty">
                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage1') }}
            </div>
        @else
            {{-- TODO: create css class for this part. --}}
            <div style="position: relative; display: block; overflow: hidden; margin-bottom: 2px;">
                {{-- onclick="elementMessage01('formCategoriesListing_method', 'DELETE');
                            formSubmit('formCategoriesListing', '', '', '/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/?_method=DELETE');
                            "--}}

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
                @csrf
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
                                                        let glightboxCategoriesImageMain{{ $categoriesRow['id'] }} = GLightbox(gLightboxBackendConfigOptions);
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

                                        <!-- Debug. -->
                                        <!-- // TODO: delete. -->
                                        {{-- <div style="display: block;">
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

                                                    <!-- Encrypted. -->
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

                                                    <!-- Encrypted. -->
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

                                                    <!-- Encrypted. -->
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

                                                    <!-- Encrypted. -->
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

                                                    <!-- Encrypted. -->
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

                                                    <!-- Encrypted. -->
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

                                                    <!-- Encrypted. -->
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

                                                    <!-- Encrypted. -->
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

                                                    <!-- Encrypted. -->
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

                                                    <!-- Encrypted. -->
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
                                                        
                                                        <!-- file (download). -->
                                                        @if ($GLOBALS['configCategoriesFile1Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file1'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file1'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file1}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file1}
                                                            </a-->
                                                        @endif

                                                        <!-- file (open direct). -->
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
                                                        
                                                        <!-- file (download). -->
                                                        @if ($GLOBALS['configCategoriesFile2Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file2'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file2'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file2}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file2}
                                                            </a-->
                                                        @endif

                                                        <!-- file (open direct). -->
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
                                                        
                                                        <!-- file (download). -->
                                                        @if ($GLOBALS['configCategoriesFile3Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file3'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file3'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file3}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file3}
                                                            </a-->
                                                        @endif

                                                        <!-- file (open direct). -->
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
                                                        
                                                        <!-- file (download). -->
                                                        @if ($GLOBALS['configCategoriesFile4Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file4'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file4'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file4}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file4}
                                                            </a-->
                                                        @endif

                                                        <!-- file (open direct). -->
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
                                                        
                                                        <!-- file (download). -->
                                                        @if ($GLOBALS['configCategoriesFile5Type'] === 3)
                                                            <a download href="{{ $GLOBALS['configSystemURLImages'] . $GLOBALS['configDirectoryFilesSD'] . '/' + $categoriesRow['file5'] }}" target="_blank" class="ss-backend-links01">
                                                                {{ $categoriesRow['file5'] }}
                                                            </a>

                                                            <!--a onlick="fileDownload('${categoriesRow.file5}', '${gSystemConfig.configSystemURL + '/' + gSystemConfig.configDirectoryFilesSD}');" class="ss-backend-links01">
                                                                ${categoriesRow.file5}
                                                            </a-->
                                                        @endif

                                                        <!-- file (open direct). -->
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
                                        </div> --}}
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
                                                      ajaxRecordsPatch01_async('{{ env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
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
                                                                                    
                                                                                    // if (_resObjReturn.objReturn.returnStatus === true) { // For some reason, the promise object is returning without an object inside.
                                                                                    if (_resObjReturn.returnStatus === true) {
                                                                                        // alert('returnStatus=', true);

                                                                                        // Check status.
                                                                                        if (_resObjReturn.recordUpdatedValue === '0') {
                                                                                            // Change cell color.
                                                                                            elementCSSAdd('formCategoriesListing_elementActivation{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkActivation{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                        }

                                                                                        if (_resObjReturn.recordUpdatedValue === '1') {
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
                                                        ajaxRecordsPatch01_async('{{ env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
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
                                                                                        
                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation1{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation1{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
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
                                                        ajaxRecordsPatch01_async('{{ env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
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
                                                                                        
                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation2{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation2{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
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
                                                        ajaxRecordsPatch01_async('{{ env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
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
                                                                                        
                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation3{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation3{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
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
                                                        ajaxRecordsPatch01_async('{{ env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
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
                                                                                        
                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation4{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation4{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
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
                                                        ajaxRecordsPatch01_async('{{ env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
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
                                                                                        
                                                                                        if (_resObjReturn.returnStatus === true) {
                                                                                            // Check status.
                                                                                            if (_resObjReturn.recordUpdatedValue === '0') { //TODO: check type to change comparison (string or int)
                                                                                                // Change cell color.
                                                                                                elementCSSAdd('formCategoriesListing_elementActivation5{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                                // Change link text.
                                                                                                elementMessage01('linkActivation5{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0A') }}');
                                                                                            }

                                                                                            if (_resObjReturn.recordUpdatedValue === '1') {
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
                                                          ajaxRecordsPatch01_async('{{ env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteBackendRecords'] }}/',
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
                                                                                    if(_resObjReturn.returnStatus === true) {
                                                                                        // Check status.
                                                                                        if(_resObjReturn.recordUpdatedValue === '0')
                                                                                        {
                                                                                            // Change cell color.
                                                                                            elementCSSRemove('formCategoriesListing_elementRestrictedAccess{{ $categoriesRow['id'] }}', 'ss-backend-table-bg-deactive');

                                                                                            // Change link text.
                                                                                            elementMessage01('linkRestrictedAccess{{ $categoriesRow['id'] }}', '{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess0A') }}');
                                                                                        }

                                                                                        if(_resObjReturn.recordUpdatedValue === '1')
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
                                        <a href="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/' . $GLOBALS['configRouteBackendActionEdit'] . '/' . $categoriesRow['id'] . '/?' . $queryDefault }}" class="ss-backend-links01">
                                            {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemEdit') }} 
                                        </a>
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" name="idsRecordsDelete[]" value="{{ $categoriesRow['id'] }}" class="ss-backend-field-checkbox" /> 
                                        <!--input type="checkbox" name="idsRecordsDelete" value="{{ $categoriesRow['id'] }}" class="ss-backend-field-checkbox" /--> 
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

    @if ((string) $idParentCategories !== '')
        {{-- Form. --}}
        <section class="ss-backend-layout-section-form01">
            <form id="formCategories" name="formCategories" method="POST" action="/{{ $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] }}" enctype="multipart/form-data">
                @csrf
                
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
                            @if ($GLOBALS['enableCategoriesSortOrder'] === 1)
                                <tr id="inputRowCategories_sort_order" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemSortOrder') }}: 
                                    </td>
                                    <td>
                                        <input type="text" id="categories_sort_order" name="sort_order" class="ss-backend-field-numeric01" maxlength="10" value="0" />
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
                                            <option value="{{ $categoryTypeRow['category_type'] }}">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, $categoryTypeRow['category_type_function_label']) }}</option>
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
                                    <input type="text" id="categories_title" name="title" class="ss-backend-field-text01" maxlength="255" value="" />
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
                                        <textarea id="categories_description" name="description" class="ss-backend-field-text-area01"></textarea>
                                    @endif


                                    {{-- Quill. --}}
                                    @if ($GLOBALS['configBackendTextBox'] === 13)
                                        <textarea id="categories_description" name="description" class="ss-backend-field-text-area01"></textarea>
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
                                        <textarea id="categories_description" name="description" class="ss-backend-field-text-area01"></textarea>
                                        <script>
                                            new FroalaEditor("#categories_description");
                                        </script>
                                    @endif


                                    {{-- TinyMCE. --}}
                                    @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
                                        <textarea id="categories_description" name="description" class="ss-backend-field-text-area01"></textarea>
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
                                        <input type="text" id="categories_url_alias" name="url_alias" class="ss-backend-field-text01" value="" />
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesKeywordsTags'] === 1)
                                <tr id="inputRowCategories_keywords_tags" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemKeywords') }}: 
                                    </td>
                                    <td>
                                        <textarea id="categories_keywords_tags" name="keywords_tags" class="ss-backend-field-text-area01"></textarea>
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
                                        <textarea id="categories_meta_description" name="meta_description" class="ss-backend-field-text-area01"></textarea>
                                    </td>
                                </tr>
                            @endif

                            @if ($GLOBALS['enableCategoriesMetaTitle'] === 1)
                                <tr id="inputRowCategories_meta_title" class="ss-backend-table-bg-light">
                                    <td class="ss-backend-table-bg-medium">
                                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemMetaTitle') }}: 
                                    </td>
                                    <td>
                                        <input type="text" id="categories_meta_title" name="meta_title" class="ss-backend-field-text01" value="" />
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
                                            <input type="text" id="categories_info1" name="info1" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo1FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info1" name="info1" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info1" name="info1" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info1";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo1FieldType'] === 11)
                                            <input type="text" id="categories_info1" name="info1" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo1FieldType'] === 12)
                                            <textarea id="categories_info1" name="info1" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info2" name="info2" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo2FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info2" name="info2" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info2" name="info2" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info2";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo2FieldType'] === 11)
                                            <input type="text" id="categories_info2" name="info2" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo2FieldType'] === 12)
                                            <textarea id="categories_info2" name="info2" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info3" name="info3" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo3FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info3" name="info3" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info3" name="info3" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info3";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo3FieldType'] === 11)
                                            <input type="text" id="categories_info3" name="info3" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo3FieldType'] === 12)
                                            <textarea id="categories_info3" name="info3" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info4" name="info4" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo4FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info4" name="info4" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info4" name="info4" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info4";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo4FieldType'] === 11)
                                            <input type="text" id="categories_info4" name="info4" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo4FieldType'] === 12)
                                            <textarea id="categories_info4" name="info4" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info5" name="info5" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo5FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info5" name="info5" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info5" name="info5" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info5";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo5FieldType'] === 11)
                                            <input type="text" id="categories_info5" name="info5" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo5FieldType'] === 12)
                                            <textarea id="categories_info5" name="info5" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info6" name="info6" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo6FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info6" name="info6" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info6" name="info6" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info6";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo6FieldType'] === 11)
                                            <input type="text" id="categories_info6" name="info6" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo6FieldType'] === 12)
                                            <textarea id="categories_info6" name="info6" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info7" name="info7" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo7FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info7" name="info7" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info7" name="info7" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info7";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo7FieldType'] === 11)
                                            <input type="text" id="categories_info7" name="info7" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo7FieldType'] === 12)
                                            <textarea id="categories_info7" name="info7" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info8" name="info8" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo8FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info8" name="info8" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info8" name="info8" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info8";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo8FieldType'] === 11)
                                            <input type="text" id="categories_info8" name="info8" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo8FieldType'] === 12)
                                            <textarea id="categories_info8" name="info8" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info9" name="info9" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo9FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info9" name="info9" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info9" name="info9" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info9";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo9FieldType'] === 11)
                                            <input type="text" id="categories_info9" name="info9" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo9FieldType'] === 12)
                                            <textarea id="categories_info9" name="info9" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info10" name="info10" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfo10FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info10" name="info10" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox']  === 18)
                                                <textarea id="categories_info10" name="info10" class="ss-backend-field-text-area01"></textarea>
                                                <script>
                                                    tinyMCEBackendConfig.selector = "#categories_info10";
                                                    tinymce.init(tinyMCEBackendConfig);
                                                </script>
                                            @endif
                                        @endif

                                        {{-- Single line (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo10FieldType'] === 11)
                                            <input type="text" id="categories_info10" name="info10" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline (encrypted). --}}
                                        @if ($GLOBALS['configCategoriesInfo10FieldType'] === 12)
                                            <textarea id="categories_info10" name="info10" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info_small1" name="info_small1" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS1FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small1" name="info_small1" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
                                                <textarea id="categories_info_small1" name="info_small1" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info_small2" name="info_small2" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS2FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small2" name="info_small2" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
                                                <textarea id="categories_info_small2" name="info_small2" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info_small3" name="info_small3" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS3FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small3" name="info_small3" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
                                                <textarea id="categories_info_small3" name="info_small3" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info_small4" name="info_small4" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS4FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small4" name="info_small4" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
                                                <textarea id="categories_info_small4" name="info_small4" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_info_small5" name="info_small5" class="ss-backend-field-text01" value="" />
                                        @endif

                                        {{-- Multiline. --}}
                                        @if ($GLOBALS['configCategoriesInfoS5FieldType'] === 2)
                                            {{-- No formatting. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 1)
                                                <textarea id="categories_info_small5" name="info_small5" class="ss-backend-field-text-area01"></textarea>
                                            @endif

                                            {{-- TinyMCE. --}}
                                            @if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
                                                <textarea id="categories_info_small5" name="info_small5" class="ss-backend-field-text-area01"></textarea>
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
                                            <input type="text" id="categories_number1" name="number1" class="ss-backend-field-numeric02" value="0" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number1");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber1FieldType'] === 2 || $GLOBALS['configCategoriesNumber1FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number1" name="number1" class="ss-backend-field-currency01" value="0" maxlength="45" />
                                            
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number1");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber1FieldType'] === 3)
                                            <input type="text" id="categories_number1" name="number1" class="ss-backend-field-numeric02" value="0" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskDecimalBackendConfigOptions).mask("categories_number1");
                                            </script>
                                        @endif
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
                                            <input type="text" id="categories_number2" name="number2" class="ss-backend-field-numeric02" value="0" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number2");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber2FieldType'] === 2 || $GLOBALS['configCategoriesNumber2FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number2" name="number2" class="ss-backend-field-currency01" value="0" maxlength="45" />
                                            
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number2");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber2FieldType'] === 3)
                                            <input type="text" id="categories_number2" name="number2" class="ss-backend-field-numeric02" value="0" maxlength="34" />
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
                                            <input type="text" id="categories_number3" name="number3" class="ss-backend-field-numeric02" value="0" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number3");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber3FieldType'] === 2 || $GLOBALS['configCategoriesNumber3FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number3" name="number3" class="ss-backend-field-currency01" value="0" maxlength="45" />
                                            
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number3");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber3FieldType'] === 3)
                                            <input type="text" id="categories_number3" name="number3" class="ss-backend-field-numeric02" value="0" maxlength="34" />
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
                                            <input type="text" id="categories_number4" name="number4" class="ss-backend-field-numeric02" value="0" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number4");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber4FieldType'] === 2 || $GLOBALS['configCategoriesNumber4FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number4" name="number4" class="ss-backend-field-currency01" value="0" maxlength="45" />
                                            
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number4");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber4FieldType'] === 3)
                                            <input type="text" id="categories_number4" name="number4" class="ss-backend-field-numeric02" value="0" maxlength="34" />
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
                                            <input type="text" id="categories_number5" name="number5" class="ss-backend-field-numeric02" value="0" maxlength="34" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number5");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumber5FieldType'] === 2 || $GLOBALS['configCategoriesNumber5FieldType'] === 4)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number5" name="number5" class="ss-backend-field-currency01" value="0" maxlength="45" />
                                            
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number5");
                                            </script>
                                        @endif

                                        {{-- Decimal. --}}
                                        @if ($GLOBALS['configCategoriesNumber5FieldType'] === 3)
                                            <input type="text" id="categories_number5" name="number5" class="ss-backend-field-numeric02" value="0" maxlength="34" />
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
                                            <input type="text" id="categories_number_small1" name="number_small1" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small1");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS1FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small1" name="number_small1" class="ss-backend-field-currency01" value="0" maxlength="9" />
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
                                            <input type="text" id="categories_number_small2" name="number_small2" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small2");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS2FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small2" name="number_small2" class="ss-backend-field-currency01" value="0" maxlength="9" />
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
                                            <input type="text" id="categories_number_small3" name="number_small3" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small3");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS3FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small3" name="number_small3" class="ss-backend-field-currency01" value="0" maxlength="9" />
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
                                            <input type="text" id="categories_number_small4" name="number_small4" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small4");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS4FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small4" name="number_small4" class="ss-backend-field-currency01" value="0" maxlength="9" />
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
                                            <input type="text" id="categories_number_small5" name="number_small5" class="ss-backend-field-numeric01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskGenericBackendConfigOptions).mask("categories_number_small5");
                                            </script>
                                        @endif

                                        {{-- System currency. --}}
                                        @if ($GLOBALS['configCategoriesNumberS5FieldType'] === 2)
                                            {{ $GLOBALS['configSystemCurrency'] }}
                                            <input type="text" id="categories_number_small5" name="number_small5" class="ss-backend-field-currency01" value="0" maxlength="9" />
                                            <script>
                                                Inputmask(inputmaskCurrencyBackendConfigOptions).mask("categories_number_small5");
                                            </script>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            {{-- TODO: test and change comparison (==  to ===). --}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
                                                        >
                                                            {{ $arrayRow }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endif
                                    

                                        {{-- js-datepicker. --}}
                                        @if ($GLOBALS['configCategoriesDate1FieldType'] === 11)
                                            <input type="text" id="categories_date1" name="date1" class="ss-backend-field-date01" autocomplete="off" value="" />
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
                                                        {{ $dateNowHour == $arrayRow ? ' selected' : ''}}
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
                                                        {{ $dateNowMinute == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowSecond == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
                                                        >
                                                            {{ $arrayRow }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endif
                                    

                                        {{-- js-datepicker. --}}
                                        @if ($GLOBALS['configCategoriesDate2FieldType'] === 11)
                                            <input type="text" id="categories_date2" name="date2" class="ss-backend-field-date01" autocomplete="off" value="" />
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
                                                        {{ $dateNowHour == $arrayRow ? ' selected' : ''}}
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
                                                        {{ $dateNowMinute == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowSecond == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
                                                        >
                                                            {{ $arrayRow }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endif
                                    

                                        {{-- js-datepicker. --}}
                                        @if ($GLOBALS['configCategoriesDate3FieldType'] === 11)
                                            <input type="text" id="categories_date3" name="date3" class="ss-backend-field-date01" autocomplete="off" value="" />
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
                                                        {{ $dateNowHour == $arrayRow ? ' selected' : ''}}
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
                                                        {{ $dateNowMinute == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowSecond == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
                                                        >
                                                            {{ $arrayRow }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endif
                                    

                                        {{-- js-datepicker. --}}
                                        @if ($GLOBALS['configCategoriesDate4FieldType'] === 11)
                                            <input type="text" id="categories_date4" name="date4" class="ss-backend-field-date01" autocomplete="off" value="" />
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
                                                        {{ $dateNowHour == $arrayRow ? ' selected' : ''}}
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
                                                        {{ $dateNowMinute == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowSecond == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowMonth == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowDay == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowYear == $arrayRow ? ' selected' : ''}}
                                                        >
                                                            {{ $arrayRow }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endif
                                    

                                        {{-- js-datepicker. --}}
                                        @if ($GLOBALS['configCategoriesDate5FieldType'] === 11)
                                            <input type="text" id="categories_date5" name="date5" class="ss-backend-field-date01" autocomplete="off" value="" />
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
                                                        {{ $dateNowHour == $arrayRow ? ' selected' : ''}}
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
                                                        {{ $dateNowMinute == $arrayRow ? ' selected' : ''}}
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
                                                            {{ $dateNowSecond == $arrayRow ? ' selected' : ''}}
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
                                        <input type="file" id="categories_image_main" name="image_main" class="ss-backend-field-file-upload" />
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
                                    </td>
                                </tr>
                            @endif

                            <tr id="inputRowCategories_activation" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation') }}: 
                                </td>
                                <td>
                                    <select id="categories_activation" name="activation" class="ss-backend-field-dropdown01">
                                        <option value="1" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                        <option value="0">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
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
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
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
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
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
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
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
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
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
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation1') }}</option>
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemActivation0') }}</option>
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
                                            <option value="0" selected>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess0') }}</option>
                                            <option value="1">{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendItemRestrictedAccess1') }}</option>
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
                                        <textarea id="categories_notes" name="notes" class="ss-backend-field-text-area01"></textarea>
                                    </td>
                                </tr>
                            @endif
                        </tbody>                        
                    </table>


                </div>
                {{-- TODO: transform into CSS class. --}}
                <div style="position: relative; display: block; overflow: hidden; clear: both; margin-top: 2px;">
                    <button id="categories_include" name="categories_include" class="ss-backend-btn-base ss-backend-btn-action-execute" style="float: left;">
                        {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendButtonSend') }}
                    </button>
                </div>

                <input type="hidden" id="categories_id_parent" name="id_parent" value="{{ $idParentCategories }}" />

                <input type="hidden" id="categories_idParent" name="idParent" value="{{ $idParentCategories }}" />
                <input type="hidden" id="categories_pageNumber" name="pageNumber" value="{{ $pageNumber }}" />
                <input type="hidden" id="categories_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />
            </form>
        </section>
    @endif
@endsection