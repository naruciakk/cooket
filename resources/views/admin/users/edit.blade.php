@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.users') }}
        <small>{{ trans('panel.admin') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('panel.userEdit') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/users/'.$user->id) }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('auth.given_name') }}</label>
                            <input id="given_name" type="text" class="form-control" name="given_name" value="{{ $user->given_name }}">
                            @if ($errors->has('given_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('given_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('auth.family_name') }}</label>
                            <input id="family_name" type="text" class="form-control" name="family_name" value="{{ $user->family_name }}">
                            @if ($errors->has('family_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('family_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('auth.nickname') }}</label>
                            <input id="nickname" type="text" class="form-control" name="nickname" value="{{ $user->nickname }}">
                            @if ($errors->has('nickname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('auth.email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('auth.city') }}</label>
                            <input id="city" type="text" class="form-control" name="city" value="{{ $user->city }}">
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <span class="pull-left">
                            <button type="submit" class="btn btn-primary">
                                {{ trans('panel.save') }}
                            </button>
                        </span>
                        <span class="pull-right">
                            <a href="{{ URL('/users/delete/'.$user->id) }}" class="btn btn-danger">
                                {{ trans('panel.delete') }}
                            </a>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
@endsection