<?php
namespace App\Service;

use Twilio\Rest\Client;
use App\Model\SignupPhone;
use Exception;

class TwillioService extends AbstractService
{
    private $client,$signupPhone;
    public function __construct(SignupPhone $signupPhone)
    {
        $sid = env('TWILLIO_SID');
        $token = env('TWILLIO_TOKEN');
        
        $this->client = new Client($sid, $token);
        $this->signupPhone = $signupPhone;
    }
    /**
     * 
     * @param string $to
     * @param string $message
     * @return string
     */
    public function sendVerificationSms($data)
    {
        $signupPhoneData = [
            'phone' => $data['to'],
            'hash' => $data['hash'],
            'verified' => $data['verified'],
        ];
        if($signupPhone = $this->signupPhone->where(['phone' => $signupPhoneData['phone']])->first())
        {
            if($signupPhone->verified)
                return [
                    'status' => 307,
                    'message' => 'This number has been verified.',
                    'action'  => url('register')
                ];
            $signupPhone->update($signupPhoneData);
        } else {
            $signupPhone = $this->signupPhone->create($signupPhoneData);
        }
        $message = $this->client->messages->create(
            '+'.$data['to'],
            array (
                'from' => env('TWILLIO_PHONE'),
                'body' => $data['message']
            )
        );
        return [
            'status' => 200,
            'message' => 'Verification message sent.',
        ];
    }
}