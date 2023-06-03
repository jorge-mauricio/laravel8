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
<meta name="language" content="english" />

<meta name="author" content="<?php echo \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application'); ?>" />
<meta name="designer" content="<?php echo \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'layoutDevName'); ?>" />
<meta name="copyright" content="<?php echo config('app.gSystemConfig.configCopyrightYear'); ?>, <?php echo \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application'); ?>" />
<meta name="rating" content="general" />{{-- general | mature | restricted | 14 years --}}
