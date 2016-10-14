<?php

namespace Encore\Reporter\Http\Controllers;

use Encore\Reporter\Models\Exception;
use Encore\Reporter\Trace\Parser;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class ExceptionController extends BaseController
{
    public function index()
    {
        $exceptions = Exception::orderBy('id', 'desc')->paginate();

        $methodColor = Exception::$methodColor;

        $types = Exception::groupBy('name')->selectRaw('count(id) as count, name')
            ->get();

        return view('reporter::list', compact('exceptions', 'methodColor', 'types'));
    }

    public function show($id)
    {
        $exception = Exception::findOrFail($id);

        $trace = "#0 {$exception->file}({$exception->line})\n";

        $frames = (new Parser($trace.$exception->trace))->parse();

        $cookies = json_decode($exception->cookies, true);
        $headers = json_decode($exception->headers, true);

        return view('reporter::exception', compact('exception', 'frames', 'cookies', 'headers'));
    }
}
