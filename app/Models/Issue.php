<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Issue extends Model
{
    protected $fillable = [
        'project',
        'issue_description',
        'assigned_to',
        'attachment',
        'status',
        'complete',
    ];
    protected $casts = [
        'billable' => 'boolean',
    ];

    public static function whereDate(string $string, \Illuminate\Support\Carbon $today)
    {
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
