<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $primaryKey  = "id";
    protected $guarded = ['id'];
    protected $fillable=['name','sub_link','resources_id', 'target_element', 'regex', 'target_news_title', 'target_news_body'];
    protected $hidden=[];
    function resources(){
        return $this->belongsTo(Resource::class, 'resources_id', 'id');
    }
    function news(){
        return $this->hasMany(News::class, 'categories_id', 'id');
    }

}
