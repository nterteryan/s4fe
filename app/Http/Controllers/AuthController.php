<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Service\UserService;
use App\Transformer\UserTransformer;
use Illuminate\Http\Request;
use App\Events\AccessTokenCreatedEvent;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthController
 * @package App\Http\Controllers
 * @author Varazdat Stepanyan
 */
class AuthController extends Controller
{
    use RestResponseTrait;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * AuthController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getAccessToken(Request $request): Response
    {
        $inputs = $request->all();

        if (!isset($inputs['scope']) || empty($inputs['scope'])) {
            $inputs['scope'] = "*";
        }
        $tokenRequest = $request->create('/oauth/token', 'post', $inputs);
        return app()->dispatch($tokenRequest);
    }
    
    public function sendVerificationSms(Request $request)
    {
        try {
            $validator = \Validator::make(
                    $request->all(), 
                    [
                        'phone' => 'required|numeric',
                    ]
            );
            if ($validator->fails()) {
                throw new \Exception(json_encode(["validation errors" => $validator->errors()]), 400);
            }
            \DB::beginTransaction();
            $result = $this->userService->sendVerificationSms($request);
            \DB::commit();
            return $this->respondSuccess($result);

        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage() , $e->getCode());
        }
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $validator = \Validator::make(
                    $request->all(), 
                    [
                        'email' => 'required|email|unique:users',
                        'phone' => 'required|numeric',
                    ]
            );
            if ($validator->fails()) {
                throw new \Exception(json_encode(["validation errors" => $validator->errors()]), 400);
            }
            \DB::beginTransaction();
            $result = $this->userService->spendSignupProcess($request->all());
            \DB::commit();
            return $this->respondSuccess($result);

        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage() , $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getPersonalAccessToken(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                throw new \Exception(json_encode(["validation errors" => $validator->errors()]), 400);
            }
            $email = $request->get('email');
            $user = User::where('email', $email)->first();
            if (!$user) {
                throw new \Exception('User not found.', 401);
            }
            if(!\Illuminate\Support\Facades\Hash::check($request->get('password'), $user->password))
                throw new \Exception('Email or password is incorrect.', 401);

            $scope = '*';
            if ($request->has('scope')) {
                $scope = $request->get('scope');
            }

            $token = $user->createToken($email, [$scope])->accessToken;
            event(new AccessTokenCreatedEvent($user));

            if($user->status->name == 'pending')
            {
                return $this->respondSuccess([
                    'status'  => 307,
                    'message' => 'Complete your signup process first.',
                    'action'  => url ('signup-forward')
                ]);
            }
            return $this->respondSuccess([
                'status'  => 200,
                'message' => 'Success.',
                'data' => [
                    'user' => $user,
                    'access_token' => $token
                ]
            ]);

        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage() , $e->getCode());
        }
    }

    /**
     * 
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function signup_forward($email)
    {
        try {
            \DB::beginTransaction();
            $result = $this->userService->spendSignupForwardProcess($email);
            \DB::commit();
            return $this->respondSuccess($result);
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param string $hash
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function email_verify_hash($hash)
    {
        try {
            \DB::beginTransaction();
            $user = $this->userService->identifyNotCompletedSignupUserByHesh($hash);
//            event(new AccessTokenCreatedEvent($user));
            \DB::commit();
            return $this->respondSuccess([
                'status'  => 200,
                'message' => 'Email verified.',
                'data' => [
                    'user' => $user
                ]
            ]);
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    public function password(Request $request)
    {
        try {
            $validator = \Validator::make(
                    $request->all(), 
                    [
                        'email' => 'required_if:phone,|email',
                        'phone' => 'required_if:email,|numeric',
                        'password' => 'required|confirmed|min:6'
                    ]
            );
            if ($validator->fails()) {
                throw new \Exception(json_encode(["validation errors" => $validator->errors()]), 400);
            }
            \DB::beginTransaction();
            $user = $this->userService->update_password($request);
            $token = $user->createToken($user->email, ['*'])->accessToken;
            \DB::commit();
            return $this->respondSuccess([
                'status'  => 200,
                'message' => 'Signup process successfully completed.',
                'data' => [
                    'user' => $user,
                    'access_token' => $token
                ]
            ]);
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage() , $e->getCode());
        }
    }
    /**
     * @param string $hash
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function phone_verify_hash($hash)
    {
        try {
            \DB::beginTransaction();
            $phone = $this->userService->phone_verify_hash($hash);
            \DB::commit();
            return $this->respondSuccess([
                'status'  => 200,
                'message' => $phone.' successfully verified.',
                'data' => [
                    'phone' => $phone
                ]
            ]);
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function reset_password(Request $request)
    {
        try {
            \DB::beginTransaction();
            $result = $this->userService->resetPassword($request);
            \DB::commit();
            return $this->respondSuccess($result);
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }
    
    /**
     * @param string $hash
     * @return @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function reset_password_by_hash($hash)
    {
        try {
            \DB::beginTransaction();
            $user = $this->userService->resetPasswordByHesh($hash);
            $token = $user->createToken($user->email, ['*'])->accessToken;
            \DB::commit();
            return $this->respondSuccess([
                'status'  => 200,
                'message' => 'Password reset allowed',
                'data' => [
                    'user' => $user,
                    'access_token' => $token
                ]
            ]);
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }
}
