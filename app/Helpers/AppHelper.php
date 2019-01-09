<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Facade;

use App\Constants\Status;

use App\Models\User;

use Mail;

class AppHelperFacade extends Facade 
{
	public static function getFacadeAccessor() {
		return 'AppHelper';
	}
}

class AppHelper
{
	public static function getParentsAccountId(&$walletAddresses, $userId) {
		$user = User::stored()->where('status', Status::$ACTIVE)->where('userId', $userId)->first();
		if(isset($user->referralId) && strlen($user->referralId) > 0) {
			$referralUser = User::stored()->where('status', Status::$ACTIVE)->where('userId', $user->referralId)->first();
			if(!in_array($referralUser->walletAddress , $walletAddresses)) {
				$walletAddresses[] = isset($referralUser->walletAddress) ? $referralUser->walletAddress : '';
				self::getParentsAccountId($walletAddresses, $referralUser->userId);
			}
		}
		return $walletAddresses;
	}

	public static function sendEmail($view, $data) {
		Mail::send($view, $data, function ($m) use ($data){
			$m->from(env('SUPPORT_EMAIL_ADDRESS'), env('APP_TITLE'));
			// $m->bcc(env('SUPPORT_EMAIL_ADDRESS'), env('APP_TITLE'));
			// $m->bcc('ehussain.in@gmail.com', env('APP_TITLE'));
			$m->to($data['receiverEmail']);

			if(isset($data['ccEmail'])) {
				$m->cc($data['ccEmail']);
			}

			$m->subject($data['emailSubject']);
		});
	}

	public static function validateShuftiSignature($response) {
		$response_signature  = $response['signature'];
		unset($response['signature']);

		$request_data = implode("", $response);
		$calculated_signature = hash('sha256', $request_data . env('SHUFTI_SECRET_KEY'));

		if($response_signature == $calculated_signature) {
		    return true;
		}
		return false;
	}

	public static function setRedirectTo($url) {
		$uri = parse_url($url);
		if(starts_with($url, env('APP_URL'))) {
			$redirectUrl = $uri['path'];
			$query = isset($uri['query']) ? $uri['query'] : false;
			if($query) {
				$redirectUrl = $redirectUrl . '?' . $query;
			}

			session(['redirectTo' => $redirectUrl]);
		}
	}
}
