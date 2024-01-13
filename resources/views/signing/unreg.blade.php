<p class="lead text-justify">{!! trans('page.loginregister') !!}</p>
<p class="section-paragraph text-justify">{{ trans('page.logindescr') }}</p>
<p class="lead text-justify">{!! trans('page.noregister') !!}</p>
<p class="section-paragraph text-justify">{{ trans('page.noregisterdescr') }}</p>
<form role="form" method="POST" action="/guest/{{ $event->slug }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	@include('signing.unregistered')
</form>
