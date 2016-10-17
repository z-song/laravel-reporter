<?php

namespace Encore\Reporter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        DB::select(DB::raw("SET sql_mode = ''"));

        $this->setConnection(config('reporter.database.connection'));
        $this->setTable(config('reporter.database.exception_table'));

        parent::__construct($attributes);
    }

    public static function getIssues()
    {
        DB::select(DB::raw("SET sql_mode = ''"));

        $table = config('reporter.database.exception_table');

        return DB::table($table)
            ->selectRaw('*,count(1) as count')
            ->from(DB::raw("(select * from `$table` order by id desc) AS tb"))
            ->groupBy('type')->orderBy('id', 'desc');
    }

    public function showDetail()
    {
        return $this->message;
    }
}
