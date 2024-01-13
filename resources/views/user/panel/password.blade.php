<p class="text-info">{{ trans('panel.changePasswordDescription') }}</p>
<form role="form" method="POST" action="{{ url('/home/password') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
        <label for="oldPassword" class="control-label">{{ trans('panel.oldPassword') }}</label>
        <input type="password" class="form-control" id="oldPassword" name="oldPassword">
        @if ($errors->has('oldPassword'))
            <span class="help-block">
                <strong>{{ $errors->first('oldPassword') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="control-label">{{ trans('panel.password') }}</label>
        <input type="password" class="form-control" id="password" name="password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="control-label">{{ trans('panel.passwordConfirmation') }}</label>
        <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
    <button type="submit" class="btn btn-default">{{ trans('panel.send') }}</button>
</form>