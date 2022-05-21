<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">{{-- Bootstrap required. --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>{{ $templateData['cphTitle'] }}</title>

        <?php // Style Sheets - personalized. http://localhost:3000 | ../../ ?>
        <!--% if(gSystemConfig.configDebug === true){ %-->
            <link rel="stylesheet" type="text/css" href="{{ asset('css/styles-backend.css') }}" media="screen" title="Default" /><!--Dev-->
        <!--% } %>
        <% if(gSystemConfig.configDebug === false){ %-->
            <!--link rel="stylesheet" type="text/css" href="/<%- gSystemConfig.configDirectoryDistSD %>/styles-backend.bundle.css" media="screen" title="Default" /--><!--Production (custom styles)-->
            <!--link rel="stylesheet" type="text/css" href="/<%- gSystemConfig.configDirectoryDistSD %>/styles-backend-vendor.bundle.css" media="screen" title="Default" /--><!--Production (vendor styles)-->
        <!--% } %-->
        <link rel="canonical" href="<?php echo $GLOBALS['configSystemURL']; ?>" />

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
        <div id="containerMain" style="position: relative; display: flex; flex-direction: column; min-height: 100vh;">
            <header style="position: relative; display: block; overflow: hidden;">
                <div style="position: relative; display: block; height: 20px; background-color: #6c7880; overflow: hidden;">

                </div>
                <div class="ss-backend-title-main" style="position: relative; display: block; height: 40px; line-height: 40px; text-indent: 15px; background-color: #d1d8dc; border: 1px solid #6c7880; border-radius: 0px 0px 15px 15px; margin-top: 2px; overflow: hidden;">
                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'layoutSystemName'); ?>
                </div>
                <div style="position: relative; display: block; height: 72px; background-image: url(/<%- gSystemConfig.configDirectoryFilesLayoutSD %>/backend-layout-header-tb02-02.jpg); background-repeat: repeat-x; background-position: top center; overflow: hidden;">
                    <img src="{{ asset('/app_files_layout/backend-layout-header-tb02-03.jpg') }}" alt="Header Element" style="position: absolute; display: block; top: 0px; right: -8px;" /> 
                    <img src="/<%- gSystemConfig.configDirectoryFilesLayoutSD %>/backend-layout-header-tb02-01.jpg" alt="Header Element" style="position: absolute; display: block; top: 0px; left: -8px;" /> 

                    <aside style="position: absolute; display: block; top: 6px; right: 8px; width: 150px;">
                        <ul class="ss-backend-menu-ul01" style="color: #000000; list-style-type: disc; line-height: 11px;">
                            <li class="ss-backend-menu-li01">
                                <a href="" 
                                    class="ss-backend-menu-header-link" 
                                    title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendMenuHome'); ?>">
                                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendMenuHome'); ?>
                                </a>
                            </li>
                            <li class="ss-backend-menu-li01">
                                <a href="http://www.syncsystem.com.br" 
                                    class="ss-backend-menu-header-link" 
                                    target="_blank" 
                                    title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendMenuSiteSystem'); ?>">
                                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendMenuSiteSystem'); ?>
                                </a>
                            </li>
                            <li class="ss-backend-menu-li01">
                                <a href="http://www.syncsystem.com.br/pt/Contato.aspx" 
                                    class="ss-backend-menu-header-link" 
                                    target="_blank" 
                                    title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendMenuContact'); ?>">
                                    <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendMenuContact'); ?>
                                </a>
                            </li>
                        </ul>
                    </aside>
                </div>
            </header>                    

            <main style="position: relative; display: flex; flex: 1; align-items: stretch;">
                <?php // Left column. ?>
                <div style="position: relative; display: block; min-width: 222px; max-width: 222px; background-image: url(/<%- gSystemConfig.configDirectoryFilesLayoutSD %>/backend-layout-nav01-tb01-02.jpg); background-position: left; background-repeat: repeat-y; overflow: hidden;">
                    <img src="/<%- gSystemConfig.configDirectoryFilesLayoutSD %>/backend-layout-nav01-tb01-01.jpg" alt="Nav Element" style="position: absolute; display: block; top: 0px; left: 0px; margin-top: -25px;" /> 
                    
                    <nav style="position: relative; display: block; padding-top: 20px; margin-left: 37px; z-index: 1;">
                        <ul class="ss-backend-menu-ul01">
                            <li class="ss-backend-menu-li01">
                                <a href="/admin/categories/0" 
                                    class="ss-backend-menu-link" 
                                    title="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendMenuStartToolTip'); ?>">
                                        <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendMenuStart'); ?>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <footer class="ss-backend-copyright" style="position: absolute; display: block; bottom: 0px; left: 0px; background-color: #ffffff; padding-bottom: 8px;">
                        <img src="/<%- gSystemConfig.configDirectoryFilesLayoutSD %>/backend-layout-nav01-tb01-03.jpg" alt="Footer Element" style="position: absolute; display: block; top: -56px; left: 0px;" /> 
                        <?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'layoutCopyright') . ' ' . $GLOBALS['configCopyrightYear'] . ' ® ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'layoutDevName'); ?> 
                    </footer>
                </div>
                <?php // Left column. ?>

                <?php // Right column. ?>
                <div style="position: relative; display: block; width: 100%; overflow: hidden;">
                    <h1 class="ss-backend-title01" style="position: relative; display: block; border-top: 4px double #b6bcc0; border-bottom: 4px double #b6bcc0; font-size: 18px; margin-bottom: 2px;">
                        <?php // Title content. ?>
                        <!--%- templateData.cphTitleCurrent %-->
                        {{ $templateData['cphTitleCurrent'] }}
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
                    cphBody = {{ $templateData['cphBody'] }} <br />
                    additionalData = 
                    @php
                        var_dump($templateData['additionalData']);
                    @endphp
                    {{-- additionalData = {{ $templateData['additionalData'] }} --}}
                    {{-- TODO: pass down--}}
                </div>
                <?php // Right column. ?>
            </main>
        </div>

        <!--%# JS includes. %-->
        <!--%- include('layout-include-backend-js-foot.ejs'); %-->


        <?php // Ajax progress bar. ?>
        <div id="updtProgressGeneric" class="ss-backend-progress-bar-generic1-container" style="display: none;">
            <div class="ss-backend-progress-bar-generic1">
                <img src="/<%- gSystemConfig.configDirectoryFilesLayoutSD %>/backend-layout-progress-bar-generic1.gif" alt="" />
            </div>
        </div>
    </body>
</html>