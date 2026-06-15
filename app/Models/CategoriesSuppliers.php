<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesSuppliers extends Model
{
    use HasFactory;

    protected $table = 'categories_suppliers';
    protected $primaryKey = 'id_categories_suppliers';

    protected $fillable = ['category_name'];

  
    public function Proveedor()
    {
        return $this->hasMany(Proveedor::class, 'id_supplier', 'id_supplier');
    }
}
