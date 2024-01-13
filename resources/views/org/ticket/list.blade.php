@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.tickets') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-success">
            <p>{{ trans('panel.descTicket') }}</p>
        </div>

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.list') }}</h3>
                </div>
                <div class="box-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('org.ticketName') }}</th>
                                <th>{{ trans('org.ticketStart') }}</th>
                                <th>{{ trans('org.ticketFinish') }}</th>
                                <th>{{ trans('org.ticketAmount') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td><a href="{{ url('/tickets/'.$ticket->id) }}">{{ $ticket->name }}</a></td>
                                    <td>{{ $ticket->start }}</td>
                                    <td>{{ $ticket->finish }}</td>
                                    <td>{{ $ticket->amount }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('org.addTicket') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/tickets/new') }}">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label>{{ trans('org.ticketName') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ trans('org.ticketDesc') }}</label>
                            <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">
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
                            <input id="start" type="datetime-local" class="form-control" name="start" value="{{ old('start') }}">
                            @if ($errors->has('start'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('start') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ trans('org.ticketFinish') }}</label>
                            <input id="finish" type="datetime-local" class="form-control" name="finish" value="{{ old('finish') }}">
                            @if ($errors->has('finish'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('finish') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ trans('org.ticketAmount') }}</label>
                            <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}">
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
                                    @if(old('available') == 0)
                                        selected="selected"
                                    @endif
                                >{{ trans('panel.no') }}</option>
                                <option value="1"
                                    @if(old('available') == 1)
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
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
    </section>
@endsection