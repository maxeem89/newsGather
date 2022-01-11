<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table='news';
    protected $primaryKey  = "id";
    protected $guarded = ['id'];
    protected $fillable=['title','body','resources_id', 'categories_id', 'rate','path_url'];
    protected $hidden=[];

    function category(){
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
    function scopeTitle($query, $title){
        $query->where('title', $title)->where('created_at', '>=', Carbon::now()->subDays(2));
    }

    function scopePathUrl($query, $url){

        $query->where('path_url', $url);

    }
    function scopeResource($query, $resource_id){

        $query->where('resources_id', $resource_id);
    }
    function scopeCategory($query, $category_id){

        $query->where('categories_id', $category_id);
    }

}
