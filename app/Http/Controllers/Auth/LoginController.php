<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\Login\AuthUserLogin;

use App\User;
use App\Model\Tickets;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    use AuthUserLogin;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'invesment/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function send_email_activation(Request $request ){
        if($request->isMethod('post')){
            $this->validate($request,[ 'email' =>'required|email'] , ['email'=>'ingresa correo']);
            $email = $request->input('email');
            $user= User::where('email', $email)->first();
            if( $user == null){
                throw ValidationException::withMessages([
                    'email' => ['no se encontro ningun usuario asociado al correo'],
                ]);
            }

            if($user->status === User::STATUS_ACTIVE ){
                throw ValidationException::withMessages([
                    'email' => ['El correo ya habia sido activado'],
                ]);
            }


            $user->sendActiveUserNofication();
            $status="ok";
            $message="Se ha enviado un correo de activación.";
            $request->session()->flash('message-result',compact('status','message'  ));
        }
        return view('auth.send_email_activation');
    }


    public function send_email_password(Request $request ){
        if($request->isMethod('post')){
            $this->validate($request,[ 'email' =>'required|email'] , ['email'=>'ingresa correo']);
            $email = $request->input('email');
            $user= User::where('email', $email)->first();
            if( $user == null){
                throw ValidationException::withMessages([
                    'email' => ['no se encontro ningun usuario asociado al correo'],
                ]);
            }
            $entity_id= $user->id;
            $type = Tickets::TYPE_FORGET_PASSWORD_USER;
            $token= Tickets::createToken($type,$entity_id);
            $data= [
                "token" => $token,
                "name" => $user->name,
                "last_name" => $user->last_name
            ];

            $user->sendNotificationRestorePassword($data);

            $status="ok";
            $message="el correo de recuperación de contraseña fue enviado correctamente.";
            $request->session()->flash('message-result',compact('status','message'  ));
        }
        return view('auth.send_email_password');
    }

    public function restore_password(Request $request, $token){

        if( $token == null){
            throw new NotFoundHttpException('necesitas el token para continuar');
        }

        $ticket= Tickets::where('token',$token)->first();
        if($ticket ==null){
            throw new NotFoundHttpException('no se encontro ningun token en el sistema');
        }

        if( $request->isMethod('get') ){
            return view('auth.restore_password' ,compact('token'));
        }
        else{

            $this->validate($request,
                [
                    'token' => 'required',
                    'password' => 'required|confirmed|min:4',

                ],
                [
                    'token' => 'campo requerido',
                    'password' =>'contraseña requerida'

                ]
                );
            $user= User::find( $ticket->entity_id   );

            if($user == null){

                throw new NotFoundHttpException('no se encontro ningun usuario asociado al token');
            }

            $user->password = bcrypt($request->get('password'));

            $user->save();
            $ticket->delete();

            return redirect('login')->with('message-result' , ['status' => 'ok' , 'message' => 'La contraseña fue restablecida correctamente.']);


        }


    }



    public function active_user($token){

        $ticket= Tickets::where('token' ,$token)->first();

        if($ticket == null ){
           throw new NotFoundHttpException('no se encontro token para activar usuario, reenvie correo de activación.');
            
        }
        $user = User::find(  (int)$ticket->entity_id );
        if($user == null){
            throw new NotFoundHttpException("no se encontro ningun usuario, vuelva reenviar correo de activación");
        }
        $user->status= User::STATUS_ACTIVE;
        if ($user->save()){
            $ticket->delete();
            $status= "ok";
            $message = "La cuenta de usuario fue activada correctamente. ya puede ingresar al sistema.";
        }
        else{
            $status= "error";
            $message = "No fue posible activar la cuenta, vuelva intentar nuevamente.";

        }

        return redirect('login')->with('message-result',  compact(  'status',  'message' ));
    }


}
