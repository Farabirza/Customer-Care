<!-- Check login status -->
@auth
<?php header("Location: /home"); die(); ?>
@endauth

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="CVKreatif.com" />
<meta name="keywords" lan="en" content="blank, laravel, template" />
<meta property="og:type" content="website" />
<meta property="og:title" content="CVKreatif.com" />
<meta property="og:description" content="CVKreatif.com" />
<meta property="og:url" content="https://www.irzafarabi.com/" />
<meta property="og:site_name" content="www.irzafarabi.com" />
<meta property="og:image" content="{{ asset('img/bg/office-1.jpg') }}" />
<meta property="og:image:type" content="image/jpg" />
<meta property="og:image:width" content="1366" />
<meta property="og:image:height" content="768" />

<!-- Vendor JS Files -->
<script src="{{ asset('/vendor/jquery/jquery-3.6.0.min.js') }}"></script>

<!-- Favicons -->
<link href="{{ asset('/img/logo/logo.png') }}" rel="icon">
<link href="{{ asset('/img/logo/logo.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

<!-- Vendor CSS Files -->
<link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/toastr/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">

<title>Blank Laravel Template</title>

<style>
.section-title { font-family: 'Raleway',sans-serif; font-weight: bold; }
.title-dark { color: #124265; } .title-light { color: #f1f1f1; }

#section-hero { background: #f8e9a1; padding-top: 60px; padding-bottom: 60px; }
/* .hero-category-item img:hover { box-shadow: 2px 2px 10px #333; cursor: pointer; } */

@media (max-width: 768px) {
  #section-hero { padding-top: 20px; padding-bottom: 20px; }
  .hero-intro img { padding-bottom: 20px; }
  #section-topbar, .hero-category-row { display: none; }
}
</style>
</head>
<body>

@include('layouts/partials/topbar')

<!-- section-hero -->
<section id="section-hero">
    <div class="container">
        <div class="row align-items-center justify-content-center mb-4 hero-intro">
          <div class="col-md-4 text-end px-4">
            <img class="img-fluid" src="{{ asset('/img/materials/flaticon-desk-man-pc-shadow.png') }}" style="max-height: 480px"/>
          </div>
          <div class="col-md-4 px-4">
            <h1 class="fw-bold text-capitalize mb-4" style="color:#374785; font-size:36pt; lettter-spacing:2em">Buat halaman portofolio kamu di sini, gratis!</h1>
            @auth
            <a href="#" class="btn btn-outline-primary btn-modal-login px-4 rounded"><i class='bx bx-message-square-add me-1' ></i> Buat CV Baru</a>
            @else
            <a href="#" class="btn btn-outline-primary w-100 mb-2 btn-modal-login">Sign in</a>
            <p>Belum punya akun? <a href="#" class="text-primary btn-modal-register"><u>Sign up</u></a></p>
            @endauth
          </div>
        </div>
        <div class="row align-items-center justify-content-center hero-category-row">
          <div class="col-md-10">
            <h5 class="text-center fw-bold mb-3">Atau jelajahi CV orang lain berdasarkan :</h5>
            <div class="d-flex justify-content-center hero-category-container">
                <a href="#section-thumbnails"><div class="text-center me-5 hero-category-item">
                  <img class="img-fluid img-thumbnail rounded-circle mb-3" src="{{ asset('/img/materials/round-man-profession.png') }}" style="max-height: 150px" alt=""/>
                  <h5 class="mb-2">Profesi</h5>
                </div></a>
                <a href="#section-thumbnails"><div class="text-center me-5 hero-category-item">
                  <img class="img-fluid img-thumbnail rounded-circle mb-3" src="{{ asset('/img/materials/round-man-skill.png') }}" style="max-height: 150px" alt=""/>
                  <h5 class="mb-2">Keahlian</h5>
                </div></a>
                <a href="#section-thumbnails"><div class="text-center me-5 hero-category-item">
                  <img class="img-fluid img-thumbnail rounded-circle mb-3" src="{{ asset('/img/materials/round-man-interest.png') }}" style="max-height: 150px" alt=""/>
                  <h5 class="mb-2">Minat</h5>
                </div></a>
                <a href="#section-thumbnails"><div class="text-center me-5 hero-category-item">
                  <img class="img-fluid img-thumbnail rounded-circle mb-3" src="{{ asset('/img/materials/round-earth-location.png') }}" style="max-height: 150px" alt=""/>
                  <h5 class="mb-2">Domisili</h5>
                </div></a>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- section-hero end -->

@include('layouts/partials/navbar')

<div id="wrapper-content"> <!-- wrapper-content start -->

<!-- section-hero-2  -->
<section id="section-thumbnails" class="bg-light">
  <div class="container">
    <div class="row py-5 align-items-center justify-content-center">
      <div class="col-md-12"></div>
    </div>
  </div>
</section>
<!-- section-hero-2 end -->
<!-- section-hero-3  -->
<section class="bg-dark color-white">
  <div class="container">
    <div class="row vh-100 align-items-center justify-content-center">
      <h1 class="text-center">Hero 3</h1>
    </div>
  </div>
</section>
<!-- section-hero-3 end -->

</div> <!-- wrapper-content end -->

<!-- =========================================== modals =========================================== -->

<!-- =========================================== modals end =========================================== -->

</body>

<!-- Vendor JS Files -->
<script src="{{ asset('/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/vendor/scrollTo/jquery.scrollTo.js') }}"></script>
<script src="{{ asset('/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('/vendor/popper/popper.min.js') }}"></script>
<script src="{{ asset('/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('/vendor/aos/aos.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('/js/main.js') }}"></script>
<script src="{{ asset('/js/navbar.js') }}"></script>

<!-- Purecounter -->
<script src="{{ asset('/vendor/purecounter/purecounter.js') }}">
$(document).ready(function(){
    var purecounter = new PureCounter({
        selector: ".purecounter",
        duration: 2,
        delay: 10,
        once: true,
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  @if(session('success'))
    successMessage("{{ session('success') }}");
  @elseif(session('error'))
    errorMessage("{{ session('error') }}");
  @endif
  @if(isset($_GET['admin']) == 'false')
    Swal.fire({
      icon: 'error',
      title: "Access Denied!",
      text: "You are not an admin!",
      showConfirmButton: false,
      timer: 2000
    });
  @endif

  $('.btn-modal-login').click(function(e){
    e.preventDefault();
    $('.modal').modal('hide');
    $('#modal-login').modal('show');
  })
  $('.btn-modal-register').click(function(e){
    e.preventDefault();
    $('.modal').modal('hide');
    $('#modal-register').modal('show');
  })

  $('.hero-category-item').hover(function(){
    $('img', this).css('box-shadow', '2px 2px 10px #333'); $('h5', this).css({'font-weight': "bolder", "color": "#374785"});
  }, function(){
    $('img', this).css('box-shadow', 'none'); $('h5', this).css({'font-weight': "", "color": "#202020"});
  });

  /* Scroll function */
	$(document).scroll(function() {
		var y = $(this).scrollTop(); 
		var navbar_offset = $('#section-navbar').offset().top; 
		var section_hero = $('#section-hero').outerHeight(); 
    var p = $('#section-hero').outerHeight();
    if (y >= navbar_offset) { 
      $('#section-navbar').addClass('fixed-top').css('box-shadow', '0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2)');
      $('#wrapper-content').css('padding-top', $('#navbar').outerHeight());
    } if (y <= section_hero) { 
			$('#section-navbar').removeClass('fixed-top').css('box-shadow', 'none');
      $('#wrapper-content').css('padding-top', 0);
		}
	});
  /* Scroll function end */
  
});
  function successMessage(message) {
      toastr.success(message, 'Success!');
  } 
  function infoMessage(message) {
      toastr.info(message, 'Info');
  } 
  function warningMessage(message) {
      toastr.error(message, 'Warning!');
  } 
  function errorMessage(message) {
      toastr.error(message, 'Error!');
  } 
</script>
</html>