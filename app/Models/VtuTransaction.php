<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VtuTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "service",
        "profit",
        "type",
        "sub_type",
        "amount",
        "amount_debited",
        "number",
        "response",
        "discount",
        "upline_percentage",
        "upline_generations",
        "order_id",
        "approved",
        "refunded",
        "date",
        "time",
    ];
}
