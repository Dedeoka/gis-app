<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function rumahsakit(){
        return $this->belongsTo(Rumahsakit::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
