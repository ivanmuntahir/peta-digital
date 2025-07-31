<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'category_id',
        'attachment',
        'panjang',
        'lebar',
        'tipe',
        'kecamatan_id',
        'kelurahan_id',
        'user_id'
    ];

    protected $casts = [
        'attachment' => 'array',
        'tipe' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function functionCategory()
    {
        // <<< PASTI KAN INI BENAR >>>
        // 'fungsi' di sini adalah nama kolom foreign key di tabel 'places'
        return $this->belongsTo(Category::class, 'fungsi');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    // Define the relationship to the User model (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Get the kelurahan that owns the Place.
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }


}
