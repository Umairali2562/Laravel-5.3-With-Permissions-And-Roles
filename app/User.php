<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','is_active','photo_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){

        return $this->belongsto('App\Role');
    }
    public function photo(){
       return $this->belongsTo('App\Photo');
    }

    public function isAdmin()
    {

        $permissions=Auth::user()->role->permission();

        foreach ($permissions as $permission){

           if(in_array($permission->name,[
                'Dashboard',
                'Create',
                 'Read',
                 'Update',
                 'Delete',

            ]) && $this->is_active==1){
               return true;

           }else{
               return false;
           }

        }

    }

    public function posts(){
        return $this->hasMany('App\Post','user_id');
    }



}
