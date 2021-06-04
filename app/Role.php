<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    /*protected $fillable = [
       'id', 'name',
    ];*/

    protected $guarded = [''];

    public function permission(){
       $permissions = Permission::whereIn('id', json_decode($this->attributes['permissions']))->get();

        return $permissions;
    }

    public  function HasAccess(){
        $Access= $this->attributes['permissions'];

        if($Access==='["1","2","3","4","5"]') {
            echo "Administrator";
        }else
            if($Access==='["1","2","3","4"]') {
                echo "Dashboard,Create,Read,Update";
            }else
                if($Access==='["1","2","3","5"]') {
                    echo "Dashboard,Create,Read,Delete";
                }else
                    if($Access==='["1","2","4","5"]') {
                        echo "Dashboard,Create,Read,Update";
                    }else
                        if($Access==='["1","3","4","5"]') {
                            echo "Dashboard,Create,Read,Update";
                        }else
                            if($Access==='["2","3","4","5"]') {
                                echo "Dashboard,Create,Read,Update";
                            }else
                                if($Access==='["1","2","3"]') {
                                    echo "Dashboard,Create,Read";
                                }else
                                    if($Access==='["1","3","4"]') {
                                        echo "Dashboard,Create,Read";
                                    }else
                                        if($Access==='["2","3","4"]') {
                                            echo "Dashboard,Create,Read";
                                        }else
                                            if($Access==='["1","3","5"]') {
                                                echo "Dashboard,Create,Read";
                                            }else if($Access==='["2","3","5"]') {
                                                echo "Dashboard,Create,Read";
                                            }else if($Access==='["1","2","4"]') {
                                                echo "Dashboard,Create,Read";
                                            }else if($Access==='["1","2","5"]') {
                                                echo "Dashboard,Create,Read";
                                            }else if($Access==='["2","4","5"]') {
                                                echo "Dashboard,Create,Read";
                                            }else if($Access==='["1","4","5"]') {
                                                echo "Dashboard,Create,Read";
                                            }else
                                                if($Access==='["3","4","5"]') {
                                                    echo "Dashboard,Create,Read";
                                                }
                                                else if($Access==='["1","2"]') {
                                                    echo "Dashboard,Create";
                                                }else if($Access==='["1","3"]') {
                                                    echo "Dashboard,Read";
                                                }else if($Access==='["1","4"]') {
                                                    echo "Dashboard,Update";
                                                }else if($Access==='["1","5"]') {
                                                    echo "Dashboard,Delete";
                                                }else if($Access==='["2","3"]') {
                                                    echo "Create,Read";
                                                }else if($Access==='["2","4"]') {
                                                    echo "Create,Update";
                                                }else if($Access==='["2","5"]') {
                                                    echo "Create,Delete";
                                                }

                                                else if($Access==='["3","4"]') {
                                                    echo "Read,Update";
                                                } else if($Access==='["3","5"]') {
                                                    echo "Read,Delete";
                                                }else if($Access==='["4","5"]') {
                                                    echo "Update,Delete";
                                                }
                                                else if($Access==='["1"]') {
                                                    echo "Dashboard";
                                                }else if($Access==='["2"]') {
                                                    echo "Create";
                                                }else if($Access==='["3"]') {
                                                    echo "Read";
                                                }else if($Access==='["4"]') {
                                                    echo "Update";
                                                }else if($Access==='["5"]') {
                                                    echo "Delete";
                                                }
    }


public  function isAdministrator($permissions){
    $permissions=Auth::user()->role->permission();
    //for all permissions
    $db_permissions=Permission::all();
    $i=0;
    foreach ($db_permissions as $db){
        $db_arr[$i]=$db->name;
        $i++;
    }
    $total_db=count($db_permissions);
    $total_users=count($permissions);
    $k=0;
    for($i=0;$i<$total_db;$i++){

        for($j=0;$j<$total_users;$j++){
            $users_permissions[$j]=$permissions[$j]->name;

            if($db_arr[$i]===$users_permissions[$j]){

                //for administrator
                $temp[$k]=$db_arr[$i];
                $k++;
            }
        }
    }

    $temp_total=count($temp);

    if($temp_total==$total_db){
       return "Administrator";
    }else{
        $k=0;
        for($i=0;$i<$total_db;$i++) {

            for ($j = 0; $j < $total_users; $j++) {

                if($db_arr[$i]==="Read"&&$db_arr[$i+1]==="Update"){
                    return "Read & Update";
                }
                else if($db_arr[$i]==="Read"&&$db_arr[$i+1]==="Update"&&$db_arr[$i+2]==="Delete"){
                    return "Read & Update & Delete";
                }

            }

            }

        }

}


public function isUser($permissions){

        $total=count($permissions);

        for($i=0;$i<$total;$i++){

            if($permissions[$i]->name==="Read"){
               $counter=1;
                break;
            }else{
                $counter=0;
            }

        }

        if($counter==1){
           return 1;
        }else{
            return 0;
        }

}



}
//$filable=['name'];