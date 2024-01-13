@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
       {{ trans('form.'.$type->type) }}
    </h1>
</section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-danger">
                    <p>{{ trans('org.descForm') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-body">
                            <dl class="dl-horizontal">
                                @foreach($fields as $field)
                                    <dt>{{ trans('form.'.$type->type.'_'.$field->field) }}</dt>
                                    <dd>{{ $field->value }}</dd>
                                @endforeach
                            </dl>
                        </div>

                        <div class="box-footer">
                            <a href="/forms/{{ $type->id }}" class="btn btn-danger btn-block">{{ trans('org.goback') }}</a>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection