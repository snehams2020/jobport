<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Otp;
use App\Models\User;

use Carbon\Carbon;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function sendOtp(Request $request){

        $six_digit_random_number = random_int(100000, 999999);
        $users = User::where('mobile',$request->mobile)
        //->whereDate('expire_at','<',Carbon::now())
        ->first();
        if(!empty($users)){

         Otp::create([
            'otp' => $six_digit_random_number ,
            'mobile' => $request['mobile'],
            'expire_at' => date("Y-m-d H:i:s", strtotime('+2 hours')),
            
        ]);
        return view('auth.mobileloginotp',['otp'=> $six_digit_random_number,'mobile'=>$request['mobile']]);
    }else{
        return back();
    }


    }


    public function submitOtp(Request $request){

         // $request->validate([
        //     'mobile' => 'required|numeric|min:10',
        //     'otp' => 'required|min:6|max:6|numeric'
        // ]);



        $users = Otp::where('mobile',$request->mobile)
        //->whereDate('expire_at','<',Carbon::now())
        ->orderBy('id','desc')->first();

        if(!empty($users)){

            if($request->otp==$users->otp){
                $credentials = $request->except(['_token','otp']);
                $user=User::where('mobile',$request->mobile)->first();
                Auth::login($user);

                return redirect('/home');

            }else{
                return view('auth.loginmobile');

            }

        }else{

            return view('auth.loginmobile');

        }
        


    }
}
