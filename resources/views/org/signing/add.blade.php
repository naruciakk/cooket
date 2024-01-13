@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.addSigning') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-info">
            <p>{{ trans('panel.descSigningAdd') }}</p>
        </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('org.signing') }}</h3>
        </div>
        <div class="box-body">
        <form action="/signing/add" method="POST">
        {{ csrf_field() }}
            <ul class="timeline">

                <li>
                    <i class="fa fa-eye bg-blue"></i>
                    <div class="timeline-item">

                        <h3 class="timeline-header">{{ trans('org.verification') }}</h3>

                        <div class="timeline-body">
                                        <p>{{ trans('org.add-verification-ex') }}</p><br />
                                        <input type="text" class="form-control" id="given_name" name="given_name" value="{{ old('given_name') }}" placeholder="{{ trans('auth.given_name') }}" required="required" /><br />
                                        <input type="text" class="form-control" id="family_name" name="family_name" value="{{ old('family_name') }}" placeholder="{{ trans('auth.family_name') }}" required="required" /><br />
                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" placeholder="Miasto zamieszkania" required="required" /><br />
                                        <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname') }}" placeholder="Ksywa (nieobowiązkowo)" /><br />
                                        <b>Czy jest pełnoletni?</b><br /><br />
                                        <select type="text" class="form-control" id="adult" name="adult">
                                            <option value="0">{{ trans('panel.no') }}</option>
                                            <option value="1" selected="selected">{{ trans('panel.yes') }}</option>
                                        </select><br />
                                        @if($event->accomodation)
                                        <b>Czy nocuje?</b><br /><br />
                                            <select type="text" class="form-control" id="accomodation" name="accomodation">
                                                @if(old('accomodation'))
                                                    <option value="0">{{ trans('panel.no') }}</option>
                                                    <option value="1" selected="selected">{{ trans('panel.yes') }}</option>
                                                @else
                                                    <option value="0" selected="selected">{{ trans('panel.no') }}</option>
                                                    <option value="1">{{ trans('panel.yes') }}</option>
                                                @endif
                                            </select>
                                        @endif
                        </div>
                    </div>
                </li>

                <li>
                    <i class="fa fa-credit-card bg-yellow"></i>
                    <div class="timeline-item">

                        <h3 class="timeline-header">{{ trans('org.add-payments') }}</h3>

                        <div class="timeline-body">
                                        <p>{!! trans('org.add-payments-ex') !!}</p><br />
                                        <ul class="list-group" style="margin: 0; padding: 0;">
                                            {!! \App\Support\GiveTickets::getTickets($event->id, true) !!}
                                        </ul>
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
                    <i class="fa fa-credit-card bg-green"></i>
                    <div class="timeline-item">

                        <h3 class="timeline-header">{{ trans('org.sign') }}</h3>

                        <div class="timeline-body">
                                        <p>{!! trans('org.sign-ex') !!}</p><br />
                                        <input type="text" name="sign" id="sign" class="form-control" placeholder="{{ trans('org.insertsign') }}" required="required" value="{{ old('sign') }}" />
                        </div>
                    </div>
                </li>

                <li>
                    <i class="fa fa-pencil bg-blue"></i>
                    <div class="timeline-item">

                        <h3 class="timeline-header">{{ trans('org.id') }}</h3>

                        <div class="timeline-body">
                            <p>{!! trans('org.id-ex') !!}</p><br />
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
                                        <input type="submit" class="form-control bg-blue" value="Wyślij" />
                        </div>
                    </div>
                </li>

            </ul>
        </form>

        </div>
    </div>

</section>
@endsection