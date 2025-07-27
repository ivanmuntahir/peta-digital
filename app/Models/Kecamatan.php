<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function kelurahans(): HasMany
    {
        return $this->hasMany(Kelurahan::class);
    }
}
