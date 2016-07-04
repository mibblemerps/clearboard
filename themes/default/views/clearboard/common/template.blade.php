<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('clearboard.sitename') }} - @yield('title')</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/main.css') }}">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.12.0/axios.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
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

        <div class="modal fade" id="modal-generic" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Hello world!</h4>
                    </div>
                    <div class="modal-body">
                        <p class="modal-message">
                            Stuff! Hello world! yey
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
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