<?php

namespace Encore\Reporter\Models;

use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{
    protected $table = 'laravel_exceptions';

    public static $methodColor = [
        'GET'       => 'green',
        'POST'      => 'yellow',
        'PUT'       => 'blue',
        'DELETE'    => 'red',
        'PATCH'     => 'black',
        'OPTIONS'   => 'grey',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('reporter.database.connection'));

        parent::__construct($attributes);
    }
}
