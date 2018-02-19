<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Company extends Model
{
    public function user(){
      return $this->belongsTo('App\User');
    }

    protected $fillable = ['company_name', 'company_address'];
}
