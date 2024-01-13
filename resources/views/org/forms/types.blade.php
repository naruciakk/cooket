@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1>
        {{ trans('org.formTypes') }}
        <small>{{ trans('org.orgpanel') }}</small>
      </h1>
    </section>

    <section class="content container-fluid">
        <div class="callout callout-danger">
            <p>{{ trans('org.descFormTypes') }}</p>
        </div>

            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('panel.list') }}</h3>
                </div>
                <div class="box-body">
                            <table width="100%" class="table table-striped table-bordered table-hover table-nice" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('org.formType') }}</th>
                                        <th>{{ trans('org.formEnd') }}</th>
                                        <th>{{ trans('org.formCreated') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $it = 0;
                                    @endphp

                                    @foreach($formTypes as $type)
                                        <tr>
                                            <td>{{ ++$it }}</td>
                                            <td><a href="/forms/{{ $type->id }}">{{ $type->type }}</a></td>
                                            <td>{{ $type->end }}</td>
                                            <td>{{ $type->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                </div>
            </div>

</section>
@endsection