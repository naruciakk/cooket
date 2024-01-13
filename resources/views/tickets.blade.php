@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.archive') }}
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-info">
            <p>{{ trans('panel.archive_desc') }}</p>
        </div>

            <div class="box box-primary">
                <div class="box-body">
                  @foreach($events as $event)
                    @foreach($orgs as $org)
                      @if($org->id == $event->organization)
                        <a href="/archive/{{ $event->slug }}"><p class="bg-{{ $event->color }} events-margin">{{ $event->name }} – {{ $org->name }} – {{ $event->website }}</p></a>
                      @endif
                    @endforeach
                  @endforeach
                </div>
            </div>
    </section>
@endsection
