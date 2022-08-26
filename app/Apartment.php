<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use SoftDeletes;
    
    public function optionals()
    {
        return $this->belongsToMany('App\Optional');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'title',
        'slug',
        'rooms_number',
        'beds_number',
        'bathroom_number',
        'square_metres',
        'address',
        'latitude',
        'longitude',
        'images',
        'visible'
    ];

    public static function generateApartmentSlugFromTitle($title)
    {
        $base_slug = Str::slug($title, '-');
        $slug = $base_slug;
        $count = 1;
        $find_slug = Apartment::where('slug', $slug)->first();
        while ($find_slug) {
            $slug = $base_slug . '-' . $count;
            $find_slug = Apartment::where('slug', $slug)->first();
            $count++;
        }
        return $slug;
    }
}