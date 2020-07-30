<?php

namespace ACL\Http\Controllers\Auth\API;

use ACL\Http\Requests\API\RegisterAPIRequest;
use ACL\Http\Resources\RegisterResource;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

/**
 * @group ACL
 *
 * APIs for acl
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Register
     * @param RegisterAPIRequest $request
     * @return RegisterResource|\Illuminate\Http\JsonResponse
     */
    public function register(RegisterAPIRequest $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $user = $this->create($input);

            event(new Registered($user));

            $token = $user->createToken('*');
            $user->accessToken = $token->accessToken;

            DB::commit();

            return response()->json(new RegisterResource($user));
        } catch (\Exception $e) {
            logger($e);

            DB::rollBack();

            return response()->json($e->getMessage(), 500);
        }
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
