<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <style media="screen">
            body {
                padding-top: 70px;
            }
        </style>
    </head>
    <body class="container">

        @include('_navbar')

        @yield('body', '')

        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>

        <script type="text/javascript">
            $(function () {
                new ScrollMagic.Scene({
                    offset: 70,
                    triggerHook: 'onEnter'
                })
                .setPin('#sub-navigations')
                .addTo(new ScrollMagic.Controller());
            });
        </script>

        @yield('scripts')
    </body>
</html>
