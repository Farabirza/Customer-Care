<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">

@if(isset($user))
<!-- meta properties -->
<meta name="title" content="{{$user->config->meta_title ?? 'cvkreatif.com'}}"/>
<meta name="description" content="{{$user->config->meta_description ?? 'Build your very own online portfolio for free!'}}"/>
<meta name="keywords" content="{{$user->config->meta_keywords ?? 'cvkreatif, cv kreatif, portofolio, portofolio online, curriculum vitae'}}"/>
<meta property="og:title" content="{{$user->config->meta_title ?? 'cvkreatif.com'}}"/>
<meta property="og:description" content="{{$user->config->meta_description ?? 'Build your very own online portfolio for free!'}}"/>
<meta property="og:site_name" content="cvkreatif.com"/>
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:image" content="{{ asset('img/covers/'.$user->profile->cover_image) ?? asset('img/materials/meta.jpg') }}"/>
<meta property="og:image:width" content="1366"/>
<meta property="og:image:height" content="768"/>
<meta property="og:type" content="portfolio"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@cvkreatif"/>
<meta name="twitter:creator" content="@cvkreatif"/>
<meta name="twitter:title" content="{{$user->config->meta_title ?? 'cvkreatif.com'}}"/>
<meta name="twitter:description" content="{{$user->config->meta_description ?? 'Build your very own online portfolio for free!'}}"/>
<meta name="twitter:image" content="{{ asset('img/covers/'.$user->profile->cover_image) ?? asset('img/materials/meta.jpg') }}"/>
<meta itemprop="likeCount" content="{{$user->like->count()}}"/>
<meta itemprop="commentCount" content="{{$user->comment->count()}}"/>

<!-- Favicons -->
<link href="{{ asset('/img/logo/logo.png') }}" rel="icon">
<link href="{{ asset('/img/logo/logo.png') }}" rel="apple-touch-icon">

<title>{{$user->config->meta_title ?? 'cvkreatif.com'}}</title>
@else
@include('layouts.partials.meta_tags')
@endif

  
@stack('css-styles')

<!-- Vendor CSS Files -->
<link href="{{ asset('/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/toastr/toastr.min.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ asset('/css/main.css') }}" rel="stylesheet">

<style>
@media (max-width: 768px) {
}

@media (max-width: 1199px) {
}
</style>
</head>
<body>

<!-- offcanvas -->
@if(isset($user))
@include('layouts.partials.sidebar_social')
@endif
  
<!-- ======= Main content ======= -->
<main id="main">
@yield('content')
</main>

<!-- Vendor JS Files -->
<script src="{{ asset('/vendor/axios/axios.js') }}"></script>
<script src="{{ asset('/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('/vendor/popper/popper.min.js') }}"></script>
<script src="{{ asset('/vendor/toastr/toastr.min.js') }}"></script>

<!-- Template Main JS File -->
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

@if(isset($_GET['success']))
    Swal.fire({
      icon: 'success',
      title: "{{$_GET['success']}}",
      showConfirmButton: false,
      timer: 3000
    });
@endif

function successMessage(message) { toastr.success(message, 'Success!'); } 
function infoMessage(message) { toastr.info(message, 'Info'); } 
function warningMessage(message) { toastr.error(message, 'Warning!'); } 
function errorMessage(message) { toastr.error(message, 'Error!'); } 
toastr.options.closeDuration = 900;
</script>

@stack('scripts')
</body>

</html>