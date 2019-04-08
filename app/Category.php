<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_ar','name_en', 'color','icon','show','admin_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $hidden=[
      'created_at','updated_at','deleted_at'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

}
