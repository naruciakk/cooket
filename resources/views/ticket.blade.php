@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        {{ $event->name }}
    </h1>
</section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-info">
                    <p>{{ trans('ticket.description') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('ticket.ticketNumber') }}</h3>
                    </div>
                    <div class="box-body">
                        <h1 class="text-center" style="margin: 0; padding: 0;">{{ $guest->code }}</h1>
                    </div>
                </div>
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('ticket.eventInformation') }}</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-justify">{{ trans('ticket.descriptionEnd') }}</p>
                        <dl class="dl-horizontal">
                            <dt>Rozpoczęcie</dt>
                            <dd>{{ $event->start }}</dd>
                            <dt>Zakończenie</dt>
                            <dd>{{ $event->finish }}</dd>
                            <dt>Adres placówki</dt>
                            <dd>{{ $event->address }}</dd>
                            <dt>Organizator</dt>
                            <dd>{{ $org->name }}</dd>
                            <dt>Email kontaktowy</dt>
                            <dd>{{ $event->contact }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('ticket.owner') }}</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-justify">{{ trans('ticket.descriptionData') }}</p>
                        <dl class="dl-horizontal">
                            <dt>{{ trans('auth.name') }}</dt>
                            <dd>{{ $data->given_name }}&nbsp;{{ $data->family_name }}</dd>
                            <dt>{{ trans('auth.city') }}</dt>
                            <dd>{{ $data->city }}</dd>
                        </dl>
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
                                    @if($event->prepaid)
                                        <th>{{ trans('ticket.is_paid') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $it = 0;
                                $notpaid = 0;
                            @endphp

                                @foreach($payments as $payment)
                                    <tr
                                    @if($payment->paid)
                                        class="success"
                                    @else
                                        @php
                                            $notpaid++;
                                        @endphp
                                    @endif
                                    >
                                        <td class="vert-align">{{ ++$it }}</td>
                                        <td>{{ $payment->description }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>
                                            @if($event->prepaid)
                                                @if($payment->paid)
                                                    opłacona
                                                @else
                                                    <b>nieopłacona</b>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($notpaid > 0 && $event->prepaid)

                <div class="box box-primary box-solid">
					<div class="box-body">
                        {!! \App\Support\Payments\Paying::show($org->id, $guest) !!}
                    </div>
                </div>

                <div class="box box-primary box-solid">
                    <div class="box-body">
                        {{ trans('ticket.ifsent') }}
                    </div>
                </div>

                <div class="box box-warning box-solid">
                    <div class="box-body">
                        {!! trans('ticket.disclaimer') !!}
                    </div>
                </div>

                @endif

                @if(!$guest->adult)

                <div class="box box-danger box-solid">
                    <div class="box-body">
                        {{ trans('ticket.under18') }}
                    </div>
                </div>

                @endif

				@if($event->userimage)
				<div class="box box-primary box-solid">
					<div class="box-header">
						{{ trans('panel.eventUserImage') }} ({{trans('page.not_required') }})
					</div>
					<div class="box-body">
						@if (strlen($online->userimage) == 0)
						<form role="form" method="POST" action="/{{ $event->slug }}/{{ $online->sha }}/photo" enctype="multipart/form-data">
							{{ csrf_field() }}
							<input type="file" class="form-control-file" id="userimage" name="userimage" />
							<button type="submit" class="btn btn-block bg-blue" style="margin-top: 0.3em">{{ trans('panel.send') }}</button>
							@if ($errors->has('userimage'))
								<span class="help-block">
									<strong>{{ $errors->first('userimage') }}</strong>
								</span>
								@endif
						</form>
						@else
							<i>{{ trans('ticket.uploaded') }}</i>
						@endif
                    </div>
                </div>
				@endif

				@if($event->ticket != '')

                <div class="box box-primary box-solid">
                    <div class="box-body">
                        <a href="/{{ $slug }}/{{ $sha }}/print" class="btn btn-primary btn-block">{{ trans('ticket.print') }}</a>
                    </div>
				</div>

				@endif

                @if($formtypes->count())

                <div class="box box-danger box-solid">
                    <div class="box-body">
                        @foreach($formtypes->get() as $formtype)
                            <a href="/{{ $slug }}/{{ $sha }}/{{ $formtype->slug }}" class="btn btn-danger btn-block">{{ trans('form.'.$formtype->type) }}</a>
                        @endforeach
                    </div>
                </div>

                @endif

            </div>
        </div>

        @if($formtypes->count())

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger box-solid">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('ticket.forms') }}</h3>
                    </div>

                    <div class="box-body">
                        <p>{{ trans('ticket.formdescription') }}</p>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('ticket.form_name') }}</th>
                                    <th>{{ trans('ticket.form_date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $it = 0;
                                @endphp

                                @foreach($forms as $form)
                                    @foreach($formtypes->get() as $formtype)
                                        @if($formtype->id == $form->type)
                                            <tr>
                                                <td class="vert-align">{{ ++$it }}</td>
                                                <td>
                                                    <a href="/{{ $slug }}/{{ $sha }}/{{ $formtype->slug }}/{{ $form->id }}">{{ trans('form.'.$formtype->type) }}</a>
                                                </td>
                                                <td>{{ $form->created_at }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @endif

    </section>
@endsection
