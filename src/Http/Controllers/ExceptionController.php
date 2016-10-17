<?php

namespace Encore\Reporter\Http\Controllers;

use Encore\Reporter\Models\Exception;
use Encore\Reporter\Trace\Parser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class ExceptionController extends BaseController
{
    public function issues()
    {
        $paginator = Exception::getIssues()->paginate();

        $models = Exception::hydrate($paginator->items());

        $paginator->setCollection($models);

        $methodColor = Exception::$methodColor;

        return view('reporter::issues', compact('paginator', 'methodColor'));
    }

    public function index(Request $request)
    {
        $query = Exception::query();

        if ($request->has('type')) {
            $query->where('type', $request->get('type'));
        }

        $exceptions = $query->orderBy('id', 'desc')->paginate()->appends($request->all());

        $methodColor = Exception::$methodColor;

        $type = $request->get('type');

        return view('reporter::list', compact('exceptions', 'methodColor', 'type'));
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
