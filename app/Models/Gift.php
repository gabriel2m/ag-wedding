<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $image
 * @property string $name
 * @property float $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];
}
