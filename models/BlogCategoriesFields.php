<?php

namespace JanVince\SmallExtensions\Models;

use Model;

class BlogCategoriesFields extends Model
{

    protected $primaryKey = 'id';

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = [
        'note',
    ];

    public $table = 'janvince_smallextensions_blogcategoriesfields';

    public $timestamps = true;

    protected $guarded = ['*'];

    public $belongsTo = [
        'category' => ['RainLab\Blog\Models\Category', 'key' => 'category_id', 'otherKey' => 'id'],
    ];

}
