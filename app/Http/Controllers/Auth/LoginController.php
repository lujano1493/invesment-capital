<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\Login\AuthUserLogin;

use App\Model\User;
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
    protected $redirectTo = 'capital/inicio';

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

            if($user->status == User::STATUS_ACTIVE ){
                throw ValidationException::withMessages([
                    'email' => ['El correo ya habia sido activado'],
                ]);
            }
            if ( !$user->updatePasswordSendActivation()){
                return $this->alertError("No fue posible enviar correo de activación.");
            }
            return  $this->alertSuccess("Se ha enviado un correo de activación.");
        }
        return view('home.send_email_activation');
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

            return $this->alertSuccess("el correo de recuperación de contraseña fue enviado correctamente.");
        }
        return view('home.send_email_password');
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
            return view('home.restore_password' ,compact('token'));
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

            return $this->alertSuccess("La contraseña fue restablecida correctamente.","login");


        }


    }



    public function active_user($token,Request $request){

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
            $credentials = $request->only('email','password');
            $msg="La cuenta de usuario fue activada correctamente.";
            if(!empty($credentials)){
                return  $this->alertSuccess("La cuenta de usuario fue activada correctamente.", ['loginget' , $credentials]);
            }
           return $this->alertSuccess("La cuenta de usuario fue activada correctamente. ya puede ingresar al sistema.",'login');

        }
        else{
            return $this->alertError("No fue posible activar la cuenta, vuelva intentar nuevamente.");

        }

    }




}
