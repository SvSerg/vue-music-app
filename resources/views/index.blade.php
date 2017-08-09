<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.min.js" />
  <link rel="stylesheet" href="/css/app.css" />
  <title>bassfunk</title>
</head>
<body>
	<div id="app">
		<!-- player -->
		<vue-player :items="this.$root.streamItems"></vue-player>
		<v-loading v-show="this.$root.loading"></v-loading>
		<div class="container main-container">
			<!-- header -->
			<div class="col-md-12">
				<div class="logo">
					<span>bass<i>funk</i></span>
				</div>
			</div>
			<!-- menu -->
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><router-link to="/">Home</router-link></li>
					<li><router-link to="/photogalery">Photogalery</router-link></li>
					<li><router-link to="/feedback">Feedback</router-link></li>
					<li><router-link to="/about">About us</router-link></li>
				</ol>
			</div>
			
			<!-- stream  -->
			<div class="col-md-8">
				<hr />			
				<router-view></router-view>
			</div>
			<div class="col-md-4">
				<!-- info  -->
				<div class="info">
					<span class="info-title">
						<span>bass<i>funk</i></span>
					</span>
					<div class="info-body">
						&mdash; is a <span class="a">global community</span> where millions of fans discover new music, and directly connect with and fairly compensate the artists who make it.
					</div>
				</div>
				<!-- search -->
				<v-search></v-search>
			</div>
			<!-- menu -->

			<!-- footer  -->
			<div class="col-md-12">
				<div class="footer">
				</div>
			</div>
		</div>
	</div>
  <script type="text/javascript">
    var Laravel = {
			 csrfToken: '{{ csrf_token() }}',
			 user: {!! Auth::guest() ? 'false' : Auth::user() !!}
    };
  </script>
	<script src="/js/app.js" charset="utf-8"></script>
</body>
</html>