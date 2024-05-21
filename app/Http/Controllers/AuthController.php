<?php
  
namespace App\Http\Controllers;
   
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Auth;
   
class AuthController extends Controller
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
    protected $redirectTo = '/';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login');
    }

    public function registrasi()
    {
        return view('registrasi');
    }

    public function actionRegistrasi(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->no_telp = $request->no_telp;
        $user->alamat = $request->alamat;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = "user";
        $user->save();
        return redirect()->route('login')->with('success', "Registrasi Berhasil Silahkan Untuk Login !");
    }
   
    public function actionLogin(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->role == "admin") {
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('dashboard');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email And Password Are Wrong.');
        }
          
    }
    
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
