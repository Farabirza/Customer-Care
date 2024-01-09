<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>Warehouse {{(isset($title) ? '| '.$title : '')}}</title>
@stack('css-styles')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <!-- content start -->
        @yield('content')
        <!-- content end -->
    </div>
</div>
@stack('scripts')
</body>
</html>
