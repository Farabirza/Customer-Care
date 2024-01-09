<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">

@if(isset($metaTags))
<meta name="title" content="{{$metaTags['title'] ?? 'cvkreatif.com'}}" />
<meta name="description" content="{{$metaTags['description'] ?? 'Build your own online portfolio for free!'}}" />
<meta name="keywords" lan="id" content="{{$metaTags['keywords'] ?? 'cvkreatif.com, portofolio online, cv kreatif, job hunting, website gratis'}}" />
<meta property="og:title" content="{{$metaTags['title'] ?? 'cvkreatif.com'}}" />
<meta property="og:type" content="website" />
<meta property="og:description" content="{{$metaTags['description'] ?? 'Build your own online portfolio for free!'}}" />
<meta property="og:site_name" content="cvkreatif.com"/>
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="www.cvkreatif.com" />
<meta property="og:image" content="{{ isset($metaTags['image']) ? asset('img/materials/'.$metaTags['image']) : asset('img/materials/landing.jpg') }}" />
<meta property="og:image:type" content="image/jpg" />
<meta property="og:image:width" content="1366" />
<meta property="og:image:height" content="768" />
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@cvkreatif"/>
<meta name="twitter:creator" content="@cvkreatif"/>
<meta name="twitter:title" content="{{$metaTags['title'] ?? 'cvkreatif.com'}}"/>
<meta name="twitter:image" content="{{ isset($metaTags['image']) ? asset('img/materials/'.$metaTags['image']) : asset('img/materials/landing.jpg') }}" />

<title>{{$metaTags['title'] ?? 'cvkreatif.com'}}</title>
@endif

<!-- Favicons -->
<link href="{{ asset('/img/logo/logo.png') }}" rel="icon">
<link href="{{ asset('/img/logo/logo.png') }}" rel="apple-touch-icon">

    
