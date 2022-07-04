<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMaterial extends Model
{
    use HasFactory, UsesUuid;

    public $timestamps = false;

    protected $table = 'type_materials';

    /**
     * получить все материалы по типу
     */
    public function materials()
    {
        return $this->hasMany(Material::class, 'type_id');
    }
}
