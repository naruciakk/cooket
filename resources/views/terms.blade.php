@extends('layouts.small')

@section('content')
    <p class="login-box-msg">
      {!! trans('main.terms_of_use') !!}
    </p>

    <br />

    <div class="row">
      <div class="col-xs-12">
        <a href="/" class="btn btn-success btn-block btn-flat">{{ trans('main.main') }}</a>
      </div>
    </div>
@endsection