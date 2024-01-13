@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.orgs') }}
        <small>{{ trans('panel.admin') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-danger">
            <p>{{ trans('panel.descOrg') }}</p>
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
                                    <th>{{ trans('panel.orgName') }}</th>
                                    <th>{{ trans('panel.orgAddress') }}</th>
                                    <th>{{ trans('panel.orgWebsite') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orgs as $org)
                                <tr>
                                    <td>{{ $org->id }}</td>
                                    <td><a href="{{ url('/orgs/'.$org->id) }}">{{ $org->name }}</a></td>
                                    <td>{{ $org->address }}</td>
                                    <td><a href="{{ $org->website }}">{{ $org->website }}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.addOrg') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/orgs/new') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('panel.orgName') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgAddress') }}</label>
                            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgAccount') }}</label>
                            <input id="account" type="text" class="form-control" name="account" value="{{ old('account') }}">
                            @if ($errors->has('account'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('account') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgWebsite') }}</label>
                            <input id="website" type="text" class="form-control" name="website" value="{{ old('website') }}">
                            @if ($errors->has('website'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.orgSlug') }}</label>
                            <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}">
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
    </section>
@endsection