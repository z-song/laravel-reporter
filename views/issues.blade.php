@extends('reporter::container')

@section('content')

<section class="content">

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Exceptions</b></h3>
                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" placeholder="Search Exception">
                            <span class="fa fa-search form-control-feedback"></span>
                        </div>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                            <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                            <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                        </div><!-- /.btn-group -->
                        <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                        <div class="pull-right">
                            {{ $paginator->render('reporter::pagination') }}
                        </div><!-- /.pull-right -->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <tbody>
                            @foreach($paginator as $exception)
                            <tr>
                                <td><input type="checkbox"/></td>
                                <td><a href="/{{ config('reporter.base_uri') }}/exceptions?type={{ $exception->type }}">{{ $exception->type }}</a><br>{{ $exception->showDetail() }}</td>
                                <td><a href="/{{ config('reporter.base_uri') }}/exceptions?type={{ $exception->type }}"><span class="label label-primary">{{ $exception->count }}</span></a></td>
                                <td><span class="badge bg-{{ array_get($methodColor, $exception->method, 'black') }}">{{ $exception->method }}</span></td>
                                <td>{{ $exception->uri }}</td>
                                <td></td>
                                <td>{{ $exception->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table><!-- /.table -->
                    </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                            <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                            <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                        </div><!-- /.btn-group -->
                        <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                        <div class="pull-right">
                            {{ $paginator->render('reporter::pagination') }}
                        </div><!-- /.pull-right -->
                    </div>
                </div>
            </div><!-- /. box -->

</section>
@endsection