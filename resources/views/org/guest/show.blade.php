@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.guests') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('org.information') }}</h3>
                </div>
                <div class="box-body">
                        <table width="100%" class="table">
                            <tr>
                                <th>{{ trans('auth.given_name') }}</th>
                                <td>{{ $data->given_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('auth.family_name') }}</th>
                                <td>{{ $data->family_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('auth.nickname') }}</th>
                                <td>{{ $data->nickname }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('auth.city') }}</th>
                                <td>{{ $data->city }}</td>
                            </tr>
                            @if($online != NULL)
                                <tr>
                                    <th>{{ trans('auth.email') }}</th>
                                    <td>{{ $online->email }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th>{{ trans('org.code') }}</th>
                                <td>{{ $guest->code }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('org.ticket') }}</th>
                                <td><i class="fa fa-square" aria-hidden="true" style="color:{{ $ticket->color }}"></i> {{ $ticket->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('org.sign') }}</th>
                                <td>{{ $guest->sign }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('org.annotation') }}</th>
                                <td>{{ $guest->annotation }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('org.signannotation') }}</th>
                                <td>{{ $guest->sign_annotation }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('org.adult') }}</th>
                                <td>
                                    @if($guest->adult)
                                        <span style="color: green">Tak</span>
                                    @else
                                        <span style="color: red">Nie</span>
                                    @endif
                                </td>
                            </tr>
                            @if($event->accomodation)
                            <tr>
                                <th>{{ trans('org.acc') }}</th>
                                <td>
                                    @if($guest->accomodation)
                                        <span style="color: green">Tak</span>
                                    @else
                                        <span style="color: red">Nie</span>
                                    @endif
                                </td>
                            </tr>
																												@endif
                            @if($event->userimage && $online != NULL)
                            <tr>
                                <th>{{ trans('org.uimage') }}</th>
                                <td>
                                    {{ $online->userimage }}
                                </td>
                            </tr>
                            @endif
                        </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('org.payments') }}</h3>
                </div>

                <div class="box-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('org.description') }}</th>
                                <th>{{ trans('org.amount') }}</th>
                                <th>{{ trans('panel.options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $it = 0;
                        @endphp

                            @foreach($payments as $payment)
                                <tr
                                @if($payment->paid)
                                class="success"
                                @endif
                                >
                                    <td class="vert-align">{{ ++$it }}</td>
                                    <td>{{ $payment->description }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>
                                        <span class="pull-left">
                                            @if($payment->paid)
                                                <a href="/guests/payments/change/{{ $payment->id }}" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-ban-circle"></i></a>
                                            @else
                                                <a href="/guests/payments/change/{{ $payment->id }}" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-ok"></i></a>
                                            @endif
                                            <a href="/guests/payments/edit/{{ $payment->id }}" class="btn btn-info btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a href="/guests/payments/delete/{{ $payment->id }}" type="button" class="btn btn-danger btn-circle"><i class="glyphicon glyphicon-remove"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('org.paymentNew') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/guests/'.$guest->id.'/payments/new') }}">
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
                            <button type="submit" class="btn btn-primary">
                                {{ trans('panel.save') }}
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.options') }}</h3>
                </div>
                <div class="box-body">
                    <a href="/guests/delete/{{ $guest->id }}" class="btn btn-danger btn-block">{{ trans('org.removeguest') }}</a>
                    <a href="/guests/{{ ($guest->id)+1 }}" class="btn btn-primary btn-block">{{ trans('org.next') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('org.editguest') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/guests/edit/'.$guest->id) }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('auth.given_name') }}</label>
                            <input id="given_name" type="text" class="form-control" name="given_name" value="{{ $data->given_name }}">
                            @if ($errors->has('given_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('given_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('auth.family_name') }}</label>
                            <input id="family_name" type="text" class="form-control" name="family_name" value="{{ $data->family_name }}">
                            @if ($errors->has('family_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('family_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('auth.nickname') }}</label>
                            <input id="nickname" type="text" class="form-control" name="nickname" value="{{ $data->nickname }}">
                            @if ($errors->has('nickname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname') }}</strong>
                                </span>
                            @endif
                        </div>
                        @if($online != NULL)
                        <div class="form-group">
                            <label>{{ trans('auth.email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $online->email }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        @endif
                        <div class="form-group">
                            <label>{{ trans('auth.city') }}</label>
                            <input id="city" type="text" class="form-control" name="city" value="{{ $data->city }}">
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('org.annotation') }}</label>
                            <input id="annotation" type="text" class="form-control" name="annotation" value="{{ $guest->annotation }}">
                            @if ($errors->has('annotation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('annotation') }}</strong>
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
                            <a href="/guests/{{ $guest->id }}" class="btn btn-info">
                                {{ trans('org.back') }}
                            </a>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>
@endsection
