@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('panel.events') }}
        <small>{{ trans('panel.admin') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
            <div class="box box-success box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.editEvent') }}</h3>
                </div>
                <form role="form" method="POST" action="{{ url('/events/'.$event->id) }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ trans('panel.eventName') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $event->name }}">
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
                            <textarea id="description" class="form-control" name="description">{{ $event->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.eventOrg') }}</label>
                            <select class="form-control" name="org" id="org" required="required" disabled="disabled">
                                <option value="{{ $org->id }}" selected="selected">{{ $org->id }} – {{ $org->name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.eventImage') }}</label>
                            <input id="image" type="text" class="form-control" name="image" value="{{ $event->image }}">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.eventWebsite') }}</label>
                            <input id="website" type="text" class="form-control" name="website" value="{{ $event->website  }}">
                            @if ($errors->has('website'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.eventContact') }}</label>
                            <input id="contact" type="text" class="form-control" name="contact" value="{{ $event->contact }}">
                            @if ($errors->has('contact'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.eventStart') }}</label>
                            <input id="start" type="text" class="form-control" name="start" value="{{ $event->start }}">
                            @if ($errors->has('start'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('start') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.eventFinish') }}</label>
                            <input id="finish" type="text" class="form-control" name="finish" value="{{ $event->finish }}">
                            @if ($errors->has('finish'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('finish') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.eventCity') }}</label>
                            <input id="city" type="text" class="form-control" name="city" value="{{ $event->city }}">
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ trans('panel.eventAddress') }}</label>
                            <input id="address" type="text" class="form-control" name="address" value="{{ $event->address }}">
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
                                    @if($event->accomodation == 0)
                                        selected="selected"
                                    @endif
                                >{{ trans('panel.no') }}</option>
                                <option value="1"
                                    @if($event->accomodation == 1)
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
                                    @if($event->prepaid == 0)
                                        selected="selected"
                                    @endif
                                >{{ trans('panel.no') }}</option>
                                <option value="1"
                                    @if($event->prepaid == 1)
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
                                    @if($event->userimage == 0)
                                        selected="selected"
                                    @endif
                                >{{ trans('panel.no') }}</option>
                                <option value="1"
                                    @if($event->userimage == 1)
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
                            <input id="code_length" type="number" class="form-control" name="code_length" value="{{ $event->code_length }}">
                            @if ($errors->has('code_length'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code_length') }}</strong>
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
                            <a href="{{ URL('/events/delete/'.$event->id) }}" class="btn btn-danger" style="color:white">
                                {{ trans('panel.eventDelete') }}
                            </a>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </section>
@endsection
