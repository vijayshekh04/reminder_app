<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('user_session'))
        {
            if (!$request->ajax()){
                Session::forget('user_session');
                Session::flash("login_message","You don't authorized for this action. Please Login Again");
                return redirect(url('/'));
            }
            else{
                return response()->json(array("status" => "success", "msg" => "You don't authorized for this action. Please Login Again"));
            }
        }
        else
        {
            return $next($request);
        }
    }
}
