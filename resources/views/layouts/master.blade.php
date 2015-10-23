<!DOCTYPE html>
<html>
    <head>
    	<title>@yield('title')</title>

    	<!-- include global scripts -->
  		@include('layouts.head')

  		<!-- include custom scripts -->
  		@yield('customHead')

    </head>
    <body>
        <div class="container">
            <div class="content">

			      @yield('content')

            </div>
        </div>
    </body>
</html>

