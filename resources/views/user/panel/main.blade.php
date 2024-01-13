@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ trans('panel.userpanel') }}
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="col-md-12">
          <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#data">
                        {{ trans('panel.summary') }}
                      </a>
                    </h4>
                  </div>
                  <div id="data" class="panel-collapse collapse in">
                    <div class="box-body">
                        <dl>
                            <dt>{{ trans('auth.name') }}</dt>
                            <dd>{{ $user->given_name }}&nbsp;{{ $user->family_name }}</dd>
                        </dl>
                        <dl>
                            <dt>{{ trans('auth.nickname') }}</dt>
                            <dd>{{ $user->nickname }}</dd>
                        </dl>
                        <dl>
                            <dt>{{ trans('auth.city') }}</dt>
                            <dd>{{ $user->city }}</dd>
                        </dl>
                        <dl>
                            <dt>{{ trans('auth.email') }}</dt>
                            <dd>{{ $user->email }}</dd>
                        </dl>
                    </div>
                  </div>
                </div>
                <div class="panel box box-warning">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#modify">
                        {{ trans('panel.settings') }}
                      </a>
                    </h4>
                  </div>
                  <div id="modify" class="panel-collapse collapse">
                    <div class="box-body">
                        @include('user.panel.settings', compact('user', $user))
                    </div>
                  </div>
                </div>

                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#password">
                        {{ trans('panel.changePassword') }}
                      </a>
                    </h4>
                  </div>
                  <div id="password" class="panel-collapse collapse">
                    <div class="box-body">
                      @include('user.panel.password')
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
@endsection
