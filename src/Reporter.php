<?php

namespace Encore\Reporter;

use Encore\Reporter\Models\Exception as ExceptionModel;
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
     * @var Request
     */
    protected $request;

    /**
     * @var Exception
     */
    protected static $exception;

    /**
     * Create a new Reporter instance.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    /**
     * Report exceptions.
     *
     * @param Exception $exception
     * @return bool
     */
    public function reportException(Exception $exception)
    {
        static::$exception = $exception;

        $this->request = $this->app['request'];

        $data = [
            // Request info.
            'method'    => $this->request->getMethod(),
            'ip'        => $this->request->getClientIps(),
            'uri'       => $this->request->getUri(),
            'query'     => $this->request->getQueryString(),
            'body'      => $this->request->getContent(),
            'cookies'   => $this->request->cookies->all(),
            'headers'   => array_except($this->request->headers->all(), 'cookie'),

            // Exception info.
            'exception' => get_class($exception),
            'code'      => $exception->getCode(),
            'file'      => $exception->getFile(),
            'line'      => $exception->getLine(),
            'message'   => $exception->getMessage(),
            'trace'     => $exception->getTraceAsString(),
        ];

        $data = $this->stringify($data);

        try {
            $result = $this->store($data);
        } catch (Exception $e) {
            $result = $this->reportException($e);
        }


        return $result;
    }

    /**
     * Convert all items to string.
     *
     * @param $data
     * @return array
     */
    public function stringify($data)
    {
        return array_map(function ($item) {
            return is_array($item) ? json_encode($item) : (string) $item;
        }, $data);
    }

    /**
     * Store exception info to db.
     *
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        $exception = new ExceptionModel();

        $exception->name    = $data['exception'];
        $exception->code    = $data['code'];
        $exception->message = $data['message'];
        $exception->file    = $data['file'];
        $exception->line    = $data['line'];
        $exception->trace   = $data['trace'];

        $exception->method  = $data['method'];
        $exception->uri     = $data['uri'];
        $exception->query   = $data['query'];
        $exception->body    = $data['body'];
        $exception->cookies = $data['cookies'];
        $exception->headers = $data['headers'];

        return $exception->save();
    }
}
