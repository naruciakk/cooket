@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.roles') }}
        <small>{{ trans('panel.admin') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-warning">
            <p>{{ trans('panel.descAdminRole') }}</p>
        </div>

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('panel.list') }}</h3>
                </div>
                <div class="box-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('panel.roleTime') }}</th>
                                <th>{{ trans('panel.user') }}</th>
                                <th>{{ trans('panel.role') }}</th>
                                <th>{{ trans('panel.options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    @foreach($users as $user)
                                        @if($role->user == $user->id)
                                            <td><a href="{{ url('/users/'.$user->id) }}">{{ $user->given_name }}&nbsp;{{ $user->family_name }}</a></td>
                                        @endif
                                    @endforeach
                                    <td>{{ $role->role }}</td>
                                    <td><a href="{{ URL('/roles/delete/'.$role->id) }}" class="btn btn-danger" style="color: white;">{{ trans('panel.delete') }}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.addRole') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/roles/new') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('panel.user') }}</label>
                            <select class="form-control" name="user" id="user" required="required">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->id }} – {{ $user->given_name }}&nbsp;{{ $user->family_name }} – {{ $user->city }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.roleDescr') }}</label>
                            <select class="form-control" name="role" id="role" required="required">
                                <option value="admin">{{ trans('panel.administrator') }}</option>
                                <option value="events">{{ trans('panel.events') }}</option>
                                <!--<option value="org">{{ trans('org.org') }}</option>-->
                                <option value="users">{{ trans('panel.users') }}</option>
                                <option value="orgs">{{ trans('panel.orgs') }}</option>
                                <option value="change">{{ trans('panel.change') }}</option>
                            </select>
                            @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <span class="pull-left">
                            <button type="submit" class="btn btn-warning">
                                {{ trans('panel.save') }}
                            </button>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
    </section>
@endsection