<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'id',
        'project_name',
        'project_description',
        'active',

    ];
    protected $casts = [
        'active' => 'boolean',
    ];
}
