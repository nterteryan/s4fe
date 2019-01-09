<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Facade;
use Auth;
use Request;

use App\Models\User;

class UniqueNumberHelperFacade extends Facade
{
	public static function getFacadeAccessor() {
		return 'UniqueNumberHelper';
	}
}

class UniqueNumberHelper
{
	public static function getEntityNo() {
		return mt_rand(1000 , 9999) . '-' . mt_rand(1000 , 9999) . '-' . mt_rand(1000 , 9999);
	}

	public static function getUserNo($user) {
		$entityNo = 'USR-' . UniqueNumberHelper::getEntityNo();
		$entity = User::where('userNo' , $entityNo)->first();

		if(!$entity) {
			return $entityNo;
		}
		return UniqueNumberHelper::getUserNo($user);
	}
}
