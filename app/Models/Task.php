<?php

namespace App\Models;

use App\Models\Report;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $primaryKey = 'id';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
