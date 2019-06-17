<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use App\User;

class AuthController extends Controller
{   
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;


    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */

    public function __construct(Request $request) {
        $this->request = $request;
    }


      /**
     * Create a new token.
     * 
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt", 
            'sub' => $user->id, 
            'iat' => time(), 
            'exp' => time() + 60*60 
        ];
        
        
        return JWT::encode($payload, env('JWT_SECRET'));
    } 

        /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\User   $user 
     * @return mixed
     */

    public function authenticate(User $user) {

        $this->validate($this->request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);


        $user = User::where('email', $this->request->input('email'))->first();
 
        if(Hash::check($this->request->input('password'), $user->password)){    
    
             return response()->json(['sucess' => true,'api_token' => $this->jwt($user)]);
    
         }else{
    
             return response()->json(['success' => false, "message" => "something wrong. Please try again!"],401);
    
         }       
    }
}
