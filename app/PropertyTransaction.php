<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\PropertyTransactionType;
use App\User;
use App\Company;
class PropertyTransaction extends Model
{
    public function invoice() {
      return $this->belongsTo('App\Invoice');
    }
    public function propertyTransactionTypes() {
      return $this->belongsTo('App\PropertyTransactionType');
    }
    public function user() {
      return $this->belongsTo('App\User');
    }
    public function company() {
      return $this->belongsTo('App\Company');
    }
    public function property() {
      return $this->belongsTo('App\Property');
    }
}
