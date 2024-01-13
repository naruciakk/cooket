@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.forms') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-danger">
            <p>{{ trans('org.descForms') }}</p>
        </div>

            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">{{ $type->type }}</h3>
                </div>
                <div class="box-body">
                            <table width="100%" class="table table-striped table-bordered table-hover table-nice" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('org.guest') }}</th>
                                        <th>{{ trans('org.form') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $it = 0;
                                    @endphp

                                    @foreach($forms as $form)
                                        @foreach($guests as $guest)
                                            @if($form->ticket == $guest->id)
                                                <tr>
                                                    <td>{{ ++$it }}</td>
                                                    <td><a href="/guests/{{ $guest->id }}">{{ \App\Support\FormHelper::getName($guest->id) }}</a></td>
                                                    <td><a href="/forms/{{ $type->id }}/{{ $form->id }}">{{ \App\Support\FormHelper::getInfo($form->id) }}</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                </div>
            </div>

</section>
@endsection
