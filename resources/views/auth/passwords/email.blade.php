@extends('layouts.small')

@section('content')
    <p class="login-box-msg">{{ trans('auth.resetPassword') }}</p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="post">
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
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.sendPassword') }}</button>
        </div>
      </div>
    </form>
@endsection