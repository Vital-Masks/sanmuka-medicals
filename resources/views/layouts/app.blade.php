<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="img/Fevicon.png" type="image/png">

    <link rel="stylesheet" href="{{ URL::asset('vendors/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/nice-select/nice-select.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/nice-select/nice-select.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/mystyle.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/checkout.scss') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false
            }
        }
    </script>

</head>

<body>
    <div class="body">

        @include('shared.navbar')


        <div class="content">
            @yield('content')
        </div>


        @include('shared.footer')

    </div>

    @yield('extra-js')

    <script src="{{ URL::asset('vendors/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/skrollr.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/nice-select/jquery.nice-select.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/mail-script.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script src="{{ URL::asset('js/myscript.js') }}"></script>
</body>

</html>