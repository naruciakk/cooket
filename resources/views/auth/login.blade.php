@extends('layouts.small')

@section('content')
    <p class="login-box-msg">{{ trans('auth.loginlong') }}</p>

    <form action="{{ route('login') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input type="email" class="form-control" placeholder="{{ trans('auth.email') }}" value="{{ old('email') }}" id="email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input type="password" class="form-control" placeholder="{{ trans('auth.password') }}" id="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> {{ trans('auth.remember') }}
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.login') }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="/password/reset">{{ trans('auth.forgotPassword') }}</a><br>
    <a href="/register" class="text-center">{{ trans('auth.register') }}</a>

    <br /><br />
    {!! trans('main.proceed') !!}
@endsection