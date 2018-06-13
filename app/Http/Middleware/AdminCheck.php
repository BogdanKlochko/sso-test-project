<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::where(['email' => $request->email])->with('roles')->first();

        if($user) {
            $access = false;
            $roles = $user->roles;

            foreach ($roles as $role) {
                if($role['name'] == 'ADMIN')
                    $access = true;
            }

            if($access)
                return $next($request);
            else {
                return redirect()->back()->with('access_error', "User $user->email doesn't have admin rights");
            }

        }

        return $next($request);
    }
}
