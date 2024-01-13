@extends('layouts.small')

@section('content')
    <p class="login-box-msg">{{ trans('auth.registerlong') }}</p>

    <form action="{{ route('register') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('given_name') ? ' has-error' : '' }} has-feedback">
        <input type="text" class="form-control" placeholder="{{ trans('auth.given_name') }}*" value="{{ old('given_name') }}" id="given_name" name="given_name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('given_name'))
            <span class="help-block">
                <strong>{{ $errors->first('given_name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('family_name') ? ' has-error' : '' }} has-feedback">
        <input type="text" class="form-control" placeholder="{{ trans('auth.family_name') }}*" value="{{ old('family_name') }}" id="family_name" name="family_name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('family_name'))
            <span class="help-block">
                <strong>{{ $errors->first('family_name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }} has-feedback">
        <input type="text" class="form-control" placeholder="{{ trans('auth.nickname') }}" value="{{ old('nickname') }}" id="nickname" name="nickname">
        <span class="glyphicon glyphicon-knight form-control-feedback"></span>
        @if ($errors->has('nickname'))
            <span class="help-block">
                <strong>{{ $errors->first('nickname') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }} has-feedback">
        <input type="text" class="form-control" placeholder="{{ trans('auth.city') }}*" value="{{ old('city') }}" id="city" name="city">
        <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
        @if ($errors->has('city'))
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input type="email" class="form-control" placeholder="{{ trans('auth.email') }}*" value="{{ old('email') }}" id="email" name="email" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input type="password" class="form-control" placeholder="{{ trans('auth.password') }}*" id="password" name="password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="{{ trans('auth.confPassword') }}*" id="password-confirm" name="password_confirmation" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	  </div>
      <div class="form-group has-feedback">
		<input type="checkbox" name="consent" />&nbsp;{!! trans('main.proceed2') !!}
      </div>
      <div class="row">
        <div class="col-xs-8">
            <a href="/login">{{ trans('auth.loginreg') }}</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.save') }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br />
    {!! trans('main.proceed') !!}
    
@endsection
