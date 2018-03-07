<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;
use App\User;
use App\PropertyTransaction;
class PropertyTransactionType extends Model
{
    public function user() {
      return $this->belongsTo('App\User');
    }
    public function company() {
      return $this->belongsTo('App\Company');
    }

    public function propertyTransactions() {
      return $this->hasMany('App\PropertyTransaction');
    }
}
