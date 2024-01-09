<!DOCTYPE html>
<html lang="en">

<head>

<!-- Vendor JS Files -->
<script src="{{ asset('/vendor/jquery/jquery-3.6.0.min.js') }}"></script>

<!-- Vendor CSS Files -->
<link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/toastr/toastr.min.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ asset('/css/main.css') }}" rel="stylesheet">

@stack('css-styles')
<style>
body { background: #f4f6f9; }
.box { 
    background: #fff;
    padding: 1rem .75rem;
    border-radius: .5rem !important;
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
 }
</style>

<title>{{ $title ?? 'Customer Care' }}</title>

</head>
<body>

<!-- sidebar start -->
<header>
@include('layouts.partials.sidebar')
</header>
<!-- sidebar end -->

<!-- ======= Main content ======= -->
<main id="main" class="py-4">
@yield('content')
</main>
<!-- ======= Main content end ======= -->

<!-- Vendor JS Files -->
<script src="{{ asset('/vendor/axios/axios.js') }}"></script>
<script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/vendor/toastr/toastr.min.js') }}"></script>

<!-- JS Files -->
<script src="{{ asset('/js/main.js') }}?v=1"></script>

<script type="text/javascript">
$(document).ready(function() {
  @if(session('success'))
    successMessage("{{ session('success') }}");
  @elseif(session('error'))
    errorMessage("{{ session('error') }}");
  @elseif(session('info'))
    infoMessage("{{ session('info') }}");
  @endif    
});

function successMessage(message) { toastr.success(message, 'Success!'); } 
function infoMessage(message) { toastr.info(message, 'Info'); } 
function warningMessage(message) { toastr.error(message, 'Warning!'); } 
function errorMessage(message) { toastr.error(message, 'Error!'); } 
</script>

@stack('scripts')
</body>

</html>