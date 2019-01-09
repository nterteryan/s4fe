<?php

namespace App\Service;

use App\Model\User;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Service\EmailService;
use App\Service\TwillioService;
use App\Model\ResetPassword;
use App\Model\SignupPhone;
use Exception;
/**
 * Class UserService
 * @package App\Service
 */
class UserService extends AbstractService
{
    private $signupPhone, $emailService, $reset_password, $baseDir='uploads/user',$fileUploadService,$twillioService;
    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
                UserRepositoryInterface $userRepository,
                EmailService $emailService,
                ResetPassword $reset_password,
                FileService $fileUploadService,
                TwillioService $twillioService,
                SignupPhone $signupPhone
            )
    {
        parent::__construct($userRepository);
        $this->emailService = $emailService;
        $this->reset_password = $reset_password;
        $this->fileUploadService = $fileUploadService;
        $this->twillioService = $twillioService;
        $this->signupPhone = $signupPhone;
    }

    /**
     * Completing user data
     * 
     * @param array $userData
     * @return array
     */
    public function beforeSave(array $userData)
    {
//        $userData['password']  = Hash::make($userData['password']);
        $userData['type_id']   = 1; // Common type
        $userData['status_id'] = 1; // not confirmed
        $userData['item_report_banned'] = 0; // not confirmed
        $userData['uuid'] = \Webpatser\Uuid\Uuid::generate()->string;
        return $userData;
    }
    /**
     * @param array $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $user)
    {
        $user = $this->beforeSave($user);
        return parent::create($user);
    }
    /**
     * Spending Signup Process
     * 
     * @param array $user
     * @return boolean
     * @throws Exception
     */
    public function spendSignupProcess(array $user)
    {
        $this->checkPhoneVerification($user['phone'], true);
        if($created_user = $this->create($user))
        {
            $this->emailService->sendVerification($created_user, 'signup_email');
            return [
                'status' => 201,
                'message' => 'Activation code sent to your email.Please, check.',
            ];
        }
        throw new Exception ("Something went wrong. Can not create user !", 500);
    }
    /**
     * 
     * @param string $phone
     * @param boolean $delete
     * @return boolean
     * @throws Exception
     */
    public function checkPhoneVerification($phone, $delete=false)
    {
        if(!($sighnup_phone = $this->signupPhone->where(['phone' => $phone])->first()))
            throw new \Exception($phone.' phone not registered.',403);
        if(!$sighnup_phone->verified)
            throw new \Exception($phone.' phone not verified.',403);
        if($delete)
            return $sighnup_phone->delete();
        return $sighnup_phone->verified;
    }

/**
     * Sign up forward process for auth user
     * 
     * @return string
     * @throws Exception
     */
    public function spendSignupForwardProcess($email)
    {
        $user = parent::getByEmail($email);
        if(!$user)
            throw new \Exception('No such registered user.', 404);
        if($user->status->name != 'pending')
            throw new \Exception('Forbidden for '.$user->status->name.' signup process', 403);
        $this->emailService->sendVerification($user, 'signup_email');
        return [
            'status' => 200,
            'message' => 'E-mail was forwarded. Please, check your email for more details how to activate your S4FE account.',
        ];
    }

    /**
     * Identify Not-Completed Sign up User process By Hesh
     * 
     * @param type $hesh
     * @return boolean
     * @throws Exception
     */
    public function identifyNotCompletedSignupUserByHesh($hash)
    {
        $user_id = $this->emailService->verifySignupUserByHesh($hash);
        $user = parent::getById($user_id);
        if(!parent::update($user,['status_id' => 2]))
            throw new Exception('Something went wrong.Can not identify User by this link', 500);
        return $user;
    }

    /**
     * Identify Not-Completed Sign up User process By Hesh
     * 
     * @param type $hesh
     * @return boolean
     * @throws Exception
     */
    public function phone_verify_hash($hash)
    {
        if(!($signupPhone = $this->signupPhone->where(['hash' => $hash])->first()))
            throw new \Exception('There is no such code.', 404);
        if($signupPhone->verified)
            return $signupPhone->phone;
        if(!$signupPhone->update(['verified'=>1]))
            throw new \Exception('Something went wrong.Can not update phone "verified" field by hash '.$hash, 500);
        return $signupPhone->phone;
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     * @throws Exception
     */
    public function resetPassword(\Illuminate\Http\Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            throw new \Exception(json_encode(["validation errors" => $validator->errors()]), 400);
        }
        if(!($user = parent::getByEmail($request->get('email'))))
            throw new \Exception('No such registered user.', 404);
        $this->emailService->sendVerification($user, 'reset_password');
        return [
            'status' => 200,
            'message' => 'Password reseted. Please, check your email.',
        ];
    }
    /**
     * 
     * @param type $hesh
     * @return type
     * @throws Exception
     */   
    public function resetPasswordByHesh($hash)
    {
        $reset_password_model = $this->reset_password->where('hesh', $hash)->first();
        if(!$reset_password_model)
            throw new \Exception('Password reset hash is invalid.', 404);
        $user_id = $reset_password_model->user_id;
        $reset_password_model->delete();
        return parent::getById($user_id);
    }
    /**
     * 
     * @param User $user
     * @param array $data
     * @return boolean
     * @throws Exception
     */
    public function updateUser(User $user, $data)
    {
        $data = array_filter($data);
        if(!empty($data['photo']))
        {
            if($user->photo)
                if(!$this->fileUploadService->delete($this->baseDir.'/'.$user->photo))
                    throw new Exception ('Something went wrong. Can not delete file', 500);
                
            $photo = $this->fileUploadService->store($this->baseDir, [$data['photo']])[0];
            if(!$this->fileUploadService->fileExists($this->baseDir.'/'.$photo))
                throw new Exception ('Can not save file '.$photo);
            $data['photo'] = $photo;
        }
        if(!$user->update($data))
            throw new \Exception('Something went wrong.Can not update user.', 500);
        return true;
    }
    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function sendVerificationSms(\Illuminate\Http\Request $request)
    {
        $hash = uniqid();
        $data = [
            'to'       => $request->get('phone'),
            'hash'     => $hash,
            'message'  => env('APP_NAME').' verification code is '. $hash,
            'verified' => 0
        ];
        return $this->twillioService->sendVerificationSms($data);
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function update_password(\Illuminate\Http\Request $request)
    {
        $user = User::where(['email' => $request->get('email')])
                  ->orWhere(['phone' => $request->get('phone')*1])
                  ->first();
        if(!$user)
            throw new \Exception('User does not exists.', 404);
        $user->update(['password' => Hash::make($request->get('password'))]);
        return $user;
    }
}