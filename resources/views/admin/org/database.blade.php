@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.users') }}
        <small>{{ trans('panel.admin') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
            <div class="box box-danger box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.editDatabase') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/orgs/edit/'.$database->id) }}">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="form-group">
                            <label>{{ trans('panel.orgDatabase') }}</label>
                            <input id="database" type="text" class="form-control" name="database" value="{{ $database->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgHost') }}</label>
                            <input id="host" type="text" class="form-control" name="host" value="{{ $database->host }}">
                            @if ($errors->has('host'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('host') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgUsername') }}</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ $database->username }}">
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgPassword') }}</label>
                            <input id="password" type="text" class="form-control" name="password" value="{{ $database->password }}">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <span class="pull-left">
                            <button type="submit" class="btn btn-danger">
                                {{ trans('panel.save') }}
                            </button>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
    </section>
@endsection