<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    protected $table = "categories";

    protected $fillable = ['name', 'slug', 'description'];

    // protected $primaryKey = 'slug';

    public function ads() {
    	return $this->belongsTo(Ad::class);
    }


    // public function getParentKeyName()
    // {
    //     return 'parent_id';
    // }
}
