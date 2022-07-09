{{-- TODO: include debug / production flag --}}
<script src="{{ asset('/' . $GLOBALS['configDirectoryJSSD'] . '/functions-syncsystem.js') }}" type="text/javascript"></script>

{{-- GLightbox. --}}
{{-- ************************************************************************************** --}}
@if ($GLOBALS['configImagePopup'] === 4)
    {{-- 
        ref: https://biati-digital.github.io/glightbox/
        ref: https://github.com/biati-digital/glightbox/blob/master/README.md
    --}}

    <script src="{{ asset('/' . $GLOBALS['configDirectoryJSSD'] . '/glightbox/dist/js/glightbox.min.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/' . $GLOBALS['configDirectoryJSSD'] . '/glightbox/dist/css/glightbox.min.css') }}" media="screen" title="Default" />

    <script>
        // JGLightbox configuration.
        //var lightbox = GLightbox();
        let gLightboxBackendConfigOptions = {};

        // Backend options
        gLightboxBackendConfigOptions.autoplayVideos = true;
        gLightboxBackendConfigOptions.openEffect = 'fade'; // zoom, fade, none
        gLightboxBackendConfigOptions.slideEffect = 'slide'; // slide, fade, zoom, none
        gLightboxBackendConfigOptions.moreText = '+'; // more text for descriptions on mobile devices
        gLightboxBackendConfigOptions.touchNavigation = true;
        gLightboxBackendConfigOptions.descPosition = 'bottom'; // global position for slides description, you can define a specific position on each slide (bottom, top, left, right)
    </script>
@endif
{{-- ************************************************************************************** --}}

