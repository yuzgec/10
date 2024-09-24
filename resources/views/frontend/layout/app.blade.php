<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>İzmir Web Tasarım Ajansı | Foça GO Dijital</title>
  <meta name="description" content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website.">
  <meta name="author" content="GO Dijital">
  @include('frontend.layout.css')

</head>

<body class=" text-[0.85rem]">
	<div class="grow shrink-0">
		@include('frontend.layout.header')
		@yield('content')
	</div>

	@include('frontend.layout.footer')

  	@include('frontend.layout.js')
</body>

</html>