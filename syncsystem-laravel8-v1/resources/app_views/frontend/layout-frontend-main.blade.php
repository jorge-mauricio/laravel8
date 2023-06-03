<!DOCTYPE html>
<html lang="en-us">{{-- en | en-us --}}
    <head>
        {{-- Include tracking. --}}
        @include('tracking-codes')

        <meta charset="UTF-8" />
        @include('frontend.partials.tags-meta-default1')

        <title>@yield('cphTitle')</title>

        @include('frontend.partials.tags-style-css')

        @include('frontend.partials.tags-favicons')

        {{-- Head dynamic tags. --}}
		{{--
            Open Graphics test:
            https://metapreview.app/
            https://www.linkedin.com/post-inspector/
            https://metatags.io/
		--}}
        @yield('cphHead')

        @include('frontend.partials.tags-meta-default2')

        {{-- JS includes. --}}
        @include('frontend.partials.js-head')

        <style type="text/css">
		</style>
    </head>
    <body class="ss-frontend-body01">
        <noscript>Please Enable JavaScript</noscript>
        <div id="root">
            <header class="ss-frontend-layout-header01">
                <div>
                    <a href="/" title="Home" class="ss-frontend-layout-header-logo">

                    </a>
                    <a href="tel:{{ str_replace(' ', '-', config('app.gSystemConfig.configSystemClientCel')) }}" title="Phone" class="ss-frontend-link-contact01 ss-frontend-link-contact-layout">
                        {!! config('app.gSystemConfig.configSystemClientCel') !!}
                    </a>

                    {{-- Social media. --}}
                    <address class="ss-frontend-social-media-layout">
                        <a href="https://www.linkedin.com/in/xxx/" target="_blank" title="LinkedIn" class="ss-frontend-social-media">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://youtu.be/xxx" target="_blank" title="YouTube" class="ss-frontend-social-media">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="mailto:{{ config('app.gSystemConfig.configSystemClientEmail') }}" target="_blank" title="e-mail" class="ss-frontend-social-media">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </address>

                    <nav>
                        {{-- TODO: ul / li structure. --}}
                        <a class="ss-frontend-link01" href="/" title="Home">
                            Link - Home
                        </a>
                        <a class="ss-frontend-link01" href="/{{ config('app.gSystemConfig.configRouteFrontendCategories') }}/813/" title="Categories">
                            Link - Categories
                        </a>
                        <a class="ss-frontend-link01" href="/{{ config('app.gSystemConfig.configRouteFrontendContent') }}/849/" title="Content">
                            Link - Content
                        </a>
                        <a class="ss-frontend-link01" href="/{{ config('app.gSystemConfig.configRouteFrontendContent') }}/849/?idTbForms=904" title="Content">
                            Link - Content with form
                        </a>
                        <a class="ss-frontend-link01" href="/{{ config('app.gSystemConfig.configRouteFrontendProducts') }}/960/" title="Products">
                            Link - Products
                        </a>
                        <a class="ss-frontend-link01" href="/{{ config('app.gSystemConfig.configRouteFrontendPublications') }}/1369/" title="Publications">
                            Link - Publications
                        </a>
                        <a class="ss-frontend-link01" href="/{{ config('app.gSystemConfig.configRouteFrontendQuizzes') }}/1648/" title="Quizzes">
                            Link - Quizzes
                        </a>
                        <a class="ss-frontend-link01" href="/{{ config('app.gSystemConfig.configRouteFrontendLogin') }}/" title="Login">
                            Link - Login
                        </a>
                        <a class="ss-frontend-link01" href="/{{ config('app.gSystemConfig.configRouteFrontendLogoff') }}/" title="Logoff">
                            Link - Logoff
                        </a>
                        <a class="ss-frontend-link01" href="/{{ config('app.gSystemConfig.configRouteFrontendDashboard') }}/" title="Dashboard">
                            Link - Dashboard
                        </a>
                    </nav>
                </div>
            </header>

            {{-- Banners --}}
            <div>

            </div>

            <h1 id="titleCurrent" class="ss-frontend-heading01">
                {{-- Content place holder - current title --}}
                @yield('cphTitleCurrent')
            </h1>

            {{-- Messages --}}
            <div id="messageSuccess" class="ss-frontend-success" style="display: none;"></div>
            <div id="messageError" class="ss-frontend-error" style="display: none;"></div>
            <div id="messageAlert" class="ss-frontend-alert" style="display: none;"></div>

            <main>
                {{-- Content place holder - body --}}
                @yield('cphBody')
            </main>

            <footer class="ss-frontend-layout-footer01">
                <nav>
                    <ul class="ss-frontend-links-ul02" style="/*position: absolute; left: 0px; top: 0px;*/">
                        <li class="ss-frontend-links-li02">
                            <a href="/" title="Home" class="ss-frontend-footer-links01">
                                Home
                            </a>
                        </li>
                        <li class="ss-frontend-links-li02">
                            <a href="/" title="Home" class="ss-frontend-footer-links01">
                                Home
                            </a>
                        </li>
                        <li class="ss-frontend-links-li02">
                            <a href="/" title="Home" class="ss-frontend-footer-links01">
                                Home
                            </a>
                        </li>
                    </ul>

                    <a href="tel:{{ str_replace(' ', '-', config('app.gSystemConfig.configSystemClientCel')) }}" title="Phone" class="ss-frontend-footer-links01 ss-frontend-footer-contact-layout">
                        {!! config('app.gSystemConfig.configSystemClientCel') !!}
                    </a>
                    <a href="mailto:{{ config('app.gSystemConfig.configSystemClientEmail') }}" title="e-mail" class="ss-frontend-footer-links01 ss-frontend-footer-email-layout d-none d-lg-block d-xl-block">
                        {!! config('app.gSystemConfig.configSystemClientEmail') !!}
                    </a>
                </nav>

                {{-- Social media. --}}
                <address class="ss-frontend-social-media-layout-footer">
                    <a href="https://www.linkedin.com/in/xxx/" target="_blank" title="LinkedIn" class="ss-frontend-social-media-footer">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://youtu.be/xxx" target="_blank" title="YouTube" class="ss-frontend-social-media-footer">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="mailto:{{ config('app.gSystemConfig.configSystemClientEmail') }}" target="_blank" title="e-mail" class="ss-frontend-social-media-footer">
                        <i class="fas fa-envelope"></i>
                    </a>
                </address>

                {{-- Credits --}}
                <small class="ss-frontend-copyright ss-frontend-credit-layout">
                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageFrontend')->appLabels, 'layoutCopyright'); ?> ©&nbsp;
                    <?php echo config('app.gSystemConfig.configCopyrightYear') ?>&nbsp;
                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageFrontend')->appLabels, 'configSiteTile'); ?>.&nbsp;
                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageFrontend')->appLabels, 'layoutCopyright1'); ?>

                    {{-- Development --}}
                    <a href="{{ config('app.gSystemConfig.configDevSite') }}" target="_blank" class="ss-frontend-credit" style="float: right;">
                        <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageFrontend')->appLabels, 'layoutDevelopment'); ?>:&nbsp;
                        <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageFrontend')->appLabels, 'layoutDevName'); ?>
                    </a>
                </small>
            </footer>
        </div>

        {{-- JS includes. --}}
        @include('frontend.partials.js-foot')
    </body>
</html>
