<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;
    protected $table='user_setting';
    protected $primaryKey='id';
    protected $guarded='id';
    protected $fillable=['user_id', 'category_id', 'resource_id', 'created_at', 'updated_at'];
    protected $hidden=[];
}
