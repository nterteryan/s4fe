<?php
namespace App\Service;

use App\Model\SignupEmail;
use App\Model\ResetPassword;
use App\Model\User;

use Exception;

class EmailService
{
    /**
     * @var SignupEmail $signup_email Stores the model SignupEmail
     * @var Mail $mail Stores the Mail object
     */
    private $signup_email, $reset_password;

    /**
     * @param SignupEmail $signup_email
     * @param Mail $mail
     */
    public function __construct(SignupEmail $signup_email, ResetPassword $reset_password) {
        $this->signup_email = $signup_email;
        $this->reset_password = $reset_password;
    }

    /**
     * Send verification email
     * 
     * @param User $user
     * @return boolean
     * @throws Exception
     */
    public function sendVerification(User $user, $model = '')
    {
        if(!property_exists($this, $model))
            throw new \Exception("Such property does not exists in class ".__CLASS__, 500);

        $hash = uniqid();
        
        //Send email via SendGrid
        $response = $this->sendgridMail($user, $model, $hash);
        if($response->statusCode() >= 400)
        {
            throw new \Exception(json_encode(['sendgrid_error'=> (array)$response]), 500);
        }
        $data = [
            'user_id' => $user->id,
            'email'   => $user->email,
            'hesh'    => $hash,
        ];
        $modelObject = $this->{$model}->where(['email' => $user->email]);
        if($modelObject->count())
        {
            if(!$modelObject->update(['hesh' => $hash]))
                throw new \Exception("Can't update data for ".$model, 500);
        } else {
            if(!$this->{$model}->create($data))
                throw new \Exception("Can't create data for ".$model, 500);
        }
        return true;
    }

    /**
     * Verify Signup User
     * If exists remove that user from SignupEmail model
     * 
     * @param type $hash
     * @return type
     * @throws Exception
     */
    public function verifySignupUserByHesh($hash)
    {
        $signup_email = $this->signup_email->whereHesh($hash)->first();
        if($signup_email)
        {
            $user_id = $signup_email->user_id;
            if(!$signup_email->delete())
                throw new Exception('Something went wrong.Can not delete Signe up email.', 500);
            return $user_id;
        }
        throw new Exception('Invalid hash.', 404);
    }

    /**
     * https://github.com/sendgrid/sendgrid-php/blob/master/USE_CASES.md
     * 
     * Send email via SendGrid Transactional Templates
     * 
     * @param User $user
     * @param string $templateName
     * @return response
     */
    public function sendgridMail(User $user, $templateName, $hash)
    {
        $userFullName = $user->first_name.' '. $user->last_name;
        $subject      = "S4FE ". ucfirst(str_replace('_', ' ', $templateName)).' Verification';
        $templates    = [
            'signup_email' => [
                'id'            => env('SG_EMAIL_VERIFICATION_TID'),
                'substitutions' => [
                    'subject'         => $subject,
                    'fullName'        => $userFullName,
                    'activationToken' => $hash,
                    'activationLink'  => url('user/email/verify/'.$hash),
                ]
            ],
            'reset_password' => [
                'id'            => env('SG_RESET_PASS_VERIFICATION_TID'),
                'substitutions' => [
                    'subject'         => $subject,
                    'fullName'        => $userFullName,
                    'activationToken' => $hash,
                    'activationLink'  => url('user/reset-password-by-hesh/'.$hash),
                ]
            ],
        ];

        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom(env('MAIL_FROM_ADDRESS', 'no_reply@s4fe.io'), env('MAIL_FROM_NAME', 'S4FE WEB APP'));
        $email->setSubject($templates[$templateName]['substitutions']['subject']);
        $email->addTo($user->email, $templates[$templateName]['substitutions']['fullName']);
//        $email->addTo('narekterteryan@gmail.com', $templates[$templateName]['substitutions']['fullName']);
        $email->setTemplateId($templates[$templateName]['id']);
        $email->addSubstitutions($templates[$templateName]['substitutions']);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        return $sendgrid->send($email);
    }
    
    
}
