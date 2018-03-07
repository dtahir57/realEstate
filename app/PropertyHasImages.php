<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Property;
class PropertyHasImages extends Model
{
    public function property() {
      return $this->belongsTo('App\Property');
    }
}
