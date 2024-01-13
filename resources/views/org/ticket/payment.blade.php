@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.guests') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
            <div class="box box-success box-solid">
                <div class="box-header">
                    {{ trans('org.paymentEdit') }}
                </div>
                <form role="form" method="POST" action="{{ url('/tickets/payments/edit/'.$payment->id) }}">
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
                            <button type="submit" class="btn btn-success">
                                {{ trans('panel.save') }}
                            </button>
                        </span>
                        <span class="pull-right">
                            <a href="/tickets/{{ $payment->event }}" class="btn btn-info" style="color: white;">
                                {{ trans('org.back') }}
                            </a>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
    </section>
@endsection