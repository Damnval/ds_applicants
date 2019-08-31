<?php

namespace App;

use App\Rules\SixMonths;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
	protected $fillable = [
		'name', 'email', 'isHired',
	];

	public static function createRules(){
		return [
		        'name' => 'required',
		        'email' => ['required','email', new SixMonths]
		];
	}
}
