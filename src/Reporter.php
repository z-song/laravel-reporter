<?php

namespace Encore\Reporter;

use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class Reporter
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Exception
     */
    protected static $exception;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    /**
     * @param Exception $exception
     */
    public function reportException(Exception $exception)
    {
        static::$exception = $exception;

        $this->request = $this->app['request'];

        $data = [
            'method'    => $this->request->getMethod(),
            'ip'        => $this->request->getClientIps(),
            'uri'       => $this->request->getUri(),
            'query'     => $this->request->getQueryString(),
            'body'      => $this->request->getContent(),
            'cookies'   => $this->request->cookies->all(),
            'headers'   => $this->request->headers->all(),

            'exception' => get_class($exception),
            'code'      => $exception->getCode(),
            'file'      => $exception->getFile(),
            'line'      => $exception->getLine(),
            'message'   => $exception->getMessage(),
            'trace'     => $exception->getTraceAsString(),
        ];

        $data = $this->sanitize($data);

        return $this->store($data);
    }

    public function sanitize($data)
    {
        return $data;
    }

    public function store($data)
    {
        return $data;
    }
}
