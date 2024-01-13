@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>{{ trans('org.signs') }} <small>{{ trans('org.orgpanel') }}</small></h1>
</section>

<section class="content container-fluid">
    <div class="callout callout-info">
        <p>{{ trans('panel.descSigning') }}</p>
    </div>

    <div class="box box-primary box-solid">
        <div class="box-body">
            <a href="/signing/add" class="btn btn-primary btn-block">{{ trans('panel.addSigning') }}</a>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('panel.list') }}</h3>
        </div>
        <div class="box-body">
            <table width="100%" class="table table-striped table-bordered table-hover table-nice" id="dataTables">
                <thead>
                    <tr>
                        <th>{{ trans('org.codeS') }}</th>
                        <th>{{ trans('auth.name') }}</th>
                        <th>{{ trans('auth.nickname') }}</th>
                        <th>{{ trans('auth.city') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guests as $guest)
                    <tr>
                        <td>{{ $guest->code }}</td>
                        <td><a href="{{ url('/signing/'.$guest->id) }}">{{ $guest->given_name }}&nbsp;{{ $guest->family_name }}</a></td>
                        @if($guest->nickname == '')
                        <td class="center"><i>{{ trans('panel.nothing') }}</i></td>
                        @else
                        <td>{{ substr($guest->nickname, 0, 40) }}</td>
                        @endif
                        <td>{{ $guest->city }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
