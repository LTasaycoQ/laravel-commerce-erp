<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
        
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'id_supplier';
    
    protected $fillable = [
        'supplier_name',
        'id_categories_suppliers',
        'id_destinations',
        'status',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriesSuppliers::class, 'id_categories_suppliers', 'id_categories_suppliers');
    }

    public function destino()
    {
        return $this->belongsTo(Destinations::class, 'id_destinations', 'id_destinations');
    }
    public function contactos()
    {
        return $this->hasMany(Contacto::class, 'id_supplier', 'id_supplier');
    }

}
