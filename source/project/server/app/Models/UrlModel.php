<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlModel extends Model
{
    use HasFactory, UsesUuid;

    public $timestamps = false;

    protected $table = 'url_models';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'caption', 'url'
    ];
    
    /**
     * получить ссылку на материал
     */
    public function materials()
    {
        return $this->hasMany(Material::class, 'url_id');
    }
}
