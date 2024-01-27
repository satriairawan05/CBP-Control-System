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

    protected $table = 'projects';

    protected $primaryKey = 'id';

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
