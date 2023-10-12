<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>{{ env('APP_NAME') }} - Dashboard Insumar</title>
  <!-- loader-->
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}" rel="stylesheet"/>

  <!-- simplebar CSS -->
  <link href="{{ asset('assets/dashboard/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>

  <!-- animate CSS -->
  <link href="{{ asset('assets/dashboard/css/animate.css') }}" rel="stylesheet" type="text/css"/>

  <!-- Icons CSS -->
  <link href="{{ asset('assets/dashboard/css/icons.css') }}" rel="stylesheet" type="text/css"/>

  <!-- Sidebar CSS -->
  <link href="{{ asset('assets/dashboard/css/sidebar-menu.css') }}" rel="stylesheet"/>

  <!-- Custom Style -->
  <link href="{{ asset('assets/dashboard/css/app-style.css') }}" rel="stylesheet"/>

  @vite('resources/js/app.js')
  
</head>

<body class="bg-theme bg-theme11">
 
    <div id="app2"></div>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>

<!-- simplebar js -->
<script src="{{ asset('assets/dashboard/plugins/simplebar/js/simplebar.js') }}"></script>

<!-- sidebar-menu js -->
<script src="{{ asset('assets/dashboard/js/sidebar-menu.js') }}"></script>

<!-- loader scripts -->
<script src="{{ asset('assets/dashboard/js/jquery.loading-indicator.js') }}"></script>

<!-- Custom scripts -->
<script src="{{ asset('assets/dashboard/js/app-script.js') }}"></script>

<!-- Chart.js -->
<script src="{{ asset('assets/dashboard/plugins/Chart.js/Chart.min.js') }}"></script>

<!-- Index.js -->
<script src="{{ asset('assets/dashboard/js/index.js') }}"></script>
  
</body>
</html>
