<!DOCTYPE html>
<html lang="en">
    <head>
        {{-- include tracking --}}
        @include('layout-include-tracking-codes')

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">{{-- Bootstrap required. --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@yield('cphTitle')</title>

        {{-- Style Sheets - JS dependencies. --}}

        <?php // Style Sheets - personalized. http://localhost:3000 | ../../ ?>
        <!--% if(gSystemConfig.configDebug === true){ %-->
            <link rel="stylesheet" type="text/css" href="{{ asset('css/styles-backend.bundle.css') }}" media="screen" title="Default" /><!--Dev-->
        <!--% } %>
        <% if(gSystemConfig.configDebug === false){ %-->
            <!--link rel="stylesheet" type="text/css" href="/<%- gSystemConfig.configDirectoryDistSD %>/styles-backend.bundle.css" media="screen" title="Default" /--><!--Production (custom styles)-->
            <!--link rel="stylesheet" type="text/css" href="/<%- gSystemConfig.configDirectoryDistSD %>/styles-backend-vendor.bundle.css" media="screen" title="Default" /--><!--Production (vendor styles)-->
        <!--% } %-->
        <link rel="canonical" href="<?php echo $GLOBALS['configSystemURL']; ?>" />
        
        {{--
            Favicon - 16x16 | 32x32 | 64x64 (pixels).
            Export settings: PNG: 558 x 558 pixels.
            https://realfavicongenerator.net/
        --}}

		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
		<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
		<!--link rel="manifest" href="../site.webmanifest" /-->
		<!--link rel="manifest" href="../../site.json" /--> <!--IIS compatible: (ref: https://devanswers.co/site-webmanifest-error-404-401/).-->
		<!--link rel="manifest" href="/<%- gSystemConfig.configDirectoryFilesLayoutSD %>/site.webmanifest" /-->
		<link rel="manifest" href="/site.webmanifest" />
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5" />
		<meta name="msapplication-TileColor" content="#009154" />
		<meta name="theme-color" content="#ffffff" />

		{{--
            Open Graphics test:
            https://metapreview.app/
            https://www.linkedin.com/post-inspector/
            https://metatags.io/
		--}}

        {{-- Head - custom. --}}
        @yield('cphHead')

        <meta name="robots" content="index,follow,noarchive" />
        {{--
            all - No restrictions (default).
            index,follow - Indexes pages and follow the links.
            noindex,nofollow - Don´t index pages (not in cache) and don´t follow the links.
            noarchive - Don´t show link "in cache".
            nosnippet - Don´t show snippets.
            notranslate - Don´t translate.
            noimageindex - Don´t index images.
            unavailable_after: [RFC-850 date/time] - Don´t show page in index after a specif date.
        --}}

        <meta name="author" content="<?php echo \SyncSystemNS\FunctionsGeneric::contentMaskRead($GLOBALS['configSystemClientName'], 'config-application'); ?>" />
		<meta name="designer" content="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'layoutDevName'); ?>" />
		<meta name="copyright" content="<?php echo $GLOBALS['configCopyrightYear']; ?>, <?php echo \SyncSystemNS\FunctionsGeneric::contentMaskRead($GLOBALS['configSystemClientName'], 'config-application'); ?>" />
		<meta name="rating" content="general" />{{-- general | mature | restricted | 14 years --}}

        {{-- JS includes. --}}
        @include('admin.layout-admin-include-js-head')
        
        <style type="text/css">
            /*html, body
            {
                margin: 0px;
                padding: 0px;
            }
            */
		</style>
    </head>
    <body>
        @yield('cphBody')
    </body>
</html>