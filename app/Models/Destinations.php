<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destinations extends Model
{
    use HasFactory;

    protected $table = 'destinations';
    protected $primaryKey = 'id_destinations';

    protected $fillable = [
        'destinations_name',
    ];


   public function Proveedor()
    {
        return $this->hasMany(Proveedor::class, 'id_supplier', 'id_supplier');
    }

  
}
