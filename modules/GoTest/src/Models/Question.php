<?php

namespace GoTest\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Question extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    const TRUE_FALSE_TYPE = 1;
    const MULTI_CHOICE_TYPE = 2;
    const MULTI_ANSWER_TYPE = 3;
    const QUESTION_TYPES = [self::TRUE_FALSE_TYPE, self::MULTI_CHOICE_TYPE, self::MULTI_ANSWER_TYPE];

    public $table = 'questions';
    public $fillable = [
        'type', 'question', 'answer',
        'status', 'time', 'level', 'replies',
        'created_by', 'updated_by'
    ];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/questions'];

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

