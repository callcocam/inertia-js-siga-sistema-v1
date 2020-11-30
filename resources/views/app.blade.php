<!DOCTYPE html>
<html class="h-full bg-gray-200">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="{{ mix('/_dist/_admin_/css/app.css') }}" rel="stylesheet">

    {{-- Inertia --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=smoothscroll,NodeList.prototype.forEach,Promise,Object.values,Object.assign" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    {{-- Ping CRM --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=String.prototype.startsWith" defer></script>
    <script src="https://cdn.rawgit.com/cretueusebiu/412715093d6e8980e7b176e9de663d97/raw/aea128d8d15d5f9f2d87892fb7d18b5f6953e952/objectToFormData.js"></script>

    <script src="{{ mix('/_dist/_admin_/js/app.js') }}" defer></script>
    @routes
</head>
<body class="font-sans leading-none text-gray-700 antialiased">

@inertia

</body>
</html>