{{-- JS Datepicker. --}}
{{-- ************************************************************************************** --}}
{{-- 
    ref: https://www.npmjs.com/package/js-datepicker
    TODO: Condition (config-application) to import library.
    Research: make it work with webpack (importing in the node code).
--}}
{{-- @if ($GLOBALS['configDebug'] === true) --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/' . $GLOBALS['configDirectoryJSSD'] . '/js-datepicker/datepicker.min.css') }}" media="screen" title="Default" /><!--move to webpack (dist)-->

    <!--script src="/node_modules/js-datepicker/dist/datepicker.min.js" type="text/javascript"></script-->
    <script src="{{ asset('/' . $GLOBALS['configDirectoryJSSD'] . '/js-datepicker/datepicker.min.js') }}" type="text/javascript"></script>
{{-- @endif --}}

<script>
    // JS Datepicker configuration.
    let jsDatepickerBaseBackendConfigOptions = {};
    let jsDatepickerGenericBackendConfigOptions = {};
    let jsDatepickerBirthBackendConfigOptions = {};
    let jsDatepickerTaskBackendConfigOptions = {};
    let jsDatepickerHistoryBackendConfigOptions = {};


    // Base options (en-US).
    jsDatepickerBaseBackendConfigOptions = {
        formatter: (input, date, instance) => {
            const value = date.toLocaleDateString('en-US'); // ref: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date/toLocaleDateString
            input.value = value; // => '1/15/2099';
        },
        customDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        customMonths: ['January', 'Fabruary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        overlayButton: 'Done',
        overlayPlaceholder: '4-digit year',
        position: 'bl', // 'tr', 'tl', 'br', 'bl', 'c'
        respectDisabledReadOnly: true
    };
</script>
{{-- Base options (pt-BR). --}}
@if ($GLOBALS['configBackendDateFormat'] === 1)
    <script>
        jsDatepickerBaseBackendConfigOptions = {
            formatter: (input, date, instance) => {
                const value = date.toLocaleDateString('pt-BR');
                input.value = value; // => '15/1/2099';
            },
            //dateSelected: new Date(2099, 0, 5),
            //maxDate: new Date(2099, 0, 1),
            //minDate: new Date(2018, 0, 1),
            //startDate: new Date(2099, 0, 1), // The date you provide will determine the month that the calendar starts off at.
            //noWeekends: true,
            customDays: ['Dom', 'Seg', 'Ter', 'Qua', 'qui', 'Sex', 'Sáb'],
            customMonths: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            overlayButton: 'Pronto',
            overlayPlaceholder: 'ano 4-dígito', 
            position: 'bl', //'tr', 'tl', 'br', 'bl', 'c'
            respectDisabledReadOnly: true
            };
    </script>
@endif
<script>

    // Generic options.
    //jsDatepickerGenericBackendConfigOptions = jsDatepickerBaseBackendConfigOptions; //error - it assumes as the same instance and incorporates all properties to the base congig options (problem passing objects by reference)
    Object.assign(jsDatepickerGenericBackendConfigOptions, jsDatepickerBaseBackendConfigOptions); // working
    jsDatepickerGenericBackendConfigOptions.showAllDates = true; // Show dates outside the month.


    // Birth date options.
    //jsDatepickerBirthBackendConfigOptions = jsDatepickerBaseBackendConfigOptions;
    Object.assign(jsDatepickerBirthBackendConfigOptions, jsDatepickerBaseBackendConfigOptions); // working
    //jsDatepickerBirthBackendConfigOptions.dateSelected = new Date(2002, 0, 1); // 18 years
    jsDatepickerBirthBackendConfigOptions.minDate = new Date(1900, 0, 1);
    jsDatepickerBirthBackendConfigOptions.maxDate = new Date();
    jsDatepickerBirthBackendConfigOptions.showAllDates = true; // Show dates outside the month.


    // Task date options.
    //jsDatepickerTaskBackendConfigOptions = jsDatepickerBaseBackendConfigOptions;
    Object.assign(jsDatepickerTaskBackendConfigOptions, jsDatepickerBaseBackendConfigOptions); // working
    jsDatepickerTaskBackendConfigOptions.minDate = new Date();
    jsDatepickerTaskBackendConfigOptions.showAllDates = true; // Show dates outside the month.


    // History date options.
    //jsDatepickerHistoryBackendConfigOptions = jsDatepickerBaseBackendConfigOptions;
    Object.assign(jsDatepickerHistoryBackendConfigOptions, jsDatepickerBaseBackendConfigOptions); // working
    jsDatepickerHistoryBackendConfigOptions.maxDate = new Date();
    jsDatepickerHistoryBackendConfigOptions.showAllDates = true; // Show dates outside the month.
</script>
{{-- ************************************************************************************** --}}

{{-- Inputmask. --}}
{{-- ************************************************************************************** --}}
{{--
    ref: https://github.com/RobinHerbots/Inputmask
    ref: https://github.com/nosir/cleave.js/blob/master/doc/options.md
    ref: https://www.jqueryscript.net/form/Easy-jQuery-Input-Mask-Plugin-inputmask.html
--}}

{{-- @if ($GLOBALS['configDebug'] === true) --}}
    <script src="{{ asset('/' . $GLOBALS['configDirectoryJSSD'] . '/inputmask5/inputmask.min.js') }}" type="text/javascript"></script>
{{-- @endif --}}

<script>
    // Inputmask configuration.
    let inputmaskCurrencyBackendConfigOptions = {};
    let inputmaskGenericBackendConfigOptions = {};
    let inputmaskDecimalBackendConfigOptions = {};
    

    // Generic options.
    // ----------------------
    inputmaskGenericBackendConfigOptions.greedy = false;
    inputmaskGenericBackendConfigOptions.alias = 'numeric'; // numeric | currency | decimal
    inputmaskGenericBackendConfigOptions.digits = 0;
    inputmaskGenericBackendConfigOptions.autoGroup = false;
    inputmaskGenericBackendConfigOptions.digitsOptional = false;
    inputmaskGenericBackendConfigOptions.allowMinus = true;
    // ----------------------


    // Currency options.
    // ----------------------
    inputmaskCurrencyBackendConfigOptions.greedy = false;
    inputmaskCurrencyBackendConfigOptions.alias = 'numeric'; // numeric | currency | decimal
    inputmaskCurrencyBackendConfigOptions.digits = 2;
    inputmaskCurrencyBackendConfigOptions.autoGroup = true;
    inputmaskCurrencyBackendConfigOptions.digitsOptional = false;
    inputmaskCurrencyBackendConfigOptions.allowMinus = false;
</script>

{{-- R$ --}}
@if ($GLOBALS['configSystemCurrency'] === 'R$')
    <script>
        inputmaskCurrencyBackendConfigOptions.groupSeparator = '.';
        inputmaskCurrencyBackendConfigOptions.radixPoint = ',';
    </script>
@endif

{{-- $ --}}
@if ($GLOBALS['configSystemCurrency'] === '$')
    <script>
        inputmaskCurrencyBackendConfigOptions.groupSeparator = ',';
        inputmaskCurrencyBackendConfigOptions.radixPoint = '.';
    </script>
@endif

<script>
    /*
    {
        //mask: "9[.99]{0,}",
        //mask: "9[.99]",
        //repeat: *,
        greedy: false,
        //numericInput: true

        //R$
        groupSeparator: ".",
        radixPoint: ",",

        //$
        //groupSeparator: ",",
        //radixPoint: ".",

        alias: "numeric",
        //alias: "currency",
        //alias: "decimal",
        digits: 2,
        autoGroup: true,
        digitsOptional: false,
        allowMinus: false
    }
    */
    // ----------------------


    // Decimal options.
    // ----------------------
    inputmaskDecimalBackendConfigOptions.greedy = false;
    inputmaskDecimalBackendConfigOptions.alias = 'numeric'; // numeric | currency | decimal
    //inputmaskDecimalBackendConfigOptions.digits = 0;
    inputmaskDecimalBackendConfigOptions.autoGroup = false;
    inputmaskDecimalBackendConfigOptions.digitsOptional = true;
    inputmaskDecimalBackendConfigOptions.allowMinus = true;
    inputmaskDecimalBackendConfigOptions.groupSeparator = ',';
    inputmaskDecimalBackendConfigOptions.radixPoint = '.';
    // ----------------------
</script>
{{-- ************************************************************************************** --}}

{{-- TinyMCE. --}}
{{-- ************************************************************************************** --}}
@if ($GLOBALS['configBackendTextBox'] === 17 || $GLOBALS['configBackendTextBox'] === 18)
    {{--
        ref: https://www.tiny.cloud/docs/quick-start/
        TODO: Translate controls.
        Toolbar controls: https://www.tiny.cloud/docs/advanced/editor-control-identifiers/#toolbarcontrols
    --}}
    <script src="{{ asset('/' . $GLOBALS['configDirectoryJSSD'] . '/tiny-mce-5/tinymce.min.js') }}" type="text/javascript"></script>
    
    <script>
        // TinyMCE configuration.
        let tinyMCEBackendConfig = {
            min_height: 300,
            resize: false,
            statusbar: true,
            skin: 'small',
            icons: 'small',
            branding: false,

            // Filters.
            allow_html_in_named_anchor: true,
            convert_fonts_to_spans: true,
            //invalid_elements: '', //tags (ex: 'strong,em')
            //nvalid_styles: '', //ex: color font-size
            /*valid_styles: {
                '*': 'border,font-size',
                'div': 'width,height'
            },*/
            /*protect: [
                /\<\/?(if|endif)\>/g,  // Protect <if> & </endif>
                /\<xsl\:[^>]+\>/g,  // Protect <xsl:...>
                /<\?php.*?\?>/g  // Protect php code
            ],*/ /*error - maybe because of the special rendering in literal templates*/
            
            element_format : 'xhtml', //html (<br>) | xhtml (<br />)
            schema: 'html5',
            forced_root_block : '',

            /*formats: {
                // A custom format that wraps blocks into a div with the specified wrapper class
                'custom-wrapper': { block: 'div', classes: 'wrapper', wrapper: true }
            },*/
            
            // Basic.
            //<% if (gSystemConfig.configBackendTextBox === 17) { %>
            //TODO: move outside of this block and add to object
                toolbar: 'bold italic underline nonbreaking | bullist numlist | link unlink | copy cut paste pastetext | visualaid code',
                menubar: false,
            //<% } %>

            // Advanced.
            /*
            <% if (gSystemConfig.configBackendTextBox === 18) { %>
                toolbar: 'bold italic underline nonbreaking | bullist numlist | undo redo | formatselect removeformat styleselect | link unlink | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect | strikethrough subscript superscript | copy cut paste selectall pastetext | backcolor forecolor | outdent indent | blockquote | emoticons hr image media | table tabledelete | visualaid code',
                menubar: 'file edit insert view format table tools help',
                menu: {
                    //file: { title: 'File', items: 'newdocument restoredraft | preview | print' },
                    file: { title: 'File', items: 'print' },
                    edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
                    view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
                    insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc' },
                    format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat' },
                    tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
                    table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' }
                    //help: { title: 'Help', items: 'help' }
                },
                font_formats: 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n',
            <% } %>
            */

            //Research name changing.  
            plugins: 'advlist paste link image media lists table code emoticons nonbreaking'
        }
    </script>

    {{-- HERE --}}
@endif
{{-- ************************************************************************************** --}}
