<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = 'id_contacts';

    protected $fillable = [
        'id_client',
        'id_supplier',
        'name',
        'last_names',
        'Date_of_birth',
        'qualification',
        'email',
        'first_phone',
        'second_phone',
        'es_principal'
    ];


    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_client', 'id_client');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_supplier', 'id_supplier');
    }
}