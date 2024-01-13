@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
       {{ trans('form.'.$form->getName()) }} – {{ $event->name }}
    </h1>
</section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-danger">
                    <p>{{ trans('form.'.$form->getName().'__desc') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                    <div class="box box-danger">
                        <form role="form" method="POST" action="/{{ $slug }}/{{ $sha }}/{{ $name }}">
                            {{ csrf_field() }}
                            <div class="box-body">
                                    @foreach($form->getFields() as $field)

                                        <div class="form-group">

                                            <label>{{ trans('form.'.$form->getName().'_'.$field->getName()) }}</label>

                                            @if($field->getOptions())
                                                <select id="{{ $field->getName() }}" class="form-control" name="{{ $field->getName() }}">
                                                    @foreach($field->getOptions() as $option)
                                                        <option value="{{ $option['value'] }}">{{ $option['name'] }}</option>
                                                    @endforeach
                                                </select> 
                                            @else
                                                <input id="{{ $field->getName() }}" type="text" class="form-control" name="{{ $field->getName() }}" placeholder="{{ trans('form.'.$form->getName().'_'.$field->getName().'__desc') }}" value="{{ old($field->getName()) }}">
                                            @endif

                                            @if ($errors->has($field->getName()))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first($field->getName()) }}</strong>
                                                </span>
                                            @endif

                                        </div>

                                    @endforeach
                            </div>

                            <div class="box-footer">
                                <span class="pull-left">
                                    <button type="submit" class="btn btn-danger">
                                        {{ trans('panel.send') }}
                                    </button>
                                </span>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </section>
@endsection