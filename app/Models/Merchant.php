<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;

class Merchant extends Model
{
    use HasFactory;

    /**
     * Get the Outlest for the merchant.
     */
    public function outlets()
    {
        return $this->hasMany(Outlets::class);
    }

    /**
     * Get the Transactions for the merchant.
     */
    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }

    /**
     * Get the Merchant from user_id.
     */
    public function getMerchantFromUserid(): Merchant
    {
        $model = Merchant::where('user_id', JWTAuth::user()->id)
            ->first();
        return $model ?? new Merchant();
    }
}
