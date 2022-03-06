<!DOCTYPE html>
<html lang="{{__('cms.lang')}}">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="نظام طبي متعدد اللغات تحت التطوري في الوقت الحالي ، نظام طبي متكامل اطباء تقارير سجلات مرضى .">
		<meta name="Author" content="Ahmad Nahal">
		<meta name="Keywords" content="medical system,نظام طبي تجريبي,ahmad nahal"/>
		@include('layouts.head')
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.main-sidebar')
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.main-header')
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				@yield('content')
				@include('layouts.models')
            	@include('layouts.footer')
				@include('layouts.footer-scripts')
	</body>
</html>
