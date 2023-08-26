@php
    // TODO: condition with
    /*
    $tblUsersIDLogged = '';
    $tblUsersRootIDLogged = '';
    echo 'user admin=' . \SyncSystemNS\FunctionsCookies::cookieRead(config('app.gSystemConfig.configCookiePrefix') . '_' . config('app.gSystemConfig.configCookiePrefixUserAdmin')) . '<br />';
    echo 'user root=' . \SyncSystemNS\FunctionsCookies::cookieRead(config('app.gSystemConfig.configCookiePrefix') . '_' . config('app.gSystemConfig.configCookiePrefixUserRoot')) . '<br />';
    */
@endphp
<!DOCTYPE html>
<html lang="en-us">{{-- en | en-us --}}
    <head>
        {{-- Include tracking. --}}
        @include('tracking-codes')

        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />{{-- Bootstrap required. --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>@yield('cphTitle'){{-- $templateData['cphTitle'] --}}</title>

        {{-- Style Sheets - personalized. http://localhost:8000 | ../../ --}}
        <!--% if(gSystemConfig.configDebug === true){ %-->
            <link rel="stylesheet" type="text/css" href="{{ asset(config('app.gSystemConfig.configDirectoryStylesSD') . '/' . 'styles-backend.bundle.css') }}" media="screen" title="Default" />{{-- Dev --}}
        <!--% } %>
        <% if(gSystemConfig.configDebug === false){ %-->
            <!--link rel="stylesheet" type="text/css" href="/<%- gSystemConfig.configDirectoryDistSD %>/styles-backend.bundle.css" media="screen" title="Default" /--><!--Production (custom styles)-->
            <!--link rel="stylesheet" type="text/css" href="/<%- gSystemConfig.configDirectoryDistSD %>/styles-backend-vendor.bundle.css" media="screen" title="Default" /--><!--Production (vendor styles)-->
        <!--% } %-->
        <link rel="canonical" href="{{ config('app.gSystemConfig.configSystemURL') }}" />

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

        <meta name="author" content="<?php echo \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application'); ?>" />
        <meta name="designer" content="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'layoutDevName'); ?>" />
        <meta name="copyright" content="<?php echo config('app.gSystemConfig.configCopyrightYear'); ?>, <?php echo \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application'); ?>" />
        <meta name="rating" content="general" />{{-- general | mature | restricted | 14 years --}}

        {{-- JS includes. --}}
        @include('admin.partials.js-head')

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
    @php
        // Debug.
        // echo 'idTbUsersLogged=';
        // var_dump($idTbUsersLogged);
        // echo '<br />';

        // echo 'idTbUsersRootLogged=';
        // var_dump($idTbUsersRootLogged);
        // echo '<br />';
    @endphp
        <div id="containerMain" style="position: relative; display: flex; flex-direction: column; min-height: 100vh;">
            <header style="position: relative; display: block; overflow: hidden;">
                <div style="position: relative; display: block; height: 20px; background-color: #6c7880; overflow: hidden;">

                </div>
                <div class="ss-backend-title-main" style="position: relative; display: block; height: 40px; line-height: 40px; text-indent: 15px; background-color: #d1d8dc; border: 1px solid #6c7880; border-radius: 0px 0px 15px 15px; margin-top: 2px; overflow: hidden;">
                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'layoutSystemName'); ?>
                </div>
                <div style="position: relative; display: block; height: 72px; background-image: url({{ asset('/' . config('app.gSystemConfig.configDirectoryFilesLayoutSD') . '/backend-layout-header-tb02-02.jpg') }}); background-repeat: repeat-x; background-position: top center; overflow: hidden;">
                    <img src="{{ asset('/' . config('app.gSystemConfig.configDirectoryFilesLayoutSD') . '/backend-layout-header-tb02-03.jpg') }}" alt="Header Element" style="position: absolute; display: block; top: 0px; right: -8px;" />
                    <img src="{{ asset('/' . config('app.gSystemConfig.configDirectoryFilesLayoutSD') . '/backend-layout-header-tb02-01.jpg') }}" alt="Header Element" style="position: absolute; display: block; top: 0px; left: -8px;" />

                    <aside style="position: absolute; display: block; top: 6px; right: 8px; width: 150px;">
                        <ul class="ss-backend-menu-ul01" style="color: #000000; list-style-type: disc; line-height: 11px;">
                            <li class="ss-backend-menu-li01">
                                <a href=""
                                    class="ss-backend-menu-header-link"
                                    title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuHome'); ?>">
                                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuHome'); ?>
                                </a>
                            </li>
                            <li class="ss-backend-menu-li01">
                                <a href="http://www.syncsystem.com.br"
                                    class="ss-backend-menu-header-link"
                                    target="_blank"
                                    title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuSiteSystem'); ?>">
                                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuSiteSystem'); ?>
                                </a>
                            </li>
                            <li class="ss-backend-menu-li01">
                                <a href="http://www.syncsystem.com.br/pt/Contato.aspx"
                                    class="ss-backend-menu-header-link"
                                    target="_blank"
                                    title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuContact'); ?>">
                                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuContact'); ?>
                                </a>
                            </li>
                        </ul>
                    </aside>
                </div>
            </header>

            <main style="position: relative; display: flex; flex: 1; align-items: stretch;">
                <?php // Left column. ?>
                <div style="position: relative; display: block; min-width: 222px; max-width: 222px; background-image: url({{ asset('/' . config('app.gSystemConfig.configDirectoryFilesLayoutSD') . '/backend-layout-nav01-tb01-02.jpg') }}); background-position: left; background-repeat: repeat-y; overflow: hidden;">
                    <img src="{{ asset('/' . config('app.gSystemConfig.configDirectoryFilesLayoutSD') . '/backend-layout-nav01-tb01-01.jpg') }}" alt="Nav Element" style="position: absolute; display: block; top: 0px; left: 0px; margin-top: -25px;" />

                    <nav style="position: relative; display: block; padding-top: 20px; margin-left: 37px; z-index: 1;">
                        <ul class="ss-backend-menu-ul01">
                            {{-- User - Admin. --}}
                            @if ($idTbUsersLogged)
                                <li class="ss-backend-menu-li01">
                                    <a
                                        href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/0' }}"
                                        class="ss-backend-menu-link"
                                        title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuStartToolTip'); ?>"
                                    >
                                        <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuStart'); ?>
                                    </a>
                                </li>

                                <li class="ss-backend-menu-li01">
                                    <a
                                        href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendLogOff') . '/' }}"
                                        class="ss-backend-menu-link"
                                        title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuLogUsersOffToolTip'); ?>"
                                    >
                                        <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuUsersLogOff'); ?>
                                    </a>
                                </li>

                                @if (config('app.gSystemConfig.enableBackendSearch') === 1)
                                    <li class="ss-backend-menu-li01">
                                        <a
                                            href="#"
                                            class="ss-backend-menu-link"
                                            title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuSearchToolTip'); ?>"
                                        >
                                            <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuSearch'); ?>
                                        </a>
                                    </li>
                                @endif

                                @if (config('app.gSystemConfig.enableBackendMaintenanceCategories') === 1)
                                    <li class="ss-backend-menu-li01">
                                        <a
                                            onclick="htmlGenericStyle01('divSubmenuCategoriesFiltersGeneric', 'display', 'block');"
                                            title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuCategoriesMaintenanceToolTip'); ?>"
                                            class="ss-backend-menu-link"
                                        >
                                            <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuCategoriesMaintenance'); ?>
                                        </a>
                                        {{-- TODO: double-check layout margin indent. --}}
                                        <div id="divSubmenuCategoriesFiltersGeneric" style="position: relative; display: none; margin-left: 20px;">
                                            @if (config('app.gSystemConfig.enableCategoriesStatus') === 1)
                                                <a
                                                    href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/?tableName=' . config('app.gSystemConfig.configSystemDBTableCategories') . '&filterIndex=2' }}"
                                                    title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesStatus'); ?>"
                                                    class="ss-backend-menu-link"
                                                >
                                                    - <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesStatus'); ?>
                                                </a>
                                            @endif

                                            @for ($countFilterIndex = 1; $countFilterIndex <= 10; $countFilterIndex++)
                                                @if (config('app.gSystemConfig.enableCategoriesFilterGeneric' . $countFilterIndex) !== 0)
                                                    <a
                                                        href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/?tableName=' . config('app.gSystemConfig.configSystemDBTableCategories') . '&filterIndex=10' . $countFilterIndex }}"
                                                        title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric' . $countFilterIndex); ?>"
                                                        class="ss-backend-menu-link"
                                                    >
                                                        - <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesFilterGeneric' . $countFilterIndex); ?>
                                                    </a>
                                                @endif
                                            @endfor
                                        </div>
                                    </li>
                                @endif
                            @endif

                            {{-- User - Root. --}}
                            @if ($idTbUsersRootLogged)
                                <li class="ss-backend-menu-li01">
                                    <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . config('app.gSystemConfig.configRouteBackendActionEdit') . '/' . $idTbUsersRootLogged }}"
                                        class="ss-backend-menu-link"
                                        title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuUsersPasswordEditToolTip'); ?>">
                                            <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuUsersPasswordEdit'); ?>
                                    </a>
                                </li>

                                <li class="ss-backend-menu-li01">
                                    <a href="{{ '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendLogOffUsersRoot') . '/' }}"
                                        class="ss-backend-menu-link"
                                        title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuLogUsersOffToolTip'); ?>">
                                            <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendMenuUsersLogOff'); ?>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>

                    <footer class="ss-backend-copyright" style="position: absolute; display: block; bottom: 0px; left: 0px; background-color: #ffffff; padding-bottom: 8px;">
                        <img src="{{ asset('/' . config('app.gSystemConfig.configDirectoryFilesLayoutSD') . '/backend-layout-nav01-tb01-03.jpg') }}" alt="Footer Element" style="position: absolute; display: block; top: -56px; left: 0px;" />
                        <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'layoutCopyright') . ' ' . config('app.gSystemConfig.configCopyrightYear') . ' ® ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'layoutDevName'); ?>
                    </footer>
                </div>
                <?php // Left column. ?>

                <?php // Right column. ?>
                <div style="position: relative; display: block; width: 100%; overflow: hidden;">
                    <h1 class="ss-backend-title01" style="position: relative; display: block; border-top: 4px double #b6bcc0; border-bottom: 4px double #b6bcc0; font-size: 18px; margin-bottom: 2px;">
                        <?php // Title content. ?>
                        <!--%- templateData.cphTitleCurrent %-->
                        {{-- $templateData['cphTitleCurrent'] --}}
                        @yield('cphTitleCurrent')
                    </h1>

                    <div id="divMainSuccess" class="ss-backend-success">

                    </div>
                    <div id="divMainError" class="ss-backend-error">

                    </div>
                    <div id="divMainAlert" class="ss-backend-alert">

                    </div>

                    <?php // Body content. ?>

                    {{-- Debug. --}}
                    <!--%-templateData.cphBody %-->
                    {{--
                    cphBody = {{ $templateData['cphBody'] }} <br />
                    additionalData =
                    @php
                        var_dump($templateData['additionalData']);
                    @endphp
                    --}}
                    {{-- additionalData = {{ $templateData['additionalData'] }} --}}
                    @yield('cphBody')
                    {{-- TODO: pass down--}}
                </div>
                <?php // Right column. ?>
            </main>
        </div>

        <?php // Ajax progress bar. ?>
        <div id="updtProgressGeneric" class="ss-backend-progress-bar-generic1-container" style="display: none;">
            <div class="ss-backend-progress-bar-generic1">
                <img src="{{ asset('/' . config('app.gSystemConfig.configDirectoryFilesLayoutSD') . '/backend-layout-progress-bar-generic1.gif') }}" alt="" />
            </div>
        </div>

        {{-- JS includes. --}}
        @include('admin.partials.js-foot')
    </body>
</html>
