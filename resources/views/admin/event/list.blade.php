@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.events') }}
        <small>{{ trans('panel.admin') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-success">
            <p>{{ trans('panel.descEvent') }}</p>
        </div>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('panel.list') }}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('panel.eventName') }}</th>
                                <th>{{ trans('panel.eventSlug') }}</th>
                                <th>{{ trans('panel.eventOrg') }}</th>
                                <th>{{ trans('panel.eventCity') }}</th>
                                <th>{{ trans('panel.eventStart') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->id }}</td>
                                    <td><a href="{{ url('/events/'.$event->id) }}">{{ $event->name }}</a></td>
                                    <td>{{ $event->slug }}</td>
                                    @foreach($orgs as $org)
                                        @if($event->organization == $org->id)
                                            <td>{{ $org->name }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $event->city }}</td>
                                    <td>{{ $event->start }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.addEvent') }}</h3>
                </div>
                    <form role="form" method="POST" action="{{ url('/events/new') }}">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>{{ trans('panel.eventName') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventColor') }}</label>
                                <select class="form-control" name="color" id="color" required="required">
                                    <option>primary</option><option>info</option><option>success</option><option>warning</option><option>danger</option><option>gray</option><option>navy</option><option>teal</option><option>purple</option><option>orange</option><option>maroon</option><option>black</option>
                                </select>
                                @if ($errors->has('v'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventDescr') }}</label>
                                <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventSlug') }}</label>
                                <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventOrg') }}</label>
                                <select class="form-control" name="organization" id="organization" required="required">
                                    @foreach($orgs as $org)
                                        <option value="{{ $org->id }}"
                                            @if ($org->id == old('org'))
                                                selected="selected"
                                            @endif
                                        >{{ $org->id }} – {{ $org->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('organization'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventImage') }}</label>
                                <input id="image" type="text" class="form-control" name="image" value="{{ old('image') }}">
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventWebsite') }}</label>
                                <input id="website" type="text" class="form-control" name="website" value="{{ old('website') }}">
                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventContact') }}</label>
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact') }}">
                                @if ($errors->has('contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventStart') }}</label>
                                <input id="start" type="datetime-local" class="form-control" name="start" value="{{ old('start') }}">
                                @if ($errors->has('start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventFinish') }}</label>
                                <input id="finish" type="datetime-local" class="form-control" name="finish" value="{{ old('finish') }}">
                                @if ($errors->has('finish'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('finish') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventCity') }}</label>
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventAddress') }}</label>
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventAccomodation') }}</label>
                                <select class="form-control" name="accomodation" id="accomodation" required="required">
                                    <option value="0"
                                        @if(old('accomodation') == 0)
                                            selected="selected"
                                        @endif
                                    >{{ trans('panel.no') }}</option>
                                    <option value="1"
                                        @if(old('accomodation') == 1)
                                            selected="selected"
                                        @endif
                                    >{{ trans('panel.yes') }}</option>
                                </select>
                                @if ($errors->has('accomodation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('accomodation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventPrepaid') }}</label>
                                <select class="form-control" name="prepaid" id="prepaid" required="required">
                                    <option value="0"
                                        @if(old('prepaid') == 0)
                                            selected="selected"
                                        @endif
                                    >{{ trans('panel.no') }}</option>
                                    <option value="1"
                                        @if(old('prepaid') == 1)
                                            selected="selected"
                                        @endif
                                    >{{ trans('panel.yes') }}</option>
                                </select>
                                @if ($errors->has('prepaid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prepaid') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ trans('panel.eventUserImage') }}</label>
                                <select class="form-control" name="userimage" id="userimage" required="required">
                                    <option value="0"
                                        @if(old('userimage') == 0)
                                            selected="selected"
                                        @endif
                                    >{{ trans('panel.no') }}</option>
                                    <option value="1"
                                        @if(old('userimage') == 1)
                                            selected="selected"
                                        @endif
                                    >{{ trans('panel.yes') }}</option>
                                </select>
                                @if ($errors->has('userimage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('userimage') }}</strong>
                                    </span>
                                @endif
                            </div>

							<div class="form-group">
								<label>{{ trans('panel.eventCodeLength') }}</label>
								<input id="code_length" type="number" class="form-control" name="code_length" value="{{ old('code_length') }}">
								@if ($errors->has('code_length'))
									<span class="help-block">
										<strong>{{ $errors->first('code_length') }}</strong>
									</span>
								@endif
							</div>

						</div>

                        <div class="panel-footer">
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
