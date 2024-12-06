<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>İzmir Web Tasarım ve Google SEO Ajansı | Foça GO Dijital</title>
  <meta name="description" content="GO Dijital İzmir Foça'da 360° hizmet veren genç ve dinamik bir web tasarım, reklam ve google seo ajansıdır. ">
  <meta name="author" content="GO Dijital">
  @include('frontend.layout.css')
  @yield('customCSS')

</head>

<body class=" text-[0.85rem]">
	<div class="grow shrink-0">
		@include('frontend.layout.header')
		@yield('content')
	</div>

	@include('frontend.layout.footer')

  	@include('frontend.layout.js')
    @yield('customJS')

</body>

</html>