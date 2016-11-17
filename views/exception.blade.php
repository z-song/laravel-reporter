@extends('reporter::container')

@section('content')
    <section class="content">


        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-paper-plane">&nbsp;&nbsp;</i><strong>Request</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">

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
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fa fa-server">&nbsp;&nbsp;</i><strong>Headers</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">

                        <dl class="dl-horizontal parameter">
                            @foreach($headers as $name => $values)
                                <dt><div class="name">{{ $name }}</div></dt>
                                @foreach($values as $value)
                                    <dd><div class="value">{{ $value }}</div></dd>
                                @endforeach
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fa fa-database"></i>&nbsp;&nbsp;<strong>Cookies</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">

                        <dl class="dl-horizontal parameter">
                            @foreach($cookies as $name => $value)
                                <dt><div class="name">{{ $name }}</div></dt>
                                <dd><div class="value">{{ $value }}</div></dd>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
        </div>


        <div class="browser-window">
            <div class="top-bar">
                <div class="circles pull-left">
                    <div class="circle circle-red"></div>
                    <div class="circle circle-yellow"></div>
                    <div class="circle circle-green"></div>
                </div>
                <div style="margin: 3px 0px 0px 200px;">
                    <i class="fa fa-file-code-o" style="color: #4c748c;"></i>&nbsp;
                    <strong>Trace</strong>
                </div>
            </div>

            @if ($exception->code || $exception->message)
            <table class="table args" style="background-color: #fcf8e3; margin: 0px;">
                <tbody>
                    <tr>

                        <td style="width: 40px;">&nbsp;</td>
                        <td class="name"><strong>exception</strong></td>
                        <td class="value"><a href="/{{ config('reporter.base_uri') }}/exceptions?type={{ $exception->type }}">{{ $exception->type }}</a></td>
                    </tr>
                    <tr>
                        @if ($exception->code)
                        <td style="width: 40px;">&nbsp;</td>
                        <td class="name"><strong>code</strong></td>
                        <td class="value">{{ $exception->code }}</td>
                        @endif

                        @if ($exception->message)
                            <td style="width: 40px;">&nbsp;</td>
                            <td class="name"><strong>message</strong></td>
                            <td class="value">{{ $exception->message }}</td>
                        @endif
                    </tr>
                </tbody>
            </table>
            @endif

            @foreach($frames as $index => $frame)
                <div data-toggle="collapse" data-target="#frame-{{ $index }}" style="border-top: 2px #fff solid;padding: 10px 0px 10px 20px; background-color: #f3f3f3">
                    <i class="fa fa-info" style="color: #4c748c;"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0);">{{ str_replace(base_path() . '/', '', $frame->file()) }}</a>
                    in <a href="javascript:void(0);">{{ $frame->method() }}</a> at line <span class="badge badge-info">{{ $frame->line() }}</span>
                </div>
                <div class="window-content collapse {{ $index == 0 ? 'in' : '' }}" id="frame-{{ $index }}">
                    <pre data-start="{!! $frame->getCodeBlock()->getStartLine() !!}" data-line="{{ $frame->line()-$frame->getCodeBlock()->getStartLine()+1 }}" class="language-php line-numbers"><code>{!! $frame->getCodeBlock()->output() !!}</code></pre>
                    <table class="table args" style="background-color: #FFFFFF; margin: 10px 0px 0px 0px;">
                        <tbody>
                        @foreach($frame->args() as $name => $val)
                            <tr>
                                <td style="width: 40px;">&nbsp;</td>
                                <td class="name"><strong>{{ $name }}</strong></td>
                                <td class="value">{{ $val }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @endforeach

        </div>

        <script data-exec-on-popstate>
            $(function () {
                Prism.highlightAll();
            });
        </script>

    </section>
@endsection