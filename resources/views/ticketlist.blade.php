@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.archive') }}
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-info">
            <p>{{ trans('panel.archiveTickets_desc') }}</p>
        </div>

            <div class="box box-primary">
                <div class="box-body">
                    <div class="list-group">
                      @if($guests->count() > 0)
                        @foreach($guests->get() as $guest)
                          @foreach($types as $type)
                            @if($type->id == $guest->ticket)
                              @foreach($onlines as $online)
                                @if($online->guest == $guest->id)
                                  <a href="/{{ $event->slug }}/{{ $online->sha }}" class="list-group-item list-group-item-{{ $type->color }}">{{ $type->name }}<span class="badge">{{ $guest->code }}</span></a>
                                @endif
                              @endforeach
                            @endif
                          @endforeach
                        @endforeach
                      @else
                        <i>{{ trans('ticket.notickets') }}</i>
                      @endif
                    </div>
                </div>
            </div>
    </section>
@endsection