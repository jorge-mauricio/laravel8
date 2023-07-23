@php
    // Variables.
    $idTbUsers = $templateData['idTbUsers'];
    $titleCurrent = $templateData['cphTitleCurrent'];
    $oudRecord = $templateData['cphBody']['oudRecord'];

    // Meta title.
    $metaTitle = '';
    $metaTitle .= \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersTitleEdit');
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
    $metaURLCurrent .= config('app.gSystemConfig.configRouteBackendActionEdit') . '/';
    $metaURLCurrent .= $oudRecord['tblUsersID'] . '/';
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
    {{-- @dump($oudRecord) --}}
    {{-- Form. --}}
    <section class="ss-backend-layout-section-form01">
        <form
            id="formUsers"
            name="formUsers"
            method="POST"
            action="/{{ config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') }}/?_method=PUT"
            enctype="multipart/form-data"
        >
            @csrf

            <input type="hidden" id="formUsersEdit_method" name="_method" value="PUT" />

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
                                    <input type="text" id="users_sort_order" name="sort_order" class="ss-backend-field-numeric01" maxlength="10" value="{{ $oudRecord['tblUsersSortOrder_print'] }}" />
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
                                    <input type="text" id="users_name_full" name="name_full" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersNameFull'] }}" />
                                </td>
                            </tr>
                        @endif
                        @if (config('app.gSystemConfig.enableUsersNameFirst') === 1)
                            <tr id="inputRowUsers_name_first" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersNameFirst') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_name_first" name="name_first" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersNameFirst'] }}" />
                                </td>
                            </tr>
                        @endif
                        @if (config('app.gSystemConfig.enableUsersNameLast') === 1)
                            <tr id="inputRowUsers_name_last" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersNameLast') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_name_last" name="name_last" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersNameLast'] }}" />
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
                                    {{-- TODO: test ===. --}}
                                    @if (config('app.gSystemConfig.enableUsersDateBirth') === 2)
                                        @if (config('app.gSystemConfig.configBackendDateFormat') === 1)
                                            <select id="users_date_birth_day" name="date_birth_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => 4]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $oudRecord['tblUsersDateBirthDateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="users_date_birth_month" name="date_birth_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => 4]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $oudRecord['tblUsersDateBirthDateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="users_date_birth_year" name="date_birth_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => 4]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $oudRecord['tblUsersDateBirthDateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select id="users_date_birth_month" name="date_birth_month" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('mm', 1, ['dateType' => 4]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $oudRecord['tblUsersDateBirthDateMonth'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="users_date_birth_day" name="date_birth_day" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('d', 1, ['dateType' => 4]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $oudRecord['tblUsersDateBirthDateDay'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            /
                                            <select id="users_date_birth_year" name="date_birth_year" class="ss-backend-field-dropdown01">
                                                @foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1, ['dateType' => 4]) as $arrayRow)
                                                    <option
                                                        value="{{ $arrayRow }}"
                                                        {{ $oudRecord['tblUsersDateBirthDateYear'] == $arrayRow ? ' selected' : ''}}
                                                    >
                                                        {{ $arrayRow }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif

                                    {{-- js-datepicker. --}}
                                    @if (config('app.gSystemConfig.enableUsersDateBirth') === 11)
                                        <input type="text" id="users_date_birth" name="date_birth" class="ss-backend-field-date01" autocomplete="off" value="{{ $oudRecord['tblUsersDateBirth_print'] }}" />
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
                                    <input type="radio" name="gender"{{ $oudRecord['tblUsersGender'] === 0 ? ' checked' : '' }} checked value="0" class="ss-backend-field-radio" />
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemGender0') }}:
                                </label>
                                <label class="ss-backend-field-radio-label">
                                    <input type="radio" name="gender"{{ $oudRecord['tblUsersGender'] === 1 ? ' checked' : '' }} value="1" class="ss-backend-field-radio" />
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemGender1') }}:
                                </label>
                                <label class="ss-backend-field-radio-label">
                                    <input type="radio" name="gender"{{ $oudRecord['tblUsersGender'] === 2 ? ' checked' : '' }} value="2" class="ss-backend-field-radio" />
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
                                    <input type="text" id="users_document" name="document" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersDocument'] }}" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersAddress') === 1)
                            <tr id="inputRowUsers_address_street" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressStreet') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_address_street" name="address_street" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersAddressStreet'] }}" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_address_number" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressNumber') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_address_number" name="address_number" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersAddressNumber'] }}" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_address_complement" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressComplement') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_address_complement" name="address_complement" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersAddressComplement'] }}" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_neighborhood" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressNeighborhood') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_neighborhood" name="neighborhood" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersNeighborhood'] }}" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_district" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressDistrict') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_district" name="district" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersDistrict'] }}" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_county" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressCounty') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_county" name="county" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersCounty'] }}" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_city" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressCity') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_city" name="city" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersCity'] }}" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_state" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressState') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_state" name="state" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersState'] }}" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_country" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressCountry') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_country" name="country" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersCountry'] }}" />
                                </td>
                            </tr>

                            <tr id="inputRowUsers_zip_code" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemAddressZipCode') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_zip_code" name="zip_code" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersZipCode'] }}" />
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
                                        +<input type="text" id="users_phone1_international_code" name="phone1_international_code" class="ss-backend-field-tel-ac01" maxlength="3" value="{{ $oudRecord['tblUsersPhone1InternationalCode'] }}" />
                                    @endif
                                    (<input type="text" id="users_phone1_area_code" name="phone1_area_code" class="ss-backend-field-tel-ac01" maxlength="10" value="{{ $oudRecord['tblUsersPhone1AreaCode'] }}" />)
                                    <input type="text" id="users_phone1" name="phone1" class="ss-backend-field-tel01" maxlength="255" value="{{ $oudRecord['tblUsersPhone1'] }}" />
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
                                        +<input type="text" id="users_phone2_international_code" name="phone2_international_code" class="ss-backend-field-tel-ac01" maxlength="3" value="{{ $oudRecord['tblUsersPhone2InternationalCode'] }}" />
                                    @endif
                                    (<input type="text" id="users_phone2_area_code" name="phone2_area_code" class="ss-backend-field-tel-ac01" maxlength="10" value="{{ $oudRecord['tblUsersPhone2AreaCode'] }}" />)
                                    <input type="text" id="users_phone2" name="phone2" class="ss-backend-field-tel01" maxlength="255" value="{{ $oudRecord['tblUsersPhone2'] }}" />
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
                                        +<input type="text" id="users_phone3_international_code" name="phone3_international_code" class="ss-backend-field-tel-ac01" maxlength="3" value="{{ $oudRecord['tblUsersPhone3InternationalCode'] }}" />
                                    @endif
                                    (<input type="text" id="users_phone3_area_code" name="phone3_area_code" class="ss-backend-field-tel-ac01" maxlength="10" value="{{ $oudRecord['tblUsersPhone3AreaCode'] }}" />)
                                    <input type="text" id="users_phone3" name="phone3" class="ss-backend-field-tel01" maxlength="255" value="{{ $oudRecord['tblUsersPhone3'] }}" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersUsername') === 1)
                            <tr id="inputRowUsers_username" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersUsername') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_username" name="username" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersUsername'] }}" />
                                </td>
                            </tr>
                        @endif

                        @if (config('app.gSystemConfig.enableUsersEmail') === 1)
                            <tr id="inputRowUsers_email" class="ss-backend-table-bg-light">
                                <td class="ss-backend-table-bg-medium">
                                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemEmail') }}:
                                </td>
                                <td>
                                    <input type="text" id="users_email" name="email" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersEmail'] }}" />
                                </td>
                            </tr>
                        @endif

                        <tr id="inputRowUsers_password" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemPassword') }}:
                            </td>
                            <td>
                                <input type="password" id="users_password" name="password" class="ss-backend-field-text01" maxlength="255" value="{{ $oudRecord['tblUsersPassword_edit'] }}" />
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
                                        <input type="text" id="users_info1" name="info1" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo1_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo1FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info1" name="info1" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo1_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info1" name="info1" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo1_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info1";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo1FieldType') === 11)
                                        <input type="text" id="users_info1" name="info1" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo1_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo1FieldType') === 12)
                                        <textarea id="users_info1" name="info1" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo1_edit'] }}</textarea>
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
                                        <input type="text" id="users_info2" name="info2" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo2_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo2FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info2" name="info2" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo2_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info2" name="info2" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo2_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info2";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo2FieldType') === 11)
                                        <input type="text" id="users_info2" name="info2" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo2_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo2FieldType') === 12)
                                        <textarea id="users_info2" name="info2" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo2_edit'] }}</textarea>
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
                                        <input type="text" id="users_info3" name="info3" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo3_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo3FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info3" name="info3" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo3_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info3" name="info3" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo3_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info3";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo3FieldType') === 11)
                                        <input type="text" id="users_info3" name="info3" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo3_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo3FieldType') === 12)
                                        <textarea id="users_info3" name="info3" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo3_edit'] }}</textarea>
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
                                        <input type="text" id="users_info4" name="info4" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo4_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo4FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info4" name="info4" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo4_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info4" name="info4" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo4_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info4";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo4FieldType') === 11)
                                        <input type="text" id="users_info4" name="info4" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo4_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo4FieldType') === 12)
                                        <textarea id="users_info4" name="info4" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo4_edit'] }}</textarea>
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
                                        <input type="text" id="users_info5" name="info5" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo5_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo5FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info5" name="info5" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo5_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info5" name="info5" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo5_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info5";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo5FieldType') === 11)
                                        <input type="text" id="users_info5" name="info5" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo5_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo5FieldType') === 12)
                                        <textarea id="users_info5" name="info5" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo5_edit'] }}</textarea>
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
                                        <input type="text" id="users_info6" name="info6" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo6_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo6FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info6" name="info6" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo6_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info6" name="info6" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo6_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info6";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo6FieldType') === 11)
                                        <input type="text" id="users_info6" name="info6" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo6_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo6FieldType') === 12)
                                        <textarea id="users_info6" name="info6" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo6_edit'] }}</textarea>
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
                                        <input type="text" id="users_info7" name="info7" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo7_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo7FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info7" name="info7" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo7_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info7" name="info7" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo7_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info7";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo7FieldType') === 11)
                                        <input type="text" id="users_info7" name="info7" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo7_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo7FieldType') === 12)
                                        <textarea id="users_info7" name="info7" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo7_edit'] }}</textarea>
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
                                        <input type="text" id="users_info8" name="info8" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo8_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo8FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info8" name="info8" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo8_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info8" name="info8" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo8_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info8";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo8FieldType') === 11)
                                        <input type="text" id="users_info8" name="info8" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo8_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo8FieldType') === 12)
                                        <textarea id="users_info8" name="info8" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo8_edit'] }}</textarea>
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
                                        <input type="text" id="users_info9" name="info9" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo9_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo9FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info9" name="info9" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo9_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info9" name="info9" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo9_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info9";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo9FieldType') === 11)
                                        <input type="text" id="users_info9" name="info9" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo9_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo9FieldType') === 12)
                                        <textarea id="users_info9" name="info9" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo9_edit'] }}</textarea>
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
                                        <input type="text" id="users_info10" name="info10" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo10_edit'] }}" />
                                    @endif

                                    {{-- Multiline. --}}
                                    @if (config('app.gSystemConfig.configUsersInfo10FieldType') === 2)
                                        {{-- No formatting. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 1)
                                            <textarea id="users_info10" name="info10" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo10_edit'] }}</textarea>
                                        @endif

                                        {{-- TinyMCE. --}}
                                        @if (config('app.gSystemConfig.configBackendTextBox') === 17 || config('app.gSystemConfig.configBackendTextBox')  === 18)
                                            <textarea id="users_info10" name="info10" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo10_edit'] }}</textarea>
                                            <script>
                                                tinyMCEBackendConfig.selector = "#users_info10";
                                                tinymce.init(tinyMCEBackendConfig);
                                            </script>
                                        @endif
                                    @endif

                                    {{-- Single line (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo10FieldType') === 11)
                                        <input type="text" id="users_info10" name="info10" class="ss-backend-field-text01" value="{{ $oudRecord['tblUsersInfo10_edit'] }}" />
                                    @endif

                                    {{-- Multiline (encrypted). --}}
                                    @if (config('app.gSystemConfig.configUsersInfo10FieldType') === 12)
                                        <textarea id="users_info10" name="info10" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersInfo10_edit'] }}</textarea>
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
                                    @if ($oudRecord['tblUsersImageMain'] !== '')
                                        <img id="imgUsersImageMain" src="{{ config('app.gSystemConfig.configSystemURLImages') . config('app.gSystemConfig.configDirectoryFilesSD') . '/t' . $oudRecord['tblUsersImageMain'] . '?v=' . $cacheClear }}" alt="{{ $oudRecord['tblUsersNameFull'] }}" class="ss-backend-images-edit" />
                                            {{-- TODO: condition tblUsersNameFull to being enabled, etc. --}}
                                        <div id="divUsersImageMainDelete" style="position: relative; display: inline-block;">
                                            {{-- TODO: investigate why this stopped working after config refactor (configSystemURLSSL) --}}
                                            <a class="ss-backend-delete01"
                                                onclick="htmlGenericStyle01('updtProgressGeneric', 'display', 'block');
                                                ajaxRecordsPatch01_async('{{ config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') }}/',
                                                                            {
                                                                                idRecord: '{{ $oudRecord['tblUsersID'] }}',
                                                                                strTable: '{{ config('app.gSystemConfig.configSystemDBTableUsers') }}',
                                                                                strField: 'image_main',
                                                                                recordValue: '',
                                                                                patchType: 'fileDelete',
                                                                                ajaxFunction: true,
                                                                                apiKey: '{{ \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite(config('app.gSystemConfig.configAPIKeySystem'), 'env'), 2) }}'
                                                                            },
                                                                            async function(_resObjReturn) {
                                                                                // alert(JSON.stringify(_resObjReturn));

                                                                                if(_resObjReturn.returnStatus === true) {
                                                                                    // Delete files.


                                                                                    // Hide elements.
                                                                                    htmlGenericStyle01('imgUsersImageMain', 'display', 'none');
                                                                                    htmlGenericStyle01('divUsersImageMainDelete', 'display', 'none');

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

                        <tr id="inputRowUsers_activation" class="ss-backend-table-bg-light">
                            <td class="ss-backend-table-bg-medium">
                                {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation') }}:
                            </td>
                            <td>
                                <select id="users_activation" name="activation" class="ss-backend-field-dropdown01">
                                    <option value="1"{{ $oudRecord['tblUsersActivation'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                    <option value="0"{{ $oudRecord['tblUsersActivation'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                    <option value="1"{{ $oudRecord['tblUsersActivation1'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                    <option value="0"{{ $oudRecord['tblUsersActivation1'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                    <option value="1"{{ $oudRecord['tblUsersActivation2'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                    <option value="0"{{ $oudRecord['tblUsersActivation2'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                    <option value="1"{{ $oudRecord['tblUsersActivation3'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                    <option value="0"{{ $oudRecord['tblUsersActivation3'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                    <option value="1"{{ $oudRecord['tblUsersActivation4'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                    <option value="0"{{ $oudRecord['tblUsersActivation4'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                    <option value="1"{{ $oudRecord['tblUsersActivation5'] === 1 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation1') }}</option>
                                    <option value="0"{{ $oudRecord['tblUsersActivation5'] === 0 ? ' selected' : '' }}>{{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendItemActivation0') }}</option>
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
                                    <textarea id="users_notes" name="notes" class="ss-backend-field-text-area01">{{ $oudRecord['tblUsersNotes_edit'] }}</textarea>
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
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendButtonUpdate') }}
                </button>

                <a onclick="history.go(-1);" class="ss-backend-btn-base ss-backend-btn-action-alert" style="float: right;">
                    {{ \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendButtonBack') }}
                </a>
            </div>

            <input type="hidden" id="users_id" name="id" value="{{ $oudRecord['tblUsersID'] }}" />
            <input type="hidden" id="users_id_parent" name="id_parent" value="{{ $oudRecord['tblUsersIdParent'] }}" />
            <input type="hidden" id="users_id_type" name="id_type" value="{{ $oudRecord['tblUsersIdType'] }}" />
            <input type="hidden" id="users_name_title" name="name_title" value="" />
                {{-- TODO: double check if this name_title should be blank --}}
            <input type="hidden" id="users_id_status" name="id_status" value="{{ $oudRecord['tblUsersIdStatus'] }}" />

            <input type="hidden" id="users_idParent" name="idParent" value="{{ $oudRecord['tblUsersIdParent'] }}" />
                {{-- TODO: evaluate if should be the array variable or the view variable. ex: $idParent --}}
            <input type="hidden" id="users_pageNumber" name="pageNumber" value="{{ $pageNumber }}" />
            <input type="hidden" id="users_masterPageSelect" name="masterPageSelect" value="{{ $masterPageSelect }}" />
        </form>
    </section>
@endsection
