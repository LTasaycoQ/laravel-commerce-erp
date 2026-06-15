<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'id_client';

    protected $fillable = ['name_client'];

  
    public function contactos()
    {
        return $this->hasMany(Contacto::class, 'id_client', 'id_client');
    }
}