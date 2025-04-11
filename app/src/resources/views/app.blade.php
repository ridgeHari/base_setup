<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-loading-overlay/2.1.7/loadingoverlay.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3.6.0/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3.6.0/notyf.min.js"></script>

    @routes
    @vite(['resources/js/app.js', "resources/js/pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

<script>
    const notyf = new Notyf({
        position: { x: 'right', y: 'top' },
        duration: 3000,
        ripple: true,
    });

    const showLoading = () => $.LoadingOverlay("show", {
        fade: [0, 800],
    });
    const hideLoading = () => $.LoadingOverlay("hide");

    window.addEventListener('beforeunload', showLoading);
    window.addEventListener('pageshow', hideLoading);

    document.addEventListener("DOMContentLoaded", function () {
        if (window.axios) {
            window.axios.interceptors.request.use(config => (showLoading(), config), error => (hideLoading(), Promise.reject(error)));
            window.axios.interceptors.response.use(response => (hideLoading(), response), error => (hideLoading(), Promise.reject(error)));
        }
    });
</script>

</html>