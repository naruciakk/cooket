<p class="text-warning">{{ trans('panel.warningSettings') }}</p>
<form role="form" method="POST" action="{{ url('/home') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('given_name') ? ' has-error' : '' }}">
        <label for="given_name" class="control-label">{{ trans('auth.given_name') }}</label>
        <input type="text" class="form-control" id="given_name" name="given_name" value="{{ $user->given_name }}">
        @if ($errors->has('given_name'))
            <span class="help-block">
                <strong>{{ $errors->first('given_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('family_name') ? ' has-error' : '' }}">
        <label for="family_name" class="control-label">{{ trans('auth.family_name') }}</label>
        <input type="text" class="form-control" id="family_name" name="family_name" value="{{ $user->family_name }}">
        @if ($errors->has('family_name'))
            <span class="help-block">
                <strong>{{ $errors->first('family_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
        <label for="name" class="control-label">{{ trans('auth.nickname') }}</label>
        <input type="text" class="form-control" id="nickname" name="nickname" value="{{ $user->nickname }}">
        @if ($errors->has('nickname'))
            <span class="help-block">
                <strong>{{ $errors->first('nickname') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
        <label for="city" class="control-label">{{ trans('auth.city') }}</label>
        <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}">
        @if ($errors->has('city'))
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
    </div>
    <button type="submit" class="btn btn-default">{{ trans('panel.send') }}</button>
</form>