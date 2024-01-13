@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.signs') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">

    <form action="/signing/{{ $guest->id }}" method="POST">
        {{ csrf_field() }}

        <ul class="timeline">

            <li>
                <i class="fa fa-eye bg-blue"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">{{ trans('org.verification') }}</h3>

                    <div class="timeline-body">
                                    <p>{{ trans('org.verification-ex') }}</p><br />
                                    <b>{{ trans('auth.name') }}</b>: {{ $data->given_name }}&nbsp;{{ $data->family_name }}<br />
                                    <b>{{ trans('auth.city') }}</b>: {{ $data->city }}<br />
                                    <b>{{ trans('org.adult') }}</b>: 
                                    @if($guest->adult)
                                        <span style="color: green">Tak</span>
                                    @else
                                        <span style="color: red">Nie</span>
                                    @endif
                                    <br /><br />
                                    <b>{{ trans('org.code') }}</b>: {{ $guest->code }}
                    </div>
                </div>
            </li>

            @if(!($guest->adult))
            <li>
                <i class="fa fa-user bg-red"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">{{ trans('org.notadult') }}</h3>

                    <div class="timeline-body">
                        <p>{!! trans('org.notadult-ex') !!}</p>
                    </div>
                </div>
            </li>
            @endif

            <li>
                <i class="fa fa-credit-card bg-yellow"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">{{ trans('org.payments') }}</h3>

                    <div class="timeline-body">
                                    <p>{{ trans('org.payments-ex') }}</p>
                                    @foreach($payments as $payment)
                                        @if(!$payment->paid)
                                            <ul class="list-group" style="margin: 0; padding: 0;">
                                            <li class="list-group-item"><input type="checkbox" name="paid[]" value="{{ $payment->id }}" /> {{ $payment->description }} – <b>{{ $payment->amount }} PLN</b></li>
                                            </ul>
                                        @endif
                                    @endforeach
                                    <br />
                                    <select id="payment_type" name="payment_type" class="form-control">
                                        @foreach($paymentTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <br />
                                    <input type="text" name="payment_information" id="payment_information" class="form-control" placeholder="{{ trans('org.paymentInformation') }}" value="{{ old('payment_information') }}" />
                    </div>
                </div>
            </li>

            <li>
                <i class="fa fa-pencil bg-blue"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">{{ trans('org.sign') }}</h3>

                    <div class="timeline-body">
                                    <p>{!! trans('org.sign-ex') !!}</p>
                                    <input type="text" name="sign" id="sign" class="form-control" placeholder="{{ trans('org.insertsign') }}" required="required" value="{{ old('sign') }}" />
                    </div>
                </div>
            </li>

            <li>
                <i class="fa fa-pencil bg-yellow"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">{{ trans('org.id') }}</h3>

                    <div class="timeline-body">
                                    <p>{!! trans('org.id-ex') !!}</p><br />
                                    <b>{{ trans('auth.name') }}</b>: {{ $data->given_name }}&nbsp;{{ $data->family_name }}<br />
                                    <b>{{ trans('auth.city') }}</b>: {{ $data->city }}<br />
                                    <b>{{ trans('auth.nickname') }}</b>:
                                        @if($data->nickname == '')
                                            <td class="center"><i>{{ trans('panel.nothing') }}</i></td>
                                        @else
                                            <td>{{ $data->nickname }}</td>
                                        @endif
                                    <br />
                                    <b>{{ trans('org.code') }}</b>: {{ $guest->code }}<br />
                                    <b>{{ trans('org.ticket') }}:</b> <i class="fa fa-square" aria-hidden="true" style="color:{{ $ticket->color }}"></i> {{ $ticket->name }}
                    </div>
                </div>
            </li>

            <li>
                <i class="fa fa-check bg-green"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">{{ trans('org.success') }}</h3>

                    <div class="timeline-body">
                                    <p>{!! trans('org.success-ex') !!}</p><br />
                                    <textarea class="form-control" id="sign_annotation" name="sign_annotation" placeholder="{{ trans('org.sign_annotation') }}">{{ old('sign_annotation') }}</textarea><br />
                                    <input type="submit" class="form-control bg-blue" value="{{ trans('panel.send') }}" />
                    </div>
                </div>
            </li>

        </ul>
    </form>

    </section>
@endsection