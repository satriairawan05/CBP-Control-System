<?php

namespace App\Models;

use App\Models\User;
use App\Models\ContractDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contracts';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Get the project associated with the contract.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Mendefinisikan relasi dengan ContractDetail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contractDetails(): HasMany
    {
        return $this->hasMany(ContractDetail::class);
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
