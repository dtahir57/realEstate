<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Property;
use App\Company;
use App\PropertyTransaction;
class Invoice extends Model
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

    public function propertyTransactions() {
      return $this->hasMany('App\PropertyTransaction');
    }
}
