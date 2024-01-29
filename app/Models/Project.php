<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

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
     * Get the tasks associated with the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the reports associated with the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
