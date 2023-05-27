{{-- Bootstrap 4 CSS. --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
<!--link rel="stylesheet" type="text/css" href="../app_js/bootstrap/bootstrap-3.3.6-dist/css/bootstrap.min.css" media="screen" title="Default" /-->

{{-- Style Sheets - personalized. http://localhost:8000 | ../../ --}}
<link rel="stylesheet" type="text/css" href="{{ asset(config('app.gSystemConfig.configDirectoryStylesSD') . '/' . 'styles-frontend.bundle.css') }}/styles-frontend.bundle.css" media="screen" title="Default" />
{{-- <link rel="stylesheet" type="text/css" href="/styles-frontend.bundle.css" media="screen and (min-width: 991px)" title="Default" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="/styles-frontend-mobile.bundle.css" media="screen and (max-width: 991px)" title="Default" /> --}}

{{-- Font Awesome. --}}
<link rel="stylesheet" href="{{ asset(config('app.gSystemConfig.configDirectoryStylesSD') . '/' . 'fontawesome-free-5.15.4-web/css/all.css" />
