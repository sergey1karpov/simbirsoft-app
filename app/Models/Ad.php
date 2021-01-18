<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\NewAdRequest;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     *Ad status
     */
    public const DRAFT = 'Draft';
    public const ON_MODERATION = 'On Moderation';
    public const REJECTED = 'Rejected';
    public const SOLD_OR_DEL = 'Sold or delete';
    public const ACTIVE = 'Active';

    protected $table = 'ads';

    protected $fillable = ['user_id', 'city_id', 'category_id', 'title', 'description', 'price', 'photo', 'photos'];

    protected $attributes = [
    	'view_counts' => 0,
    	'status' => self::DRAFT,
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

    public static function newUserAd($data) {

        $ad = Ad::create([
            'title' => $data['title'],
            'user_id' => auth()->user()->id, 
            'category_id' => $data['category'],
            'city_id' => $data['city'],
            'description' => $data['description'],
            'photo' => self::addMainPhoto($data['photo']),
            'photos' => self::addAdditionalPhoto($data['photos']),
            'price' => $data['price'],
        ]);

        return $ad;
    }

    public static function updateUserAd($data, $ad) {
        $ad->title = $data['title'];
        $ad->user_id = auth()->user()->id;
        $ad->category_id = $data['category'];
        $ad->city_id = $data['city'];
        $ad->description = $data['description'];
        $ad->photo = self::addMainPhoto($data['photo']);
        $ad->photos = self::addAdditionalPhoto($data['photos']);
        $ad->price = $data['price'];
        $ad->update();

        return $ad;
    }
}
