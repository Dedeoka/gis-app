<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rumahsakit(){
        return $this->belongsTo(Rumahsakit::class);
    }

    public function images(){
        return $this->hasMany(Room_image::class);
    }

    public function facilities(){
        return $this->hasMany(Room_facility::class);
    }
}
