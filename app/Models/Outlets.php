<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlets extends Model
{
    use HasFactory;

    /**
     * Get the Transactions for the merchant.
     */
    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }
}
