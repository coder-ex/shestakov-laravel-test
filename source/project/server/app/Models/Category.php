<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, UsesUuid;

    public $timestamps = false;

    /**
     * получить все материалы по категории
     */
    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
