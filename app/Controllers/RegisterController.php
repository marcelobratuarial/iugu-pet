<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;
use App\Controllers\Home;

// print_r($_POST["form_fields"]);exit;
// include("./Home.php");


class RegisterController extends BaseController
{
    use ResponseTrait;

    public $requestUrl;
    private $iuguUser;
    private $dbUser;
    public function __construct () {
        $a = new Home();
        $this->requestUrl = $a->baseApi . "customers";
        // echo $this->requestUrl;
        // exit;
    }

    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('user_register', $data);
    }
    public function checkCustomerMail() {
        helper(['form']);
        $rules = [
            'email' => [
                'rules' => [
                    'is_unique[customers.email]',
                ],
                'errors' => [
                    'is_unique' => 'Já existe um cadastro com esse email',
                ]
            ]
            // 'password'      => 'required|min_length[4]|max_length[50]',
            // 'confirmpassword'  => 'matches[password]'
        ];
        // var_dump($this->validate($rules));
        // print_r($this->request->getPostGet());exit;
        if (!$this->validate($rules)) {
            $validation = $this->validator;
            // echo "estes";
            if ($validation->hasError('email')) {
                echo $validation->getError('email');
            }
        }
    }

    public function code_verify($u = false) {
        helper(['form', "cookie"]);
        
        $isajax = (isset($this->request)) ? $this->request->isAJAX() : false;
        
        if($isajax) {
            
            $rules = [
                'code' => [
                    'rules' => [
                        'required',
                    ],
                    'errors' => [
                        'required' => 'Código necessário',
                    ]
                ]
                // 'password'      => 'required|min_length[4]|max_length[50]',
                // 'confirmpassword'  => 'matches[password]'
            ];
            // var_dump($this->validate($rules));
            // print_r($this->request->getPostGet());exit;
            if (!$this->validate($rules)) {
                $validation = $this->validator;
                // echo "estes";
                if ($validation->hasError('code')) {
                    return [
                        "error" => true,
                        "message" => $validation->getError('code')
                    ];
                }
            }
            $code = $this->request->getVar('code');
            $model = new UserModel();
            $ck = get_cookie("umail");
            // var_dump($ck);
            // var_dump(empty($ck));
            if(!empty($ck)) {
                $data = $model->where('email', $ck)->first();

                if($data["confirmation"] == $code) {
                    $uup = [
                        "id" => $data["id"],
                        "confirmation"=> NULL, 
                        "confirmed" => 1
                    ];
    
                    // print_r($uup);
                    $model->save($uup);

                    $ses_data = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'isSignedIn' => TRUE
                    ];
                    $session = session();
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
                    echo json_encode([
                        "error" => false,
                        "message" => "Código encontrado"
                    ]);
                    
                } else {
                    echo json_encode([
                        "error" => true,
                        "error_code" => "INV_CODE",
                        "message" => "Código inválido"
                    ]);
                }
            } else {
                echo "done";
            }
            
        } else if($u) {
            if($u["confirmed"] == 1) {
                return true;
            } else {
                $ck = get_cookie("umail");
                // var_dump($ck);
                // var_dump(empty($ck));
                if(!empty($ck) && $u["email"] == $ck) {
                    // echo "1";
                    return [
                        "error" => true,
                        "error_code" => "NEED_VER",
                        "message" => "A verificação do código é necessária.",
                        "custom_message" => "Verifique sua caixa de entrada e siga as instruções."
                    ];
                } else {
                    $a = $this->sendVerCode($u);
                    return [
                        "error" => true,
                        "error_code" => "NEED_VER_EXP",
                        "message" => "Código expirado",
                        "resend" => $a["resend"],
                        "custom_message" => $a["custom_message"]
                    ];
                }
                
            }
        } else {
            echo false;
            return false;
        }
        
        
       

        
        
    }


    public function store()
    {
        helper(['form']);
        $rules = [
            'name'  => [
                'rules' => 'required|min_length[2]|max_length[50]',
                'errors' => [
                    'required' => 'Obrigatório',
                ]
            ],
            'email' => [
                'rules' => [
                    'required',
                    'min_length[4]',
                    'max_length[100]',
                    'valid_email',
                    'is_unique[customers.email]',
                ],
                'errors' => [
                    'is_unique' => 'Já existe um cadastro com o email informado.',
                ]
            ],
            'password'  => [
                'rules' => [
                    'required',
                    'min_length[8]',
                    'max_length[50]'
                ],
                'errors' => [
                    'required' => 'Senha obrigatória.',
                    'min_length' => 'Senha muito curta. Min: 8',
                    'max_length' => 'Senha muito longa. Max : 50',
                ]
            ],
            'confirmpassword'  => [
                'rules' => [
                    'matches[password]'
                ],
                'errors' => [
                    'matches' => 'Senha de confirmação deve ser idêntica.'
                ]
            ],
            'cep'  => [
                'rules' => 'required|min_length[8]|max_length[10]',
                'errors' => [
                    'required' => 'Obrigatório.',
                ]
            ],
            'address'  => [
                'rules' => 'required|min_length[2]|max_length[50]',
                'errors' => [
                    'required' => 'Obrigatório.',
                ]
            ],
            'number'  => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Obrigatório',
                ]
            ],  
            'bairro'  => [
                'rules' => 'required|min_length[2]|max_length[50]',
                'errors' => [
                    'required' => 'Obrigatório',
                ]
            ],  
            'cidade'  => [
                'rules' => 'required|min_length[2]|max_length[150]',
                'errors' => [
                    'required' => 'Obrigatório',
                ]
            ],  
            'estado'  => [
                'rules' => 'required|min_length[2]|max_length[150]',
                'errors' => [
                    'required' => 'Obrigatório',
                ]
            ],  
            // 'pet_name'  => [
            //     'rules' => 'required|min_length[1]|max_length[150]',
            //     'errors' => [
            //         'required' => 'Obrigatório',
            //     ]
            // ],  
            // 'pet_nasc'  => [
            //     'rules' => 'required|min_length[2]|max_length[150]',
            //     'errors' => [
            //         'required' => 'Obrigatório',
            //     ]
            // ],  
            // 'pet_raca'  => [
            //     'rules' => 'required|min_length[2]|max_length[150]',
            //     'errors' => [
            //         'required' => 'Obrigatório',
            //     ]
            // ],  
            // 'pet_peso'  => [
            //     'rules' => 'required|min_length[1]|max_length[150]',
            //     'errors' => [
            //         'required' => 'Obrigatório',
            //     ]
            // ],  
        ];
        // var_dump($this->validate($rules));
        // print_r($this->request->getPost());exit;
        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            try {
                if ($model->save($data)) {
                    $cep = str_replace('.', '', $this->request->getVar('cep')) ;
                    $cep = str_replace('-', '', $cep) ;
                    $dbID = $model->insertID();
                    $nu = $model->find($dbID);
                    $this->dbUser = $nu;
                    $iuguData = [
                        "email" => $this->request->getVar('email'),
                        "name" => $this->request->getVar('name'),
                        "number" => $this->request->getVar('number'),
                        "zip_code" => $cep,
                        "street" => $this->request->getVar('address'),
                        "city" => $this->request->getVar('cidade'),
                        "state" => $this->request->getVar('estado'),
                        "district" => $this->request->getVar('bairro'),
                        "complement" => $this->request->getVar('complemento'),
                        // "custom_variables" => [
                        //     [
                        //         "name" => "pet_name",
                        //         "value" => $this->request->getVar('pet_name')
                        //     ],
                        //     [  
                        //         "name" => "pet_nasc",
                        //         "value" => $this->request->getVar('pet_nasc')
                        //     ],
                        //     [
                        //         "name" => "pet_raca",
                        //         "value" => $this->request->getVar('pet_raca')
                        //     ],
                        //     [
                        //         "name" => "pet_peso",
                        //         "value" => $this->request->getVar('pet_peso')
                        //     ]
                        // ]
                    ];
                    // print_r($iuguData);exit;
                    $a = new Home();
                    $args = [
                        "m" => "POST",
                        "pl" => json_encode($iuguData)
                    ];
                    
                    try {
                            $r = $a->doRequest($this->requestUrl, $args);
                            $rr = json_decode($r, true);
                            if(isset($rr["errors"])) {
                                $model->delete($dbID);
                                echo json_encode($rr);
                                throw new \Exception($rr);
                            }
                            $this->iuguUser = $rr;
                    } catch (\Exception $th) {
                        
                    }
                //    echo $a->baseApi;
                    
                    
    
                    // print_r($rr);exit;
    
                    $response = $this->SendVerCode($dbID);
                    echo json_encode($response);
                    // if($response["error"]) {
                    //     echo json_encode($response);
                    // } else {
                    //     print_r($response);
                    // }
                    
    
                    // print_r($r);exit;
                } else {
                    $rr = json_encode([
                        'error' => true,
                        'message' => "Usuário não criado no banco de dados.",
                        'error_code' => "USER_NOT_CREATED_DB"
                    ]);
                    throw new \Exception($rr, 100000000);
                    exit;
                }
            } catch (\Exception $e) {
                print_r($e->getMessage());
                exit;
                //throw $th;
            }
            

            // return redirect()->to('/login');
        } else {
            $validation = $this->validator;
            // echo "estes";
            // if ($validation->hasError('password')) {
            //     print_r($validation->getErrors('password'));
            // }
            // if ($validation->hasError('confirmpassword')) {
            //     print_r($validation->getErrors('confirmpassword'));
            // }
            $errors = $validation->getErrors();
            $response = [
                "error" => true,
                "error_code" => "REQ_FIELDS",
                "message" => "Verifique os campos obrigatórios",
                "errors" => $errors
            ];
            

            echo json_encode($response);
            exit;
            // print_r($data['validation']);
            // echo view('user_register', $data);
        }
    }

    public function getVCode() {
        $p1 = rand(100,999);
        $p2 = rand(100,999);
        $p = [
            "v1"=> $p1.' '.$p2,
            "v2"=> $p1 . $p2
        ];
        return $p;
    }


    public function sendVerCode($u = false) {
        helper("cookie");
        if(is_integer($u)) {
            $dbID = $u;
        } else {$dbID = null;}
        $email = \Config\Services::email();
        $model = new UserModel();
        
        $config['mailType'] = 'html';
        $config['SMTPTimeout'] = '20';
        $config['protocol'] = 'smtp';
        // $config['CRLF'] = "\r\n";
        // $config['newline'] = "\r\n";
        $config['SMTPHost'] = $_SERVER['SMTP_HOST'];
        $config['SMTPUser'] = $_SERVER['SMTP_USER'];
        $config['SMTPPass'] = $_SERVER['SMTP_PASS'];
        $config['SMTPPort'] = $_SERVER['SMTP_PORT'];
        $config['SMTPCrypto'] = $_SERVER['SMTP_CRYPTO'];
        $email->initialize($config);

        $email->setSubject('Confirmação de cadastro');
        $email->setFrom('marcelodmdo@gmail.com', "Site");
        $email->setTo(is_array($u) ? $u["email"] : $this->request->getVar('email'), is_array($u) ? $u["name"] : $this->request->getVar('name'));
        $email->setCC('marcelo.denis@agenciabrasildigital.com.br, marcelodmdo@gmail.com');

        $vCod = $this->getVCode();
        $conf = [
            'name' => is_array($u) ? $u["name"] : $this->request->getVar('name'),
            'code' => $vCod["v1"]
        ];
        $message = view('mail/codConfirm', $conf);

        $email->setMessage($message);
        
        try {
            $s = $email->send();
            // print_r($email->printDebugger());exit;
            if($s) {
                unset($nu);

                $nu = [
                    "id" => (is_array($u)) ? $u["id"] : $dbID,
                    "confirmation"=>$vCod['v2'], 
                    "code_sent" => 1
                ];

                // print_r($nu);
                $model->save($nu);
                
                // set_cookie("umail",$this->request->getVar('email'), 3600);
                $m = is_array($u) ? $u["email"] : $this->request->getVar('email');
                set_cookie([
                    'name' => 'umail',
                    'value' => $m,
                    'expire' => 3600,
                    'httponly' => true
                ]);
                for($i = 1; $i < 100; $i++) {
                    
                    $ck = get_cookie("umail");
                    if(gettype($ck) === NULL) {
                        // set_cookie("umail",$m, 3600);
                        set_cookie([
                            'name' => 'umail',
                            'value' => $m,
                            'expire' => 3600,
                            'httponly' => true
                        ]);
                    } else {
                        // return "<br>BREAK: ". $i. " => ".get_cookie("jwtteste");
                        break;
                    }
                    // echo "<br>";
                }
                // var_dump($u);
                // exit;
                $m = is_array($u) ? $u["email"] : $this->request->getVar('email');
                $cm = 'Um código de verificação foi enviado para <strong>'. $m .'</strong>.<br>';
                $cm .= 'Para continuar, acesse sua caixa de entrada e siga as instruções.';
                $response = ["message" => "success", "error" => false, "custom_message"=>$cm, "resend" =>is_array($u)];
                if(is_array($u)) {
                    return $response;
                }
                return $response;
                exit;
            } else {
                unset($nu);

                $nu = [
                    "id" => (is_array($u)) ? $u["id"] : $dbID,
                    "code_sent" => 0
                ];

                // print_r($nu);
                $model->save($nu);
                $err = json_encode([
                    "message" => "Email não enviado",
                    "error_code" => "VER_CODE_NOT_SENT",
                    'e'=> $s
                ]);
                throw new \Exception($err);
            }
            
        } catch (\Exception $e) {
            $er = json_decode($e->getMessage(), true);
            // print_r($er);exit;
            if($er["error_code"] == 'VER_CODE_NOT_SENT') {
                if(!is_null($this->dbUser)) {
                    $model = new UserModel();
                    $model->delete($this->dbUser["id"]);
                    $a = new Home();
                    $args = [];
                    $args["m"] = "DELETE";
                    $this->requestURL = $a->baseApi . "customers/".$this->iuguUser["id"];
                    // print_r($this->requestURL);
                    $args["pl"] = json_encode([
                        "id" => $this->iuguUser["id"]
                    ]);
                    $user = $a->doRequest($this->requestURL, $args);
                    // var_dump($user);
                }
                
            }
            return [
                'e' => $er['e'],
                'message' => $er['message'],
                'error' => true,
                'error_code' => $er['error_code']
            ];
        }

    }
}
