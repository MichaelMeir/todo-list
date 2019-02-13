<!DOCTYPE html>
<html>
<head>
    <title>Todo list</title>
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/app.css')) }}">
    <meta name="csrf-token" value="{{ csrf_token() }}">
</head>
<body class="font-sans bg-grey middle">
    <div id="app" class="container max-w-sm mx-auto bg-beige mt-4 rounded-sm p-3 text-black border-2 border-brown text-center">
    	<keep-alive>
    		<list-component :list="{{ $list }}"></list-component>
    	</keep-alive>
    </div>
    <script type="text/javascript" src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>