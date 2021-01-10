<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    	return $this->hasMany(Moderation::class);
    }

    public static function addMainPhoto($photo) 
    {
        $path = Storage::putFile('public/'.auth()->user()->id.'/ad', $photo);
        $url = Storage::url($path);
        return $url;
    }

    public static function addAdditionalPhoto($myPhotos) 
    {
        $photos = [];
        $urls = [];

        foreach($myPhotos as $key => $photo) {
            $photos[] = Storage::putFile('public/'.auth()->user()->id.'/ad', $photo);
        }
        foreach($photos as $photo) {
            $urls[] = Storage::url($photo);
        }
        return serialize($urls);
    }
}
