<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $table = 'ads';

    protected $attributes = [
    	'view_counts' => 0,
    	'status' => 'draft',
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function category() {
    	return $this->belongsTo(Category::class);
    }

    public function city() {
    	return $this->belongsTo(City::class);
    }

    public function moderation() {
    	return $this->belongsTo(Moderation::class);
    }
}
