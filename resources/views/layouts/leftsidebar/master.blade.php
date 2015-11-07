<!DOCTYPE html>
<html>
    <head>
      <title>@yield('title')</title>

      <!-- include global scripts -->

      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <!-- Sandstone theme from https://www.bootstrapcdn.com/bootswatch/ -->
      <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha256-gJ9rCvTS5xodBImuaUYf1WfbdDKq54HCPz9wk8spvGs= sha512-weqt+X3kGDDAW9V32W7bWc6aSNCMGNQsdOpfJJz/qD/Yhp+kNeR+YyvvWojJ+afETB31L0C4eO0pcygxfTgjgw==" crossorigin="anonymous">
      <!-- Page styles -->
      <link href="{!! URL::asset('css/style.css'); !!}" rel="stylesheet" type="text/css">

      <!-- end of global scripts -->
    </head>
    <body>
        <div class="container">

        <!-- navbar form bootstrap page -->
        <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="http://p3.mruszkowski.me">Developer's Best Friend </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="http://p1.mruszkowski.me">P1 - Portfolio</a></li>
                <li><a href="http://p2.mruszkowski.me">P2 - xkcd Password Generator</a></li>
                <li class="active"><a href="http://p3.mruszkowski.me">P3 <span class="label label-success">current</span></a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">P4 <span class="label label-info">Comming soon</span></a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
      </nav>

          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 nav-content">
                  <div class="list-group table-of-contents">
                    <a class="list-group-item" href="/">
                      <h4 class="list-group-item-heading">Home page</h4>
                      <p class="list-group-item-text">With description of a project</p>
                    </a>
                    <a class="list-group-item" href="/lorem-ipsum-generator/">
                      <h4 class="list-group-item-heading">Generate Paragraphs</h4>
                      <p class="list-group-item-text">That you will never remember</p>
                    </a>
                    <a class="list-group-item" href="/user-generator/">
                      <h4 class="list-group-item-heading">Generate Users</h4>
                      <p class="list-group-item-text">Whom you will never known</p>
                    </a>
                    <a class="list-group-item" href="/password-generator">
                      <h4 class="list-group-item-heading">Generate Password</h4>
                      <p class="list-group-item-text">That can be unbreakable</p>
                    </a>

                  </div>
            </div>

            <div class="col-md-9">
              <div class="page-header">
                <h1>@yield('heading')</h1>
              </div>
              <p class="lead">
                @yield('description')
              </p>

			      @yield('form')

            @yield('result')
            </div>
          </div>
        </div>


        <!-- jQuery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!-- Custom JS-->
        <footer>
          @yield('footer')
        </footer>
    </body>
</html>

