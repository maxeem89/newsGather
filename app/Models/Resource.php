<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';
    protected $primaryKey = "id";
    protected $guarded = ['id'];
    protected $fillable = ['name', 'link','api', 'lng', 'has_full_links'];
    protected $hidden = [];

    public function categories()
    {
        return $this->hasMany(Category::class, 'resources_id', 'id');
    }

    public function scopeApi($query){
      //  dd($query);
        $query->where('api', true);
    }
}
