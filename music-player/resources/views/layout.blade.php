<!--from https://getbootstrap.com/docs/5.3/getting-started/introduction/ -->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Custom Auth Laravel')</title>
    <link rel="stylesheet" href="{{ asset('css/basic_styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    @include('include.header')
    @yield('content')
    @include('include.footer')
  </head>
  </body>
</html>