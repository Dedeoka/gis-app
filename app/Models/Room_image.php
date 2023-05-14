<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_image extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Room(){
        return $this->belongsTo(Room::class);
    }
}
