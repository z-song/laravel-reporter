<?php

namespace Encore\Reporter\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class IssueController extends BaseController
{
    public function index()
    {
        try {
            try {
                throw new \Exception();
            } catch (\Exception $e) {
                throw $e;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
