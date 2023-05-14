<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumahsakit extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function images(){
        return $this->hasMany(Rumahsakit_image::class);
    }

    public function layanans(){
        return $this->hasMany(Layanan::class);
    }

    public function reviews(){
        return $this->hasMany(Rumahsakit_review::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }

    public function doctors(){
        return $this->hasMany(Doctor::class);
    }
}
