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

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Scope a query to only include tasks with the status "Done".
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDone($query)
    {
        return $query->where('status', 'Done');
    }

    /**
     * Get the project associated with the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the reports associated with the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
