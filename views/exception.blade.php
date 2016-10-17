@extends('reporter::container')

@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-9">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title"><strong>Request</strong></h3>
                        <div class="box-tools pull-right">
                            <ul class="pagination pagination-sm inline">
                                <li><a href="#">«</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <dl class="dl-horizontal parameter">
                            @if($exception->method)
                                <dt><div class="name">method</div></dt>
                                <dd><div class="value">{{ $exception->method }}</div></dd>
                            @endif

                            @if($exception->uri)
                                <dt><div class="name">url</div></dt>
                                <dd><div class="value">{{ $exception->uri }}</div></dd>
                            @endif

                            @if($exception->query)
                                <dt><div class="name">query</div></dt>
                                <dd><div class="value">{{ $exception->query}}</div></dd>
                            @endif

                            @if($exception->body)
                                <dt><div class="name">body</div></dt>
                                <dd><div class="value">{{ $exception->body }}</div></dd>
                            @endif
                        </dl>

                        <hr>

                        <dl class="dl-horizontal parameter">
                            <dt><div class="name">time</div></dt>
                            <dd><div class="value">{{ $exception->created_at }}</div></dd>
                            <dt><div class="name">client ip</div></dt>
                            <dd><div class="value">{{ $exception->ip }}</div></dd>
                        </dl>

                    </div>
                </div>


                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title"><strong><a href="/{{ config('reporter.base_uri') }}/exceptions?type={{ $exception->type }}">{{ $exception->type }}</a></strong></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        @if ($exception->code || $exception->message)
                        <dl class="dl-horizontal parameter">
                            @if ($exception->code)
                                <dt><div class="name">code</div></dt>
                                <dd><div class="value">{{ $exception->code }}</div></dd>
                            @endif

                            @if ($exception->message)
                                <dt><div class="name">message</div></dt>
                                <dd><div class="value">{{ $exception->message }}</div></dd>
                            @endif
                        </dl>
                        @endif

                        <ul class="todo-list">

                            @foreach($frames as $index => $frame)
                            <li>
                                <!-- drag handle -->
                              <span class="handle">
                                <i class="fa fa-info"></i>
                              </span>

                                @if (empty($frame->file()))
                                    <span class="text">
                                        {{ $frame->name() }}
                                    </span>
                                @else
                                    <span class="text" data-toggle="collapse" data-target="#frame-{{ $index }}">
                                        <a href="javascript:void(0);">{{ str_replace(base_path() . '/', '', $frame->file()) }}</a>
                                        in <a href="javascript:void(0);">{{ $frame->method() }}</a> at line <span class="badge bg-light-blue">{{ $frame->line() }}</span>
                                    </span>

                                    <div class="collapse {{ $index == 0 ? 'in' : '' }}" id="frame-{{ $index }}">
                                        <pre class="prettyprint lang-php linenums:{!! $frame->getCodeBlock()->getStartLine() !!}"
                                             data-start-line="{!! $frame->getCodeBlock()->getStartLine() !!}"
                                             data-active="{{ $frame->line() }}">{!! $frame->getCodeBlock()->output() !!}</pre>

                                        <table class="table args" style="background-color: #FFFFFF; margin: 10px 0px 0px 0px;">
                                            <tbody>
                                            @foreach($frame->args() as $name => $val)
                                            <tr>
                                                <td class="name"><strong>{{ $name }}</strong></td>
                                                <td class="value">{{ $val }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                @endif

                            </li>
                            @endforeach

                        </ul>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix no-border">
                        <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                    </div>
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-server"></i>
                        <h3 class="box-title"><strong>Headers</strong></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal parameter">
                            @foreach($headers as $name => $values)
                            <dt><div class="name">{{ $name }}</div></dt>
                                @foreach($values as $value)
                                <dd><div class="value">{{ $value }}</div></dd>
                                @endforeach
                            @endforeach
                        </dl>
                    </div><!-- /.box-body -->
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-database"></i>
                        <h3 class="box-title"><strong>Cookies</strong></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal parameter">
                            @foreach($cookies as $name => $value)
                                <dt><div class="name">{{ $name }}</div></dt>
                                <dd><div class="value">{{ $value }}</div></dd>
                            @endforeach
                        </dl>
                    </div><!-- /.box-body -->
                </div>
            </div>

            <div class="col-md-3">
                <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right">12</span></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                            <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                            <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-waring pull-right">65</span></a></li>
                            <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                        </ul>
                    </div><!-- /.box-body -->
                </div><!-- /. box -->
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Labels</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                        </ul>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>

        <script data-exec-on-popstate>
            $(function () {

                PR.prettyPrint();

                var highlightLine = function () {
                    $('pre.prettyprint').each(function (index, pre) {
                        var active_line = $(pre).data('active');
                        var start_line = $(pre).data('start-line');

                        var $active = $(pre).find('li:eq('+ (active_line-start_line) +')').addClass('active');
                    });
                };

                setTimeout(function () {
                    highlightLine();
                }, 100);
            });
        </script>

    </section>
@endsection