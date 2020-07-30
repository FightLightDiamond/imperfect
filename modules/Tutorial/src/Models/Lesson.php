<?php

namespace Tutorial\Models;


use ACL\Models\Admin;
use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Lesson extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'lessons';
    public $fillable = [
        'title',
        'intro',
        'content',
        'section_id',
        'views',
        'last_view',
        'publish_time',
        'created_by',
        'updated_by',
        'status',
        'no',
        'feature_image',
        'images',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tests()
    {
        return $this->hasMany(LessonTest::class, 'lesson_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LessonResult::class, 'lesson_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    /**
     * @var array
     */
    public $fileUpload = ['feature_image' => 1];

    /**
     * @var array
     */
    protected $pathUpload = ['feature_image' => '/feature_images/lessons'];

    /**
     * @var array
     */
    protected $thumbImage = [
        'feature_image' => [
            '/thumbs/' => [
                [200, null], [300, null], [400, null]
            ]
        ]
    ];

    public function getFeatureImageAttribute($value)
    {
        return config("filesystems.disks.public.url") . $value;
    }
}

