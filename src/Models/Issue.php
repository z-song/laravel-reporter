<?php

namespace Encore\Reporter\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'laravel_issues';

    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('reporter.database.connection'));

        parent::__construct($attributes);
    }

    public function exceptions()
    {
        return $this->hasMany(Exception::class, 'name');
    }
}
