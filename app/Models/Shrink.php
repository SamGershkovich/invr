<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shrink extends Model
{
    public $table = 'shrink';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'updated_by',
        'product_id',
        'inventory_id',
        'quantity',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_by' => 'integer',
        'product_id' => 'integer',
        'inventory_id' => 'integer',
        'quantity' => 'decimal:2',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}
