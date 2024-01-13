@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>{{ trans('org.guests') }} <small>{{ trans('org.orgpanel') }}</small></h1>
</section>

<section class="content container-fluid">
    <div class="callout callout-info">
        <p>{{ trans('panel.descGuest') }} <a href="/guests/printing">{{ trans('org.print') }}</a>, <a href="/guests/csving">{{ trans('org.csv_for_ids') }}</a>.</p>
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
                        <th>{{ trans('org.account') }}</th>
                        <th>{{ trans('org.info') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guests as $guest)
                    <tr>
                        <td>{{ $guest->code }}</td>
                        <td><a href="{{ url('/guests/'.$guest->id) }}">{{ $guest->given_name }}</a></td>
                        <td><a href="{{ url('/guests/'.$guest->id) }}">{{ $guest->family_name }}</a></td>
                        @if($guest->nickname == '')
                        <td class="center"><i>{{ trans('panel.nothing') }}</i></td>
                        @else
                        <td>{{ substr($guest->nickname, 0, 40) }}</td>
                        @endif
                        <td>{{ $guest->city }}</td>
                        <td>
                            @if($guest->user)
                            <span style="color: green">{{ trans('auth.yes') }}</span>
                            @else
                            <span style="color: red">{{ trans('auth.no') }}</span>
                            @endif
                        </td>
                        <td>
                            @if($guest->adult)
                            <span style="color: green">T</span>
                            @else
                            <span style="color: red">N</span>
                            @endif
                            /
                            @if($guest->accomodation)
                            <span style="color: green">T</span>
                            @else
                            <span style="color: red">N</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('org.addGuest') }}</h3>
        </div>
        <form role="form" method="POST" action="/guests/add">
            {{ csrf_field() }}
            <div class="box-body">
                @include('signing.unregistered2')
            </div>
        </form>
    </div>
    @endsection
