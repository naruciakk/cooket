@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.tickets') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
            <div class="box box-success box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('org.ticketPayments') }}</h3>
                </div>
                <div class="box-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('org.description') }}</th>
                                <th>{{ trans('org.amount') }}</th>
                                <th>{{ trans('org.options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->description }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>
                                        <a href="/tickets/payments/edit/{{ $payment->id }}" type="button" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-edit" style="color:white;"></i></a>
                                        <span class="pull-right">
                                            <a href="/tickets/payments/delete/{{ $payment->id }}" type="button" class="btn btn-danger btn-circle"><i class="glyphicon glyphicon-remove" style="color:white;"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

            <div class="box box-success box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('org.paymentNew') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/tickets/'.$ticket->id.'/payments/new') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('org.description') }}</label>
                            <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('org.amount') }}</label>
                            <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}">
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
                    </div>
                </form>
            </div>

            <div class="box box-success box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('org.editTicket') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/tickets/'.$ticket->id) }}">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="form-group">
                            <label>{{ trans('org.ticketName') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $ticket->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ trans('org.ticketDesc') }}</label>
                            <input id="description" type="text" class="form-control" name="description" value="{{ $ticket->description }}">
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ trans('org.ticketColor') }}</label>
                            <select class="form-control" name="color" id="color" required="required">
                                <option value="primary">{{ trans('org.dark-blue') }}</option>
                                <option value="secondary">{{ trans('org.gray') }}</option>
                                <option value="success">{{ trans('org.green') }}</option>
                                <option value="danger">{{ trans('org.red') }}</option>
                                <option value="warning">{{ trans('org.yellow') }}</option>
                                <option value="info">{{ trans('org.light-blue') }}</option>
                                <option value="light">{{ trans('org.white') }}</option>
                                <option value="dark">{{ trans('org.black') }}</option>
                            </select>
                            @if ($errors->has('color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('color') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ trans('org.ticketStart') }}</label>
                            <input id="start" type="text" class="form-control" name="start" value="{{ $ticket->start }}">
                            @if ($errors->has('start'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('start') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ trans('org.ticketFinish') }}</label>
                            <input id="finish" type="text" class="form-control" name="finish" value="{{ $ticket->finish }}">
                            @if ($errors->has('finish'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('finish') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ trans('org.ticketAmount') }}</label>
                            <input id="amount" type="text" class="form-control" name="amount" value="{{ $ticket->amount }}">
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ trans('org.ticketAvailable') }}</label>
                            <select class="form-control" name="available" id="available" required="required">
                                <option value="0"
                                    @if($ticket->available == 0)
                                        selected="selected"
                                    @endif
                                >{{ trans('panel.no') }}</option>
                                <option value="1"
                                    @if($ticket->available == 1)
                                        selected="selected"
                                    @endif
                                >{{ trans('panel.yes') }}</option>
                            </select>
                            @if ($errors->has('available'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('available') }}</strong>
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
                            @if($guests == 0)
                                <a href="{{ URL('/tickets/delete/'.$ticket->id) }}" class="btn btn-danger" style="color:white">
                                    {{ trans('panel.eventDelete') }}
                                </a>
                            @endif
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
    </section>
@endsection