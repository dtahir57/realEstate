<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Property;
use App\Company;
class Task extends Model
{
    public function user() {
      return $this->belongsTo('App\User');
    }

    public function property() {
      return $this->belongsTo('App\Property');
    }

    public function company() {
      return $this->belongsTo('App\Company');
    }
}
