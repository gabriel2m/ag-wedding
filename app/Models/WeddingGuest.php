<?php

namespace App\Models;

use App\Enums\WeddingGuestResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $name
 * @property ?string $phone_number
 * @property WeddingGuestResponse $response
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WeddingGuest extends Model
{
    use HasFactory;

    protected $casts = [
        'response' => WeddingGuestResponse::class,
    ];

    protected $attributes = [
        'response' => WeddingGuestResponse::PENDING->value,
    ];

    protected $fillable = [
        'name',
        'phone_number',
        'response',
    ];
}
