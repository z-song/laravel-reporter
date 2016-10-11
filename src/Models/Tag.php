<?php

namespace Encore\Reporter\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'laravel_exception_tags';

    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('reporter.database.connection'));

        parent::__construct($attributes);
    }

    public function exceptions()
    {
        return $this->belongsToMany(Exception::class, 'laravel_exceptions_to_tags', 'tag_id', 'exception_id');
    }
}
