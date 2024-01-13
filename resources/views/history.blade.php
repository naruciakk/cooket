@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.history') }}
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-success">
            <p>{{ trans('panel.history_desc') }}</p>
        </div>

            <div class="box box-success">
                <div class="box-body">
                  @foreach($events as $event)
                  <a href="/{{ $event->slug }}"><p class="bg-{{ $event->color }} events-margin">{{ $event->name }} – {{ $event->city }} – {{ date('Y', strtotime($event->start)) }}</p></a>
                  @endforeach
                </div>
            </div>
    </section>
@endsection
