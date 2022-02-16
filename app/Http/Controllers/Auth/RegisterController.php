<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Notifications\WelcomeEmailNotification;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Country;
use App\Address;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
    //    protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo = RouteServiceProvider::USERS;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('auth');
        //        $this->middleware('guest')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^[A-Za-z0-9_]+$/'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // ? iz use RegistersUsers
    // * Ideja je bila da se prikazu dropdown meniji sa spiskom zemalja i rola
    public function showRegistrationForm()
    {
        $countries = Country::all();
        $roles = Role::all();

        return view('auth.register', compact('countries', 'roles'));
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return bool
     */
    protected function create(array $input)
    {
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $input['username'],
            'password' => $input['password'],
//            'is_active' => 0, // u bazi je default 0
            'country_id' => $input['country'],
            'address' => $input['address'],
//            'avatar' => 'user.jpg',
        ]);
        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar')->getClientOriginalName();
            request()->file('avatar')->storeAs('avatars', $user->id . '/' . $avatar, '');
            $user->photo()->create(['url' => $avatar]);
        } else {
            $user->photo()->create(['url' => 'user.jpg']);
        }

        $user->roles()->attach([5]); // svaki novi korisnik je nomad
//            $user->photos()->create(['avatar' => 'default.jpg']);

        //        Mail::to($user->email)->send(new WelcomeMail());
        return $user && response()->json();
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//        $this->guard()->login($user); //? not login. This is from vendor RegistersUsers trait

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
