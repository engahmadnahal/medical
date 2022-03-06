<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="Description" content="نظام طبي متعدد اللغات تحت التطوري في الوقت الحالي ، نظام طبي متكامل اطباء تقارير سجلات مرضى .">
		<meta name="Author" content="Ahmad Nahal">
		<meta name="Keywords" content="medical system,نظام طبي تجريبي,ahmad nahal"/>
		@include('layouts.head')
	</head>

	<body class="main-body bg-primary-transparent">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@yield('content')
		@include('layouts.footer-scripts')
	</body>
</html>
