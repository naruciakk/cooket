    <div id="accordion" class="panel-group">

        @if($bought == 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title showing">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">{{ trans('page.register_myself') }}</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse show">
                    <div class="panel-body">
                        <p class="lead section-lead text-justify">{{ trans('page.registered') }}</p>
                        <p class="section-paragraph text-justify">{{ trans('page.registered_desc') }}</p>
                        @include('signing.registered')
                    </div>
                </div>
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title showing">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">{{ trans('page.register_someone') }}</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse
                @if($bought > 0)
                    show
                @endif
            ">
                <div class="panel-body">
                    <p class="lead section-lead text-justify">{{ trans('page.register_new') }}</p>
                    <form role="form" method="POST" action="/guest/{{ $event->slug }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('signing.unregistered')
                    </form>
                </div>
            </div>
        </div>

    </div>
