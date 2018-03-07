<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Property;
use App\Task;
use App\PropertyTransactionType;
use App\PropertyTransaction;
class Company extends Model
{
    protected $fillable = ['company_name', 'company_address'];
    //One company belongs to only one user
    public function user(){
      return $this->belongsTo('App\User');
    }
    //One company has many properties
    public function properties(){
      return $this->hasMany('App\Property');
    }
    public function tasks() {
      return $this->hasMany('App\Task');
    }
    public function invoices() {
      return $this->hasMany('App\Invoice');
    }
    public function propertyTransactionTypes() {
      return $this->hasMany('App\PropertyTransactionType');
    }
    public function propertyTransactions() {
      return $this->hasMany('App\PropertyTransaction');
    }
}
