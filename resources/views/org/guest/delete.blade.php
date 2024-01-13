@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.guests') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    {{ trans('org.deleteGuest') }}
                </div>
                <div class="box-body">
                    <p>{!! trans('org.deleteGuestAbout') !!} {{ $guest->given_name }}&nbsp;{{ $guest->family_name }}</p>
                    <form class="form-inline" method="post" action="/guests/delete/{{ $guest->id }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="password" class="sr-only">{{ trans('auth.password') }}</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="{{ trans('auth.password') }}">
                        </div>
                        <button type="submit" class="btn btn-default">{{ trans('org.submit') }}</button>
                    </form>
                </div>
            </div>
    </section>
@endsection