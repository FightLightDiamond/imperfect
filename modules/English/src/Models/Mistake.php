<?php

namespace English\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Mistake extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'mistakes';
    public $fillable = ['question', 'a', 'b', 'c', 'd', 'answer', 'repair', 'is_active'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/mistakes'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, null], [300, null], [400, null]
            ]
        ]
    ];

    protected $checkbox = ['is_active'];
}

