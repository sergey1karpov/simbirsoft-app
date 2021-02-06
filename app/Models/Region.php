<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Ad;

class Region extends Model
{
    use HasFactory;

    protected $table = "regions";

    public function city() {
    	return $this->belongsTo(City::class);
    }
}
