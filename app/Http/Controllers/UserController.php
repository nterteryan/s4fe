<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use App\Transformer\UserTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Model\User;
use App\Helpers\BlockChainHelper;
use Exception;
use Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserService $userService
     */
    protected $userService;
    /**
     * @var UserTransformer
     */
    protected $userTransformer;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param UserTransformer $userTransformer
     */
    public function __construct(UserService $userService, UserTransformer $userTransformer)
    {
        parent::__construct();
        $this->userService = $userService;
        $this->userTransformer = $userTransformer;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->getAll();
        } catch (\Throwable $exception) {
            \Log::critical('Get users list', ['exception' => $exception]);
            return $this->sendInternalServerErrorResponse($exception->getMessage());
        }

        if (!$users->count()) {
            return $this->sendEmptyDataResponse();
        }

        return $this->respondWithCollection($users, $this->userTransformer);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function one(int $id): JsonResponse
    {
        try {
            $user = $this->userService->getById($id);
        } catch (\Throwable $exception) {
            \Log::critical('Get user by ID', ['exception' => $exception]);
            return $this->sendInternalServerErrorResponse($exception->getMessage());
        }

        if (!$user) {
            return $this->sendNotFoundResponse(
                sprintf('User with id %s not found', $id)
            );
        }

        return $this->respondWithItem($user, $this->userTransformer);
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $userData = $request->only([
                'first_name',
                'last_name',
                'middle_name',
                'display_name',
                'nationality',
                'birth_date',
                'phone',
                'photo',
                'gender',
            ]);
            $rules = [
                'gender' => 'in:male,female',
                'photo'  => 'mimes:jpeg,jpg,bmp,png',
            ];
            $validator = \Validator::make($userData, $rules);
            if ($validator->fails()) {
                throw new \Exception(json_encode(["validation errors" => $validator->errors()]), 400);
            }
            $user = Auth::user();
            \DB::beginTransaction();
            $this->userService->updateUser($user,$userData);
            \DB::commit();
            return $this->respondSuccess([
                'status'  => 200,
                'message' => 'Success.',
                'data' => ["user" => $user]
            ]);

        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return JsonResponse
     */
    public function wallet(Request $request): JsonResponse
    {
        try {
            $password = $request->password;
            
            $response = BlockChainHelper::post('ethereum/account', ['password' => $password]);
            if (isset($response) && $response['status'] == false) {
                throw new Exception(json_encode(['BlockChain error' => $response]), 400);
            }

            $user = Auth::user();
            $user->walletAddress = $response['result']['address'];
            $user->keystore = json_encode($response['result']['fileJson']);
            $user->save();

            return $this->respondSuccess([
                'status'  => 200,
                'message' => 'Success.',
                'data' => [
                    'walletAddress' => $response['result']['address'],
                    'keystore' => $response['result']['fileJson'],
                    'privateKey' => $response['result']['privateKey'],
                    'fileName' => $response['result']['fileName']
                ]
            ]);

        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return JsonResponse
     */
    public function linkWallet(Request $request): JsonResponse
    {
        try {
            $walletAddress = $request->walletAddress;
            
            $user = Auth::user();
            $user->walletAddress = $walletAddress;
            $user->save();
            return $this->respondSuccess([
                'status'  => 200,
                'message' => 'Success.',
                'data' => [
                    'walletAddress' => $walletAddress,
                ]
            ]);
        } catch (\Throwable $e) {
            return $this->respondException($e->getMessage(), $e->getCode());
        }
    }
}