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
                    <h3 class="box-title">{{ trans('panel.editOrg') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/orgs/'.$org->id) }}">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="form-group">
                            <label>{{ trans('panel.orgName') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $org->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgAddress') }}</label>
                            <input id="address" type="text" class="form-control" name="address" value="{{ $org->address }}">
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgAccount') }}</label>
                            <input id="account" type="text" class="form-control" name="account" value="{{ $org->account_number }}">
                            @if ($errors->has('account'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('account') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgWebsite') }}</label>
                            <input id="website" type="text" class="form-control" name="website" value="{{ $org->website }}">
                            @if ($errors->has('website'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgSlug') }}</label>
                            <input id="slug" type="text" class="form-control" name="slug" value="{{ $org->slug }}">
                            @if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.eventColor') }}</label>
                            <select class="form-control" name="color" id="color" required="required">
                                <option>primary</option><option>info</option><option>success</option><option>warning</option><option>danger</option><option>gray</option><option>navy</option><option>teal</option><option>purple</option><option>orange</option><option>maroon</option><option>black</option>
                            </select>
                            @if ($errors->has('v'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('color') }}</strong>
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

            <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('panel.list') }}</h3>
                    </div>
                    <div class="box-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('panel.orgDatabase') }}</th>
                                        <th>{{ trans('panel.orgHost') }}</th>
                                        <th>{{ trans('panel.orgUsername') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($databases as $database)
                                    <tr>
                                        <td>{{ $database->id }}</td>
                                        <td><a href="{{ url('/orgs/edit/'.$database->id) }}">{{ $database->name }}</a></td>
                                        <td>{{ $database->host }}</td>
                                        <td>{{ $database->username }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
            </div>

            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.addDatabase') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/orgs/new/'.$org->id) }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('panel.orgDatabase') }}</label>
                            <input id="database" type="text" class="form-control" name="database" value="{{ old('database') }}">
                            @if ($errors->has('database'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('database') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgHost') }}</label>
                            <input id="host" type="text" class="form-control" name="host" value="{{ old('host') }}">
                            @if ($errors->has('host'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('host') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgUsername') }}</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgPassword') }}</label>
                            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
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