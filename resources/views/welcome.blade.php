@extends('layouts.small')

@section('content')
    <p class="login-box-msg">{{ trans('main.description') }}</p>


      <div class="row">
        <div class="col-xs-6 text-center">
            <a href="/register">{{ trans('auth.register') }}</a>
        </div>

        <div class="col-xs-6 text-center">
          <a href="/login">{{ trans('auth.login') }}</a>
        </div>
      </div>

      <br />

      <div class="row">
        <div class="col-xs-12 text-center">
            <a href="/terms">{{ trans('main.terms') }}</a>
        </div>
      </div>

      <br />

      <div class="row">
        <div class="col-xs-12">
            @foreach($events as $event)
                <a href="/{{ $event->slug }}" class="btn btn-success btn-block btn-flat">{{ $event->name }}</a>
            @endforeach
        </div>
      </div>


    
@endsection