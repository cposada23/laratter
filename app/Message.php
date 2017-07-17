<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Para ser indexado en algolia
use Laravel\Scout\Searchable;

class Message extends Model
{
    use Searchable;

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
    // Para indexar los mensajes junto con su usuario en algolia
    public function toSearchableArray() {
        $this->load('user');
        return $this->toArray();
    }


}
