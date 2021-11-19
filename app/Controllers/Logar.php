<?php 

namespace App\Controllers;

// use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use \Firebase\JWT\JWT;

class Logar extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        echo "teste";exit;
        // helper(['form']);
        // echo view('login');
    } 
  
    public function signin()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $model->where('email', $email)->first();
        // print_r($data);exit;
        if($data){
            $pass = $data['password'];
            $pwd_verify = password_verify($password, $pass);
            if($pwd_verify){
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'isSignedIn' => TRUE
                ];

                $session->set($ses_data);
                $key = getenv('JWT_SECRET');
                $iat = time(); // current timestamp value
                $exp = $iat + 3600;
        
                $payload = array(
                    "iss" => "Issuer of the JWT",
                    "aud" => "Audience that the JWT",
                    "sub" => "Subject of the JWT",
                    "iat" => $iat, //Time the JWT issued at
                    "exp" => $exp, // Expiration time of token
                    "email" => $data['email'],
                );
                
                $token = JWT::encode($payload, $key);
                print_r($session);
                // return redirect()->to('/dashboard');
            }else{
                // $session->setFlashdata('msg', 'wrong password.');
                // return redirect()->to('/login');
            }
        }
        // else{
        //     $session->setFlashdata('msg', 'wrong email.');
        //     return redirect()->to('/login');
        // }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}