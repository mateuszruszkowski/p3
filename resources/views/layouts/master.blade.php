<!DOCTYPE html>
<html>
    <head>
      <title>@yield('title')</title>

      <!-- include global scripts -->

      <!-- jQuery -->
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

      <!-- Bootstrap -->
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
      <!-- Font -->
      <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
      <!-- Page styles -->
      <link href="{!! URL::asset('css/style.css'); !!}" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="content">
              Generate Paragraphs <a class="btn btn-info" href="/lorem-ipsum-generator/">HERE</a>
              Generate Users <a class="btn btn-info" href="/user-generator/">HERE</a>
              Generate Password <a class="btn btn-info" href="/password-generator">HERE</a>
            <br /><br />

            <h1>@yield('heading')</h1>
            <p>@yield('description')</p>

			      @yield('form')

            @yield('result')
            </div>
        </div>

        @yield('footer')
    </body>
</html>

