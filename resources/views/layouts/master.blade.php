<html>
<head>
    <title>My Site 1 @yield('title', 'Home Page1')</title>
</head>
<body>
<div class="container">
    @yield('content')
</div>
@section('footerScripts')
    <script src="1.js"></script>
@show
</body>
</html>
