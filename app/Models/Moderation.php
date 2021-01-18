<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderation extends Model
{
    use HasFactory;

    /**
     *Moderation status
     */
    public const TO_PUBLISH = 'True';
    public const DO_NOT_PUBLISH = 'False';

    protected $table = "moderations";

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function ads() {
    	return $this->bolongsTo(Ad::class);
    }
}
