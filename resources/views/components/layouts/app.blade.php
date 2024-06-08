<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:site_name" content="{{ config('site.name', 'App Name') }}" />
  <meta property="og:url" content="{{ url()->current() }}" />
  <meta name="url" content="{{ url()->current() }}" />
  <meta name="identifier-URL" content="{{ url()->current() }}" />
  <meta name="copyright" content="{{ config('site.name') }}" />
  <meta name="owner" content="{{ config('site.name') }}" />
  <meta name="og:site_name" content="{{ config('site.name') }}" />
  <meta name="application-name" content="{{ Str::slug(config('site.name')) }}" />
  <meta name="og:email" content="{{ config('site.email.general') }}" />
  <meta name="target" content="all" />
  <meta name="HandheldFriendly" content="True" />
  <meta name="MobileOptimized" content="320" />
  <meta name="coverage" content="Brazil" />
  <meta name="distribution" content="Brazil" />
  <meta name="og:country-name" content="Brazil" />
  <meta name="language" content="pt-BR" />

  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
    rel="stylesheet"
  />

  {{-- Scripts --}}

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @stack('head')
</head>

<body>
  @stack('body-start')

  {{-- <x-svgs />
  <x-header /> --}}

  @yield('content')

  {{-- <x-footer /> --}}

  @stack('scripts')
</body>

</html>
