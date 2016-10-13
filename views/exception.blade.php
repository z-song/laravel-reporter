@extends('reporter::container')

@section('content')
    <section class="content">

        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Exception Trace</h3>
                <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                        <li><a href="#">«</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="todo-list">

                    @foreach($frames as $index => $frame)
                    <li>
                        <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-info"></i>
                      </span>

                        <!-- todo text -->

                        @if (empty($frame->file()))
                            <span class="text" data-toggle="collapse" href="#frame-{{ $index }}" aria-expanded="false" aria-controls="frame-{{ $index }}">{{ $frame->name() }}</span>
                        @else
                            <span class="text" data-toggle="collapse" href="#frame-{{ $index }}" aria-expanded="false" aria-controls="frame-{{ $index }}">
                                <a href="#">{{ str_replace(base_path() . '/', '', $frame->file()) }}</a>
                                in <a href="#">{{ $frame->method() }}</a> at line <span class="badge bg-light-blue">{{ $frame->line() }}</span>
                            </span>
                            <!-- Emphasis label -->

                            <div class="{{ $index != 0 ? 'collapse' : '' }}" id="frame-{{ $index }}">
                                <pre class="prettyprint lang-php linenums:{!! $frame->getCodeBlock()->getStartLine() !!}" data-start-line="{!! $frame->getCodeBlock()->getStartLine() !!}" data-active="{{ $frame->line() }}">{!! $frame->getCodeBlock()->output() !!}</pre>
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

    </section>
@endsection