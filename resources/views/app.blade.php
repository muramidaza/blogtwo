<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<title>Laravel Blog Demo</title>
		<!-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> -->
		<!-- Fonts -->
		<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/css/bootstrap.min.css">

	</head>
	<body>
		
		<nav class="navbar navbar-default navbar-static">
			<div class="container-fluid">
				<!-- Заголовок -->
				<div class="navbar-header">
					<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="navbar-main">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#" style="padding:15px 15px;">Название проекта</a>
				</div>
				
				<!-- Основная часть меню (может содержать ссылки, формы и другие элементы) -->
				<div class="collapse navbar-collapse" id="navbar-main">
					<!-- Содержимое основной части -->

					<ul class="nav navbar-nav">
						<li><a href="{{ url('/') }}">Главная</a></li>
						<li class="dropdown">
							<a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown">
								Меню
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Текст подпункта</a></li>
								<li><a href="#">Текст подпункта</a></li>
								<li class="divider"></li>
								<li><a href="#">Текст подпункта</a></li>
							</ul>
						</li>
					</ul>

					<!-- Блок, расположенный справа -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Выпадающий список -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Раздел</a>
							<ul class="dropdown-menu">

								@if (Auth::guest())
								<li>
									<a href="{{ route('login') }}">Логин</a>
								</li>
								<li>
									<a href="{{ route('register') }}">Регистрация</a>
								</li>
								@else
								
								@if (Auth::user()->can_post())
								<li>
									<a href="{{ url('/new-post') }}">Добавить пост</a>
								</li>
								<li>
									<a href="{{ url('/user/'.Auth::id().'/posts') }}">Мои посты</a>
								</li>
								<li>
									<a href="{{ url('/contragent/list') }}">Контрагенты</a>
								</li>
								@endif
								
								<li>
									<a href="{{ url('/user/'.Auth::id()) }}">Мой профиль</a>
								</li>
								<li>
									<a href="{{ url('/auth/logout') }}">Выйти</a>
								</li>

								@endif							
							
							</ul>
						</li>
					</ul>

				</div>
			</div>
		</nav>
		
		<div class="container">
			@if (Session::has('message'))
			<div class="flash alert-info">
				<p class="panel-body">
					{{ Session::get('message') }}
				</p>
			</div>
			@endif
			@if ($errors->any())
			<div class='flash alert-danger'>
				<ul class="panel-body">
					@foreach ( $errors->all() as $error )
					<li>
						{{ $error }}
					</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2>@yield('title')</h2>
							@yield('title-meta')
						</div>
						<div class="panel-body">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<p>Copyright © 2015 | <a href="http://muramidaza.ru">by Muramidaza</a></p>
				</div>
			</div>
		</div>
		
		<!-- Scripts -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
	</body>
</html>