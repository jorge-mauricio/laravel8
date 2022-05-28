{{-- @include('admin.include-layout') --}}
{{-- @extends('admin.layout-admin-main') --}}
{{-- @extends('admin.{{$masterPageSelect}}') --}}
{{-- @extends({{'admin.' . $masterPageSelect}}) --}}
{{-- @extends('admin.' . $masterPageSelect) --}}
{{-- @extends('admin.' . $GLOBALS['masterPageSelect']) --}}
@extends('admin.' . $templateData['masterPageSelect'])

@section('cphTitle')
    {{ $templateData['cphTitle'] }}
@endsection

@section('cphTitleCurrent')
    {{ $templateData['cphTitleCurrent'] }}
@endsection

@section('cphBody')
    <pre>
        @php
            // Debug.
            echo '_GET=' . $_GET['masterPageSelect'] . '<br />';
            // echo 'masterPageSelect=' . $masterPageSelect . '<br />';

            var_dump($templateData['cphBody']);
            // var_dump($templateData['additionalData']);
        @endphp
    </pre>
@endsection