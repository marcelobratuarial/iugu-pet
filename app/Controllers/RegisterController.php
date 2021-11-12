<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UserModel;


use App\Controllers\Home;

// print_r($_POST["form_fields"]);exit;
// include("./Home.php");


class RegisterController extends BaseController
{
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
            ]// 'password'      => 'required|min_length[4]|max_length[50]',
            // 'confirmpassword'  => 'matches[password]'
        ];
        // var_dump($this->validate($rules));
        // print_r($this->request->getPostGet());exit;
        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                // 'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            
            if ($model->save($data)) {
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
               print_r($r);exit;
            };

            // return redirect()->to('/login');
        } else {
            $validation = $this->validator;
            // echo "estes";
            if ($validation->hasError('email')) {
                echo $validation->getError('email');
            }
            // print_r($this->validator);
            exit;
            // print_r($data['validation']);
            // echo view('user_register', $data);
        }
    }
}
