<?php

namespace English\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use ModelsTrait;
    public $table = 'vocabularies';
    public $fillable = ['word', 'type', 'pronounce', 'meaning', 'image', 'description', 'is_active'];

    public function getImageAttribute($value)
    {
        return url('storage' . $value);
    }

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/vocabulary'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [50, 50], [200, null], [300, null], [400, null]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

