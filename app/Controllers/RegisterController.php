<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

use App\Controllers\Home;

// print_r($_POST["form_fields"]);exit;
// include("./Home.php");


class RegisterController extends BaseController
{
    use ResponseTrait;

    public $requestUrl;
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
                        'is_unique' => 'Código necessário',
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
            if($data["confirmation"] == $code) {
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
                        "message" => "A verificação do código é necessária."
                    ];
                } else {
                    $a = $this->sendVerCode($u);
                    return [
                        "error" => true,
                        "error_code" => "NEED_VER_EXP",
                        "message" => "Código expirado",
                        "resend" => $a["resend"]
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
                    'required' => 'We really need youdr email.',
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
            ]
        ];
        // var_dump($this->validate($rules));
        // print_r($this->request->getPostGet());exit;
        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            
            if ($model->save($data)) {
                $dbID = $model->insertID();
                $nu = $model->find($dbID);
                
                $iuguData = [
                    "email" => $this->request->getVar('email'),
                    "name" => $this->request->getVar('name'),
                    "number" => $this->request->getVar('number'),
                    "street" => $this->request->getVar('street'),
                    "city" => $this->request->getVar('cidade'),
                    "state" => $this->request->getVar('estado'),
                    "district" => $this->request->getVar('bairro'),
                    "complement" => $this->request->getVar('complemento'),
                    "custom_variables" => [
                        [
                            "name" => "pet_name",
                            "value" => $this->request->getVar('pet_name')
                        ],
                        [  
                            "name" => "pet_nasc",
                            "value" => $this->request->getVar('pet_nasc')
                        ],
                        [
                            "name" => "pet_raca",
                            "value" => $this->request->getVar('pet_raca')
                        ],
                        [
                            "name" => "pet_peso",
                            "value" => $this->request->getVar('pet_peso')
                        ]
                    ]
                ];
               $a = new Home();
               $args = [
                   "m" => "POST",
                   "pl" => json_encode($iuguData)
               ];
               
            //    echo $a->baseApi;
                $r = $a->doRequest($this->requestUrl, $args);
                $rr = json_decode($r, true);
                if(isset($rr["errors"])) {
                    $model->delete($dbID);
                    echo json_encode($rr);
                    exit;
                }

                // print_r($rr);exit;

                $this->SendVerCode($dbID);

                // print_r($r);exit;
            };

            // return redirect()->to('/login');
        } else {
            $validation = $this->validator;
            // echo "estes";
            if ($validation->hasError('password')) {
                print_r($validation->getErrors('password'));
            }
            if ($validation->hasError('confirmpassword')) {
                print_r($validation->getErrors('confirmpassword'));
            }
            // print_r($this->validator);
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
        if(is_integer($u)) {
            $dbID = $u;
        }
        $email = \Config\Services::email();
        $model = new UserModel();
        
        $config['mailType'] = 'html';
        $config['SMTPTimeout'] = '20';
        $config['protocol'] = 'smtp';
        // $config['CRLF'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['SMTPHost'] = $_SERVER['SMTP_HOST'];
        $config['SMTPUser'] = $_SERVER['SMTP_USER'];
        $config['SMTPPass'] = $_SERVER['SMTP_PASS'];
        $config['SMTPPort'] = $_SERVER['SMTP_PORT'];
        $config['SMTPCrypto'] = $_SERVER['SMTP_CRYPTO'];
        $email->initialize($config);

        $email->setSubject('Confirmação de cadastro');
        $email->setFrom('contato@brasilbeneficios.club', "Site");
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
            if($s) {
                unset($nu);

                $nu = [
                    "id" => (is_array($u)) ? $u["id"] : $dbID,
                    "confirmation"=>$vCod['v2'], 
                    "code_sent" => 1
                ];

                // print_r($nu);
                $model->save($nu);
                helper("cookie");
                // set_cookie("umail",$this->request->getVar('email'), 3600);
                set_cookie([
                    'name' => 'umail',
                    'value' => is_array($u) ? $u["email"] : $this->request->getVar('email'),
                    'expire' => 3600,
                    'httponly' => true
                ]);
                for($i = 1; $i < 100; $i++) {
                    
                    $ck = get_cookie("umail");
                    if(gettype($ck) === NULL) {
                        // set_cookie("umail",$this->request->getVar('email'),  3600);
                        set_cookie([
                            'name' => 'umail',
                            'value' => is_array($u) ? $u["email"] : $this->request->getVar('email'),
                            'expire' => 3600,
                            'httponly' => true
                        ]);
                    } else {
                        // return "<br>BREAK: ". $i. " => ".get_cookie("umail");
                        break;
                    }
                    // echo "<br>";
                }
                // var_dump($a);exit;
                $m = is_array($u) ? $u["email"] : $this->request->getVar('name');
                $cm = 'Um código de verificação foi enviado para <strong>'. $m .'</strong>.<br>';
                $cm .= 'Para continuar, acesse sua caixa de entrada e siga as instruções.';
                if(is_array($u)) {
                    return ["message" => "success", "error" => false, "custom_message"=>$cm, "resend" =>is_array($u)];
                }
                echo json_encode(["message" => "success", "error" => false, "custom_message"=>$cm, "resend" =>is_array($u)]);
            } else {
                unset($nu);

                $nu = [
                    "id" => (is_array($u)) ? $u["id"] : $dbID,
                    "code_sent" => 0
                ];

                // print_r($nu);
                $model->save($nu);
                throw new \Exception("Não enviado: MAIL");
            }
            
        } catch (\Exception $e) {
            echo json_encode(['message'=>$e->getMessage(), 'error' => true]);
        }

    }
}
