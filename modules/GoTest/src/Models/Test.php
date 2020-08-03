<?php

namespace GoTest\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Test extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'tests';
    public $fillable = ['title', 'description', 'time', 'status', 'created_by', 'updated_by'];
}

