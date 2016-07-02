<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('clearboard.sitename') }} - @yield('title')</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/main.css') }}">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
        <script src="{{ theme_asset('js/main.js') }}"></script>

        <script type="text/javascript">
            window.clearboard = {
                basePath: "{{ url('') }}",
                isLoggedIn: {{ Auth::check() ? 'true' : 'false' }},
                csrfToken: "{{ csrf_token() }}"
            };
        </script>

        @yield('head')
    </head>
    <body>
        <div id="cover"></div>

        <div class="promptbox" id="promptbox">
            <div class="promptbox-header">Prompt Header</div>
            <p class="promptbox-message">Prompt Body</p>
            <div class="promptbox-buttons"></div>
        </div>

        @include('clearboard.common.header')

        <div id="wrapper" class="container">
            @yield('content')
        </div>
        @include('clearboard.common.footer')

        <!-- Low priority assets -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300|Open+Sans:400,700|Lato">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ theme_asset('libs/load-awesome/css/ball-scale-pulse.min.css') }}">
    </body>
</html>