<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
     * Define the relationship between a contract and the first party.
     * Each contract is owned by one user entity as the first party.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firstParty(): BelongsTo
    {
        return $this->belongsTo(User::class, 'first');
    }

    /**
     * Define the relationship between a contract and the second party.
     * Each contract is owned by one user entity as the second party.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function secondParty(): BelongsTo
    {
        return $this->belongsTo(User::class, 'second');
    }
}
