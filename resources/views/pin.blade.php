@extends('layouts.small')

@section('content')
    <p class="login-box-msg">{{ trans('auth.pindesc') }}</p>

    <form action="/{{ $slug }}/{{ $sha }}" method="post">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }} has-feedback">
        <input type="text" class="form-control" placeholder="{{ trans('auth.pin') }}" value="{{ old('pin') }}" id="pin" name="pin">
        <span class="glyphicon glyphicon-ice-lolly-tasted form-control-feedback"></span>
        @if ($errors->has('pin'))
            <span class="help-block">
                <strong>{{ $errors->first('pin') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.go') }}</button>
        </div>
      </div>
    </form>
@endsection