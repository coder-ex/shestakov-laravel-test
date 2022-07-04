<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory, UsesUuid;

    public $timestamps = true;

    protected $table = 'materials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'type'
    ];

    /**
     * получить автора материала
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * получить тип материала
     */
    public function type()
    {
        return $this->belongsTo(TypeMaterial::class);
    }

    /**
     * получить категорию материала
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * получить тег материала
     */
    public function tag()
    {
        return $this->belongsTo(TagModel::class);
    }

    /**
     * получить ссылка на материал
     */
    public function url()
    {
        return $this->belongsTo(UrlModel::class);
    }
}
