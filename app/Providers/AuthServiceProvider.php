<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Engineer;
use Illuminate\Auth\Access\Response;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Gate::define('add-report', function (User $user, Task $task) {
        //     return $user->email === $task->id;
        // });
        Gate::define('add-report', function ( $user,  $engineers) {
            foreach (Engineer::all() as $engineer) {
                return (Auth::user()->email) === $engineer->email
                ? Response::allow()
                : Response::deny('You do not own this post.');
            
            }
            

        });


        
    }
}