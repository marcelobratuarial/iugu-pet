<?php 

namespace App\Controllers;

// use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use \Firebase\JWT\JWT;
use App\Controllers\RegisterController;

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
        helper('cookie');
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

                $reg = new RegisterController();
                $t = $reg->code_verify($data);
                // print_r($t);
                if(is_array($t)) {
                    if($t["error"]) {
                        echo json_encode($t);
                        return;
                    } else {
                        echo "some thing";
                        return;
                    }
                    
                    
                } 
                // exit;
                // if($t && $t["error"]) {
                //     echo "eee";
                //     echo json_encode($t);
                    
                // } else {
                //     echo json_encode([
                //         "error" => true,
                //         "error_code" => "NEED_VER",
                //         "message" => "A verificação do código é necessária."
                //     ]);
                // }
                
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
                // var_dump(get_cookie("jwtteste"));
                // $c=1;
                // $ck = get_cookie("jwtteste");
                // while($ck === null) {
                //     echo "tenta ".$c;
                // set_cookie("jwtteste",$token, 3600);
                set_cookie([
                    'name' => 'jwtteste',
                    'value' => $token,
                    'expire' => 3600*24,
                    'httponly' => true
                ]);
                for($i = 1; $i < 100; $i++) {
                    
                    $ck = get_cookie("jwtteste");
                    if(gettype($ck) === NULL) {
                        // set_cookie("jwtteste",$token, 3600);
                        set_cookie([
                            'name' => 'jwtteste',
                            'value' => $token,
                            'expire' => 3600*24,
                            'httponly' => true
                        ]);
                    } else {
                        // return "<br>BREAK: ". $i. " => ".get_cookie("jwtteste");
                        break;
                    }
                    // echo "<br>";
                }
                //     echo "seta";
                //     $c++;
                //     $ck = get_cookie("jwtteste");
                // }
                return json_encode([
                    "status" => "OK",
                    "error" => false,
                    "message" => "Authorized"
                ]);
                // print_r(get_cookie("jwtteste"));
                // return redirect()->to('/dashboard');
            }else{
                return json_encode([
                    "status" => "ERROR",
                    "error_code" => "UNAUTH",
                    "error" => true,
                    "message" => "Usuário e/ou senha inválidos. Verifique e tente novamente."
                ]);
                // $session->setFlashdata('msg', 'wrong password.');
                // return redirect()->to('/login');
            }
        } else {
            return json_encode([
                "status" => "ERROR",
                "error_code" => "UNAUTH_NE",
                "error" => true,
                "message" => "Usuário e/ou senha inválidos. Verifique e tente novamente."
            ]);
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