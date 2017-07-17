<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Intercepto el llamado a una propiedad
    public function getImageAttribute($image) {
        if ( !$image || starts_with($image, 'http')) {
            return $image;
        }
        return  'http://'.\Storage::disk('public')->url($image);
    }

}
