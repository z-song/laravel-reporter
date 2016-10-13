<?php

namespace Encore\Reporter\Http\Controllers;

use Encore\Reporter\Models\Exception;
use Encore\Reporter\Trace\Parser;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class IssueController extends BaseController
{
    public function index()
    {
        $func = function ($arg) {

            Arr::only();

            //throw new \InvalidArgumentException($arg);
        };

        try {
            $func('error.....');
        } catch (\Exception $e) {
            $trace = $e->getTraceAsString();
        }

        return $trace;
    }

    public function show($id)
    {
        $exception = Exception::findOrFail($id);

        $frames = (new Parser($exception->trace))->parse();

        return view('reporter::exception', compact('frames'));
    }
}
