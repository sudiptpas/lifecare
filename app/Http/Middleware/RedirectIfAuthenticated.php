<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use App\User;

class RedirectIfAuthenticated {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->check())
		{			
			if($request->user()->role_id == User::roleAdmin())
			{
				return new RedirectResponse(url('/home'));
			}
			if($request->user()->role_id == User::roleBasic())
			{
				return new RedirectResponse(url('/user/home'));
			}
			if($request->user()->role_id == User::roleAdvance())
			{
				return new RedirectResponse(url('admin/home'));
			}
		}
		
		return $next($request);
	}

}
