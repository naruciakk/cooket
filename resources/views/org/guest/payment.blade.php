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
                    <h3 class="box-title">{{ trans('org.paymentEdit') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/guests/payments/edit/'.$payment->id) }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('org.description') }}</label>
                            <input id="description" type="text" class="form-control" name="description" value="{{ $payment->description }}">
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('org.amount') }}</label>
                            <input id="amount" type="text" class="form-control" name="amount" value="{{ $payment->amount }}">
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <span class="pull-left">
                            <button type="submit" class="btn btn-primary">
                                {{ trans('panel.save') }}
                            </button>
                        </span>
                        <span class="pull-right">
                            <a href="/guests/{{ $payment->guest }}" class="btn btn-info">
                                {{ trans('org.back') }}
                            </a>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
@endsection