<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\NewAdRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Exceptions\AdPhotosException;
use Cviebrock\EloquentSluggable\Sluggable;
use Intervention\Image\ImageManagerStatic as Image;

class Ad extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    /**
     *Ad status
     */
    public const DRAFT = 'Draft';
    public const ON_MODERATION = 'On Moderation';
    public const REJECTED = 'Rejected';
    public const SOLD_OR_DEL = 'Sold or delete';
    public const ACTIVE = 'Active';

    protected $table = 'ads';

    protected $fillable = ['user_id', 'city_slug', 'category_slug', 'title', 'description', 'price', 'photo', 'photos', 'slug', 'category_subslug'];

    protected $attributes = [
    	'view_counts' => 0,
    	'status' => self::DRAFT,
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function categories() {
    	return $this->hasMany(Category::class, 'slug', 'category_slug');
    }

    public function city() {
    	return $this->belongsTo(City::class);
    }

    public function moderation() {
    	return $this->hasMany(Moderation::class);
    }

    public static function editPhoto($photo) {
        $image = Image::make($photo);
        $image->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save();
    }

    public static function addMainPhoto($photo) 
    {
        $data = getimagesize($photo);
        $width = $data[0];
        $height = $data[1];

        if($width > 1500 || $height > 1500) {
            self::editPhoto($photo);
        }
        
        self::editPhoto($photo);

        $path = Storage::putFile('public/'.auth()->user()->id.'/ad', $photo);
        $url = Storage::url($path);

        return $url;
    }

    public static function addAdditionalPhoto($myPhotos) 
    {
        $photos = [];
        $urls = [];

        foreach($myPhotos as $key => $photo) {
            $data = getimagesize($photo);
            $width = $data[0];
            $height = $data[1];

            if($width > 1500 || $height > 1500) {
                self::editPhoto($photo);
            }

            $photos[] = Storage::putFile('public/'.auth()->user()->id.'/ad', $photo);
        }
        foreach($photos as $photo) {
            $urls[] = Storage::url($photo);
        }

        if(count($photos) > 10) {
            throw new AdPhotosException();   
        }

        return serialize($urls);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function newUserAd($data) {

        $ad = Ad::create([
            'title' => $data['title'],
            'user_id' => auth()->user()->id, 
            'category_slug' => $data['category_slug'],
            'category_subslug' => $data['category_subslug'],
            'city_slug' => $data['city_slug'],
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
        $ad->category_slug = $data['category_slug'];
        $ad->city_slug = $data['city_slug'];
        $ad->description = $data['description'];
        if($ad->photo == null) {
            $ad->photo = self::addMainPhoto($data['photo']);
        }
        if($ad->photos == null) {
            $ad->photos = self::addAdditionalPhoto($data['photos']);
        }
        $ad->price = $data['price'];
        $ad->update();

        return $ad;
    }
}
