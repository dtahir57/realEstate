<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Company;
use App\PropertyHasImages;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Task;
use App\Invoice;
use App\PropertyTransaction;
class Property extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //one property belongs to one user while user can create multiple properties
    public function user(){
      return $this->hasOne('App\User');
    }
    // One property will always have one company
    public function company() {
      return $this->belongsTo('App\Company');
    }

    public function propertyHasImages() {
      return $this->hasMany('App\PropertyHasImages');
    }

    public function tasks() {
      return $this->hasMany('App\Task');
    }

    public function invoices() {
      return $this->hasMany('App\Invoice');
    }
    public function propertyTransactions() {
      return $this->hasMany('App\PropertyTransaction');
    }
}
