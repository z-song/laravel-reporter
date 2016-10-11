<?php

namespace Encore\Reporter\Models;

use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{
    protected $table = 'laravel_exceptions';

    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('reporter.database.connection'));

        parent::__construct($attributes);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'laravel_exceptions_to_tags', 'exception_id', 'tag_id');
    }
}
