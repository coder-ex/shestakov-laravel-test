<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    use HasFactory, UsesUuid;

    public $timestamps = false;

    protected $table = 'tag_models';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'name', ];

    /**
     * получить все материалы по категории
     */
    public function materials()
    {
        return $this->hasMany(Material::class, 'tag_id');
    }
}
