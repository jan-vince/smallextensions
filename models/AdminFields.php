<?php

namespace JanVince\SmallExtensions\Models;

use Model;

class AdminFields extends Model
{

    protected $primaryKey = 'id';

    public $table = 'janvince_smallextensions_adminfields';

    public $timestamps = true;

    protected $guarded = ['*'];

    protected $jsonable = [];

    public $belongsTo = [
        'backend_user' => ['Backend\Models\User', 'key' => 'id', 'otherKey' => 'backend_user_id'],
    ];

}
