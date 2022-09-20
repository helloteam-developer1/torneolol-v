<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $datos = DB::table('codigoregistro')
        ->where('cupon', $request->cupon)->get();
        //verificamos si primero existe un codigo de cupón.

        if(!$datos->isEmpty()){
            //consultamos  la base de datos si existe un codigo con tal cupón ingresado por el usuario y si esta activo 
            // es decir si nos retorna un 1 registre, en caso de que sea 0 no realice nada.
            $consulta = DB::select('select * from codigoregistro where cupon = ? and estatus = ?', [$request->cupon,'0']);
            
            //si la consulta me da  un indefinido, cupon no esta disponible
           if($consulta){
            $request->validate([
                'nombreusuario' => ['required', 'string', 'max:45', 'min:18'],
                'email' => ['required', 'email:rfc,dns', 'min:12', 'max:50' ,'unique:users,email'],
                'cupon' => ['required'],
            ]);
    
            $user = User::create([
                'nombreusuario' => $request->nombreusuario,
                'email' => $request->email,
                'cupon' =>$request->cupon,
            ]);
    
            event(new Registered($user));
    
            Auth::login($user);
    
            return redirect(RouteServiceProvider::HOME);
           }else{
            return "cupon ya canjeado";
           }

        }else{
            return "codigo no valido ingresa un codigo valido";
        }   
}
}