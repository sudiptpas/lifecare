<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use App\Role;
use Auth;

class CreateNew extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if(Auth::check() && Auth::user()->role_id == User::roleAdmin())
		{
			return true;		
		}
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required',
			'full_address' => 'required',
			'phone' => 'required',
			'email' => 'required',
		];
	}

}
