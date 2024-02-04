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
     * Mendefinisikan relasi antara kontrak dan pihak pertama (first party).
     * Setiap kontrak dimiliki oleh satu entitas pengguna sebagai pihak pertama.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firstParty()
    {
        return $this->belongsTo(User::class, 'first');
    }

    /**
     * Mendefinisikan relasi antara kontrak dan pihak kedua (second party).
     * Setiap kontrak dimiliki oleh satu entitas pengguna sebagai pihak kedua.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function secondParty()
    {
        return $this->belongsTo(User::class, 'second');
    }
}
