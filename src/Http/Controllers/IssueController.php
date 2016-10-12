<?php

namespace Encore\Reporter\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class IssueController extends BaseController
{
    public function index()
    {
        return view('reporter::issue-list');
    }
}
