@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.transfers') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-info">
            <p>{{ trans('panel.descTransfer') }}</p>
        </div>

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.list') }}</h3>
                </div>
                <div class="box-body">
                            <table class="table table-striped table-bordered table-nice">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('org.codeS') }}</th>
                                        <th>{{ trans('auth.given_name') }}</th>
                                        <th>{{ trans('auth.family_name') }}</th>
                                        <th>{{ trans('auth.nickname') }}</th>
                                        <th>{{ trans('auth.city') }}</th>
                                        <th>{{ trans('org.amount') }}</th>
                                        <th>{{ trans('org.options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $in = 0;
                                    @endphp

                                    @foreach($everyone as $one)
                                        <tr>
                                            <td>{{ ++$in }}</td>
                                            <td>{{ $one['guest']->code }}</td>
                                            <td>{{ $one['data']->given_name }}</td>
                                            <td>{{ $one['data']->family_name }}</td>
                                            @if($one['data']->nickname == '')
                                                <td class="center"><i>{{ trans('panel.nothing') }}</i></td>
                                            @else
                                                <td>{{ substr($one['data']->nickname, 0, 40) }}</td>
                                            @endif
                                            <td>{{ $one['data']->city }}</td>
                                            <td>{{ $one['cash'] }}</td>
                                            <td><a href="/transfers/{{ $one['guest']->id }}">{{ trans('org.submit') }}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
            </div>
@endsection