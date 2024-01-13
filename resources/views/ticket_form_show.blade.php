@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
       {{ trans('form.'.$formtype->type) }} – {{ $event->name }}
    </h1>
</section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-danger">
                    <p>{{ trans('ticket.formshow') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-body">
                            <dl class="dl-horizontal">
                                @foreach($fields as $field)
                                    <dt>{{ trans('form.'.$formtype->type.'_'.$field->field) }}</dt>
                                    <dd>{{ $field->value }}</dd>
                                @endforeach
                            </dl>
                        </div>

                        <div class="box-footer">
                            <a href="/{{ $slug }}/{{ $sha }}" class="btn btn-danger btn-block">{{ trans('ticket.goback') }}</a>
                            <a href="/{{ $slug }}/{{ $sha }}/{{ $formtype->slug }}/{{ $form->id }}/edit" class="btn btn-success btn-block">{{ trans('ticket.edit') }}</a>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection