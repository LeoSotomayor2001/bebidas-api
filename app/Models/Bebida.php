<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'tipo',
        'imagen',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function usuariosFavoritos()
    {
        return $this->belongsToMany(User::class, 'favorite_bebidas')->withTimestamps();
    }

}
