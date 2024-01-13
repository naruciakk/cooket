@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.users') }}
        <small>{{ trans('panel.admin') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-info">
            <p>{{ trans('panel.descUser') }}</p>
        </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('panel.list') }}</h3>
                </div>
                <div class="box-body">
                        <table class="table table-striped table-bordered table-hover table-nice">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('auth.name') }}</th>
                                    <th>{{ trans('auth.nickname') }}</th>
                                    <th>{{ trans('auth.email') }}</th>
                                    <th>{{ trans('auth.city') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><a href="{{ url('/users/'.$user->id) }}">{{ $user->given_name }}&nbsp;{{ $user->family_name }}</a></td>
                                        @if($user->nickname == '')
                                            <td class="center"><i>{{ trans('panel.nothing') }}</i></td>
                                        @else
                                            <td>{{ $user->nickname }}</td>
                                        @endif
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->city }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    </section>
@endsection