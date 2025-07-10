<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="bg-bg min-h-screen min-w-full flex flex-col items-center justify-center p-4">
    <div class="bg-bg-light p-4 sm:p-8 md:p-16 rounded-tl-4xl rounded-br-4xl max-w-[980px]">
        {{ $slot }}
    </div>
    @fluxScripts
</body>
</html>