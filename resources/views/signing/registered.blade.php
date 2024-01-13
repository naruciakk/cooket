                    <form action="/{{ $event->slug }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="adult">{{ trans('page.adult') }}</label>
                            <select type="text" class="form-control" id="adult" name="adult">
                                @if(old('adult'))
                                    <option value="0">{{ trans('panel.no') }}</option>
                                    <option value="1" selected="selected">{{ trans('panel.yes') }}</option>
                                @else
                                    <option value="0" selected="selected">{{ trans('panel.no') }}</option>
                                    <option value="1">{{ trans('panel.yes') }}</option>
                                @endif
                            </select>

                            @if ($errors->has('adult'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('adult') }}</strong>
                                </span>
                            @endif
                        </div>
                        @if($event->accomodation)
                            <div class="form-group">
                                <label for="accomodation">{{ trans('page.accomodation') }}</label>
                                <select type="text" class="form-control" id="accomodation" name="accomodation">
                                    @if(old('accomodation'))
                                        <option value="0">{{ trans('panel.no') }}</option>
                                        <option value="1" selected="selected">{{ trans('panel.yes') }}</option>
                                    @else
                                        <option value="0" selected="selected">{{ trans('panel.no') }}</option>
                                        <option value="1">{{ trans('panel.yes') }}</option>
                                    @endif
                                </select>

                            @if ($errors->has('accomodation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('accomodation') }}</strong>
                                </span>
                            @endif
                            </div>
                        @endif
                        @if($event->userimage)
                            <div class="form-group">
                                <label for="accomodation">{{ trans('panel.eventUserImage') }} ({{trans('page.not_required') }})</label>
                                <input type="file" class="form-control-file" id="userimage" name="userimage" />

                            @if ($errors->has('userimage'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('userimage') }}</strong>
                                </span>
                            @endif
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="annotation">{{ trans('page.additional') }}</label>
                            <textarea class="form-control" id="annotation" name="annotation">{{ old('annotation') }}</textarea>

                            @if ($errors->has('annotation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('annotation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <h1 class="lead section-lead text-justify">{{ trans('page.ticket') }}</h1>
                        <ul class="list-group">
							{!! \App\Support\GiveTickets::getTickets($event->id, false) !!}
																												
							@if ($errors->has('ticket'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ticket') }}</strong>
                                </span>
                            @endif
                        </ul>
                        <h1 class="lead section-lead text-justify">{{ trans('page.end') }}</h1>
						<p class="section-paragraph text-justify">
							<input type="checkbox" name="consent" />&nbsp;{{ trans('page.disclaimer') }}&nbsp;<span style="color: red">{{ trans('page.disclaimer2') }}</span>

						@if ($errors->has('consent'))
							<span class="help-block">
								<strong>{{ $errors->first('consent') }}</strong>
							</span>
						@endif

						<br /><br />{!! trans('main.proceed') !!}</p>
                        <button type="submit" class="btn btn-default bg-blue">{{ trans('panel.send') }}</button>
                    </form>
