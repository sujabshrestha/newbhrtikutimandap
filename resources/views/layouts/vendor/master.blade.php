<!DOCTYPE html lang>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ getOrginalUrl(returnSiteSetting('favicon')) }}" />

    <meta name="description" content="">
    <script>
        window.laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.vendor.style')
</head>

<body>


    <!-- sidenav overlay -->
    <div class="page-sidenav-overlay"></div>
    <!-- sidenav overlay -->
    <div class="page-wrapper">
        @include('layouts.vendor.header')

        @yield('content')
    </div>



   @include('layouts.vendor.script')

<script>
    setTimeout(function(){ $('.session-alert').hide(); }, 3000);
</script>

</body>



</html>
