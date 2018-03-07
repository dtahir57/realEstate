<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use App\Company;
use App\Property;
use App\Task;
use App\Invoice;
use App\PropertyTransactionType;
use App\PropertyTransaction;
class User extends Authenticatable
{
    use Notifiable, HasRoles;
    //protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function company(){
      return $this->belongsTo('App\Company');
    }

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
