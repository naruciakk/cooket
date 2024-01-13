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
                    <p>{{ trans('ticket.formedit') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                    <div class="box box-danger">
                        <form role="form" method="POST" action="/{{ $slug }}/{{ $sha }}/{{ $name }}/{{ $form->id }}">
                            {{ csrf_field() }}
                            <div class="box-body">
                                        @foreach($raw->getFields() as $field)
                                            @foreach($fields as $fielddb)
                                                @if($field->getName() == $fielddb->field)
                                                    <div class="form-group">

                                                        <label>{{ trans('form.'.$raw->getName().'_'.$field->getName()) }}</label>

                                                        @if($field->getOptions())
                                                            <select id="{{ $field->getName() }}" class="form-control" name="{{ $field->getName() }}">
                                                                @foreach($field->getOptions() as $option)
                                                                    <option 
                                                                        @if($option['value'] == $fielddb->value)
                                                                            selected="selected"
                                                                        @endif
                                                                        value="{{ $option['value'] }}">{{ $option['name'] }}</option>
                                                                @endforeach
                                                            </select> 
                                                        @else
                                                            <input id="{{ $field->getName() }}" type="text" class="form-control" name="{{ $field->getName() }}" placeholder="{{ trans('form.'.$raw->getName().'_'.$field->getName().'__desc') }}" value="{{ $fielddb->value }}">
                                                        @endif

                                                        @if ($errors->has($field->getName()))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first($field->getName()) }}</strong>
                                                            </span>
                                                        @endif

                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-danger btn-block">{{ trans('panel.save') }}</a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </section>
@endsection