@extends('admin.layout-admin-main')


@section('cphTitle')
    {{ $templateData['cphTitle'] }}
@endsection

@section('cphTitleCurrent')
    {{ $templateData['cphTitleCurrent'] }}
@endsection

@section('cphBody')
    <pre>
        @php
            var_dump($templateData['cphBody']);
            // var_dump($templateData['additionalData']);
        @endphp
    </pre>
@endsection