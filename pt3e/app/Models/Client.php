<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;
    public function nomCognoms():string{
        return $this->nom . ' ' . $this->cognoms;
    }

    protected $casts = [
        'dataN' => 'datetime:Y-m-d',
    ];

    public function comptes(): HasMany
    {
        return $this->hasMany(Compte::class);
    }

}
