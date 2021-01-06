<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderation extends Model
{
    use HasFactory;

    protected $table = "moderations";

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function ads() {
    	return $this->hasMany(Ad::class);
    }
}