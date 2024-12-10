<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
  {!! Twitter::generate() !!}
  {!! JsonLd::generate() !!} 
  <meta name="author" content="GO Dijital">

  @include('frontend.layout.css')
  @yield('customCSS')

</head>

<body class=" text-[0.85rem]">
  <div class="page-loader"></div>

	<div class="grow shrink-0">

		@include('frontend.layout.header')
		@yield('content')
	</div>

	@include('frontend.layout.footer')

  	@include('frontend.layout.js')
    @yield('customJS')

</body>

</html>