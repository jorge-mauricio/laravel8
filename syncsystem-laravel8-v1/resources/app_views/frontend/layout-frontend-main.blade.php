<!DOCTYPE html>
<html lang="en-us">{{-- en | en-us --}}
    <head>
        {{-- Include tracking. --}}
        @include('tracking-codes')

        <meta charset="UTF-8" />
        @include('frontend.partials.tags-meta-default1')

        <title>@yield('cphTitle')</title>

        @include('frontend.partials.tags-style-css')


    </head>
    <body>
        @yield('cphBody')
    </body>
</html>
