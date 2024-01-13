<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $event->name }} – {{ $org->name }} – {{ env('APP_NAME') }}</title>
    <link href="{{ asset('page/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('page/css/scrolling-nav.css') }}" rel="stylesheet">

    <style type="text/css">
        .background {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-image: url('{{ $event->image }}');
            padding: 10em 0;
        }
        label {
          font-weight: bold;
        }
        .list-group {
          margin-bottom: 1em;
        }
    </style>

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-{{ $event->color }} fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/">{{ env('APP_NAME') }}</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">{{ $event->name }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#register">{{ trans('page.registration') }}</a>
            </li>
          </ul>
      </div>
    </nav>

    <header class="bg-{{ $event->color }} text-white background"></header>

    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto">
            <h1>{{ $event->name }}</h1>
            <p class="lead">{{ trans('page.organized') }}{{ $org->name }}.</p>
            <p class="text-justify">{!! $event->description !!}</p>
                    <table class="table">
                        <tr>
                            <th>{{ trans('panel.eventStart') }}</th>
                            <td>{{ $event->start }} ({{ \Carbon\Carbon::parse($event->start)->diffForHumans() }})</td>
                        </tr>
                        <tr>
                            <th>{{ trans('panel.eventFinish') }}</th>
                            <td>{{ $event->finish }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('panel.eventAddress') }}</th>
                            <td>{{ $event->address }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('panel.eventContact') }}</th>
                            <td><a href="mailto:{{ $event->contact }}">{{ $event->contact }}</a></td>
						</tr>
                        <tr>
                            <th>{{ trans('panel.eventWebsite') }}</th>
                            <td><a href="{{ $event->website }}">{{ $event->website }}</a></td>
						</tr>
                        <tr>
                            <th>{{ trans('page.orgAddress') }}</th>
                            <td>{{ $org->address }}</td>
                        </tr>
                    </table>
          </div>
        </div>
      </div>
    </section>

    <section id="register">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto">
            <h1>{{ trans('page.registration') }}</h1>
            @if($tickets < 1)
              <p class="lead section-lead text-justify">{{ trans('page.finished') }}</p>
            @else
              @if(Auth::check())
                @include('signing.reg')
              @else
                @include('signing.unreg')
              @endif
            @endif
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('page/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('page/vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('page/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('page/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="{{ asset('page/js/scrolling-nav.js') }}"></script>

  </body>

</html>
