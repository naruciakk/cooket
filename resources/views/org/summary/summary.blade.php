@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.summary') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">

            <div class="col-md-4">
                <div class="info-box bg-blue">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('org.signing') }}</span>
                        <span class="info-box-number">{{ $signing }}</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: {{ round(($signing/$guests) * 100) }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round(($signing/$guests) * 100) }}% {{ trans('org.ofTotalGuests') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
