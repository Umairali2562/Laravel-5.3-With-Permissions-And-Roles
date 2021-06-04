<?php

namespace App\Providers;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        Gate::define('update-post', function ($user, $post) {

            $permissions=$user->role->permission();

            foreach ($permissions as $permission){

                if(in_array($permission->name,[

                        'Create',

                    ])){
                    return true;

                }else{
                    return false;
                }

            }


        });

    }
}
