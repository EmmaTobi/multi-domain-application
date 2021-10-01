<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\UserContract as UserService;
use App\Services\CapsuleContract as CapsuleService;
use App\Dtos\PartyDto;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $userService;

    protected $capsuleService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService,CapsuleService $capsuleService )
    {
        $this->middleware('guest');
        $this->userService = $userService;
        $this->capsuleService =  $capsuleService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = $this->userService->createUser($data);
        if(!$user) 
            return redirect()->back()->with(["status" => "error", "msg"=>"An Error Occured While Creating a user"]);
        $this->capsuleService->createParty(PartyDto::fromUser($user)); // create a party on capsule crm for representing registered user
        $this->capsuleService->notifySalesHeadOfNewUserSignup($user); // Send a notification to app sales head on user signup
        return $user;
    }

}
