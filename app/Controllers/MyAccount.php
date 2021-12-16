<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;
use App\Models\UserModel;
use App\Models\PetModel;
use App\Controllers\Home;
use Exception;
use CodeIgniter\I18n\Time;

class MyAccount extends BaseController
{
    use ResponseTrait;
    private $payload;
    public $requestURL;
    protected $k;
    private $dbUser;

    public function __construct () {
        
        $this->requestURL = "";
    }

    public function index()
    {
        session();
        $a = new Home();
        // echo "你好";exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $a->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $a->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        }
        if(empty($user)) {
            return redirect()->to('minha-conta/login'); 
        }
        $uid = $user["id"];
        $petModel = new PetModel();
        $pets = $petModel
            ->where("cid", $uid)
            ->findAll();
        $petsIdx = [];
        foreach($pets as $pet) {
            if(!empty($pet["aid"])) {
                $petsIdx[$pet["aid"]] = $pet;
            }
        }
        // print_r($petsIdx);exit;
        // print_r($uid);exit;
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => $uid, //"74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "suspended"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas_suspensas = json_decode($r, true)["items"];
        
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => $uid, //"74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "active"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas_ativas = json_decode($r, true)["items"];
        
        $assinaturas = array_merge($assinaturas_ativas, $assinaturas_suspensas);
        // echo "<pre>";
        helper("number");
        foreach($assinaturas as $k=> $a) {
            $decimal = number_format(($a['price_cents'] /100), 2, '.', ' ');
            $assinaturas[$k]['decimal'] = $decimal;
            $assinaturas[$k]['real'] = number_to_currency($decimal, $a['currency'], null, 2);
            $date = date_create($a['cycled_at']);
            $expi = date_create($a['expires_at']);
            $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
            // echo $periodo;
            $assinaturas[$k]['periodo'] = $periodo;
            if(isset($petsIdx[$a['id']])) {
                $assinaturas[$k]['pet'] = $petsIdx[$a['id']];
            }
            // number_to_currency($a['price_cents'])
        }



        $user_default_payment = NULL;
        $dft_pmt = NULL; 
        if(isset($user["default_payment_method_id"]) &&
        !empty($user["default_payment_method_id"])) {
            $dft_pmt = $user["default_payment_method_id"];
        }
            // echo "<pre>";
            // print_r($user);
        if(isset($user["payment_methods"]) && 
            !empty($user["payment_methods"])) {
            foreach($user["payment_methods"] as $k=> $pm) {
                
                if($pm["id"] == $dft_pmt) {
                    $user["payment_methods"][$k]['default'] = true;
                    $user_default_payment = $pm;
                } else {
                    $user["payment_methods"][$k]['default'] = false;
                }
            }
        }
        // print_r($user);exit;
        return view('account/dashboard', ["assinaturas" => $assinaturas, "dft_payment"=>$user_default_payment, "user"=>$user]);
    }
    public function cartoes()
    {
        session();
        $a = new Home();
        // echo "你好";exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $a->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $a->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        }
        $uid = $user["id"];
        // print_r($uid);exit;
        // $args = [];
        // $this->requestURL = $a->baseApi . "subscriptions";
        // $args["m"] = "GET";
        // $args["pl"] = json_encode([
        //     "customer_id" => "74AE1E1406354345AE23CCC30DAA5BD6",
        //     "status_filter" => "active"
        // ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }


        $user_default_payment = NULL;
        $dft_pmt = NULL; 
        if(isset($user["default_payment_method_id"]) &&
        !empty($user["default_payment_method_id"])) {
            $dft_pmt = $user["default_payment_method_id"];
        }
            // echo "<pre>";
            // print_r($user);
        if(isset($user["payment_methods"]) && 
            !empty($user["payment_methods"])) {
            foreach($user["payment_methods"] as $k=> $pm) {
                
                if($pm["id"] == $dft_pmt) {
                    $user["payment_methods"][$k]['default'] = true;
                    $user_default_payment = $pm;
                } else {
                    $user["payment_methods"][$k]['default'] = false;
                }
            }
        }
        // print_r($user);exit;
        return view('account/cartoes', ["dft_payment"=>$user_default_payment, "user"=>$user, "payment"=>$user_default_payment]);
    }
    public function assinaturas()
    {
        session();
        $a = new Home();
        // echo "你好";exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $a->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $a->doRequest($this->requestURL, $args);
            // print_r(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        }
        // print_r($user);exit;
        $uid = $user["id"];

        $petModel = new PetModel();
        $pets = $petModel
            ->where("cid", $uid)
            ->findAll();
        $petsIdx = [];
        foreach($pets as $pet) {
            if(!empty($pet["aid"])) {
                $petsIdx[$pet["aid"]] = $pet;
            }
        }
        // print_r($petsIdx);exit;


        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => $uid, //"74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "suspended"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas_suspensas = json_decode($r, true)["items"];
        
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => $uid, //"74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "active"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas_ativas = json_decode($r, true)["items"];
        
        $assinaturas = array_merge($assinaturas_ativas, $assinaturas_suspensas);
        // echo "<pre>";
        // print_r($assinaturas);exit;
        helper("number");
        foreach($assinaturas as $k=> $a) {
            $decimal = number_format(($a['price_cents'] /100), 2, '.', ' ');
            $assinaturas[$k]['decimal'] = $decimal;
            $assinaturas[$k]['real'] = number_to_currency($decimal, $a['currency'], null, 2);
            $date = date_create($a['cycled_at']);
            $expi = date_create($a['expires_at']);
            $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
            // echo $periodo;
            $assinaturas[$k]['periodo'] = $periodo;
            if(isset($petsIdx[$a['id']])) {
                $assinaturas[$k]['pet'] = $petsIdx[$a['id']];
            }
            // number_to_currency($a['price_cents'])
        }
        // print_r($assinaturas);exit;
        return view('account/assinaturas', ["assinaturas" => $assinaturas, "user"=>$user]);
    }
    public function pets()
    {
        session();
        $a = new Home();
        // echo "你好";exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $a->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $a->doRequest($this->requestURL, $args);
            // print_r(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        }
        // print_r($user);exit;
        $uid = $user["id"];

        $petModel = new PetModel();
        $pets = $petModel
            ->where("cid", $uid)
            ->findAll();
        
        // print_r($petsIdx);exit;


        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => $uid, //"74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "suspended"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas_suspensas = json_decode($r, true)["items"];
        
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => $uid, //"74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "active"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas_ativas = json_decode($r, true)["items"];
        
        $assinaturas = array_merge($assinaturas_ativas, $assinaturas_suspensas);
        // echo "<pre>";
        // print_r($assinaturas);exit;
        helper("number");
        foreach($assinaturas as $k=> $a) {
            
            $decimal = number_format(($a['price_cents'] /100), 2, '.', ' ');
            $assinaturas[$k]['decimal'] = $decimal;
            $assinaturas[$k]['real'] = number_to_currency($decimal, $a['currency'], null, 2);
            $date = date_create($a['cycled_at']);
            $expi = date_create($a['expires_at']);
            $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
            // echo $periodo;
            $assinaturas[$k]['periodo'] = $periodo;
            $today = Time::createFromDate();
            $expi2 = Time::createFromFormat('d/m/Y', $expi->format('d/m/Y'));
            $assinaturas[$k]['isValid'] = $today->isBefore($expi2);
            // $assinaturas[$k]['time2'] = Time::createFromFormat('d/m/Y', $date->format('d/m/Y'));
            // number_to_currency($a['price_cents'])
        }
        $assinaturasIdx = [];
        foreach($assinaturas as $ass) {
            $assinaturasIdx[$ass["id"]] = $ass;
        }

        foreach($pets as $i=> $pet) {
            if(!empty($pet["aid"]) && isset($assinaturasIdx[$pet["aid"]])) {
                $pets[$i]["assinatura"] = $assinaturasIdx[$pet["aid"]];
            } 
        }
        // print_r($pets);exit;
        return view('account/pets', ["pets" => $pets, "user"=>$user]);
    }
    public function login() {
        $items = file_get_contents(ROOTPATH."/content/estados.json");
        $estados = json_decode($items, false); 
        return view("account/login", ["user"=> [], "estados"=>$estados]);
    }
    public function assinatura($id)
    {
        helper("number");
        $a = new Home();
        // // parent::Controller();
        session();
        // echo "<pre>";print_r($a->get("name"));exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $a->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $a->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        } else {
            $user = [];
        }
        $petModel = new PetModel();
        $petAssinatura = $petModel
            ->where("cid", $user['id'])
            ->where("aid", $id)
            ->first();
        // print_r($petAssinatura);exit;
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions/".$id;
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            'id' => $id
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $assinatura = json_decode($a->doRequest($this->requestURL, $args),true);
        if(isset($assinatura["errors"])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $args = [];
        $this->requestURL = $a->baseApi . "plans/identifier/".$assinatura["plan_identifier"];
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "identifier" => $assinatura["plan_identifier"]
        ]);
        
        $plano = $a->doRequest($this->requestURL, $args);
        $assinatura["plano"] = json_decode($plano, true);
        $assinatura["pet"] = $petAssinatura;
        // print_r($assinatura);
        foreach($assinatura['recent_invoices'] as $i=> $ri): 
            // print_r($ri);
            if(is_numeric($ri['total'])) {
                $decimal = number_format(($ri['total'] /100), 2, '.', ' ');
                $assinatura['recent_invoices'][$i]['decimal'] = $decimal;
            }
            if($ri['status'] == 'paid') {
                $assinatura['recent_invoices'][$i]['status'] = "Pago";
            }
            // 
            // $assinatura['real'] = number_to_currency($decimal, $assinatura['currency'], null, 2);
                // $assinatura['recent_invoices'][$i]['decimal'] = $decimal;
            $due_date = date_create($ri['due_date']);
            $data = $due_date->format('d/m/Y');
            // // echo $due_date;
            $assinatura['recent_invoices'][$i]['data'] = $data;
        endforeach;

        foreach($assinatura['logs'] as $i=> $log): 
            $due_date = date_create($log['created_at']);
            $data = $due_date->format('d/m/Y H:i:s');
            // // echo $due_date;
            $assinatura['logs'][$i]['data'] = $data;
        endforeach;
        // exit;
        // print_r($assinatura['recent_invoices']);exit;
        $decimal = number_format(($assinatura['price_cents'] /100), 2, '.', ' ');
        $assinatura['decimal'] = $decimal;
        // print_r($assinatura);exit;
        $assinatura['real'] = number_to_currency($decimal, $assinatura['currency'], null, 2);
        $date = date_create($assinatura['cycled_at']);
        $expi = date_create($assinatura['expires_at']);
        $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
        // echo $periodo;
        $assinatura['periodo'] = $periodo;
        
        
        
        return view('account/assinatura', ["assinatura" => $assinatura,true, "user" => $user]);

    }
    public function pet($id)
    {
        helper("number");
        $a = new Home();
        // // parent::Controller();
        session();
        // echo "<pre>";print_r($a->get("name"));exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $a->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $a->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        } else {
            $user = [];
        }
        $petModel = new PetModel();
        $petAssinatura = $petModel
            ->where("cid", $user['id'])
            ->where("id", $id)
            ->first();
        if(!empty($petAssinatura['aid'])) {
            $args = [];
            $this->requestURL = $a->baseApi . "subscriptions/".$petAssinatura['aid'];
            $args["m"] = "GET";
            $args["pl"] = json_encode([
                'id' => $petAssinatura['aid']
            ]);
            // print_r($args);exit;
            $assinatura = json_decode($a->doRequest($this->requestURL, $args),true);
            // print_r($assinatura);exit;
            if(isset($assinatura["errors"])) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $args = [];
            $this->requestURL = $a->baseApi . "plans/identifier/".$assinatura["plan_identifier"];
            $args["m"] = "GET";
            $args["pl"] = json_encode([
                "identifier" => $assinatura["plan_identifier"]
            ]);
            
            $plano = $a->doRequest($this->requestURL, $args);
            $assinatura["plano"] = json_decode($plano, true);
            $petAssinatura["assinatura"] = $assinatura;
        }
        
        
        
        
        
        return view('account/pet', ["pet" => $petAssinatura,true, "user" => $user]);

    }
    public function cartao($id)
    {
        helper("number");
        $a = new Home();
        // // parent::Controller();
        session();
        // echo "<pre>";print_r($a->get("name"));exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $a->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $a->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        } else {
            $user = [];
        }
        

        $args = [];
        $this->requestURL = $a->baseApi . "customers/". $user["id"] . "/payment_methods/" .$id;
        $args["m"] = "GET";
        // print_r($this->requestURL);exit;
        $args["pl"] = json_encode([
            'id' => $id,
            'customer_id' => $user["id"]
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $cartao = json_decode($a->doRequest($this->requestURL, $args),true);
        if(isset($cartao["errors"])) {
            session()->setFlashdata("card_not_found", $cartao["errors"] );
            return redirect()->to('minha-conta/cartoes'); 
        }
        
        $user_default_payment = NULL;
        $dft_pmt = NULL; 
        if(isset($user["default_payment_method_id"]) &&
        !empty($user["default_payment_method_id"])) {
            $dft_pmt = $user["default_payment_method_id"];
        }

        if($cartao["id"] == $dft_pmt) {
            $cartao['default'] = true;
        } else {
            $cartao['default'] = false;
        }
           
        
        
        return view('account/cartao', ["cartao" => $cartao,true, "user" => $user]);

    }

    public function account()
    {
        session();
        $a = new Home();
        // echo "你好";exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $a->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $a->doRequest($this->requestURL, $args);
            // print_r(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        }
        // print_r($user);exit;
        $uid = $user["id"];
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => $uid, //"74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "suspended"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas_suspensas = json_decode($r, true)["items"];
        
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => $uid, //"74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "active"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas_ativas = json_decode($r, true)["items"];
        
        $assinaturas = array_merge($assinaturas_ativas, $assinaturas_suspensas);
        // echo "<pre>";
        // print_r($assinaturas);exit;
        helper("number");
        foreach($assinaturas as $k=> $a) {
            $decimal = number_format(($a['price_cents'] /100), 2, '.', ' ');
            $assinaturas[$k]['decimal'] = $decimal;
            $assinaturas[$k]['real'] = number_to_currency($decimal, $a['currency'], null, 2);
            $date = date_create($a['cycled_at']);
            $expi = date_create($a['expires_at']);
            $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
            // echo $periodo;
            $assinaturas[$k]['periodo'] = $periodo;
            // number_to_currency($a['price_cents'])
        }
        $items = file_get_contents(ROOTPATH."/content/estados.json");
        $estados = json_decode($items, false);
        // print_r($user);exit;
        return view('account/my-data', ["assinaturas" => $assinaturas, "user"=>$user, "estados" => $estados]);
    }

    public function savePet() {
        $PetModel = new PetModel();
        $data = (array) $this->request->getPost();
        if(empty($data)) {
            $data = (array) $this->request->getJSON();
        }
        $session = session();
        $session->get('email');
        $args_ = [];
        $args_["m"] = "GET";
        $a = new Home();
        $this->requestURL = $a->baseApi . "customers";
        $args_["pl"] = json_encode([
            "query" => $session->get('email'),
            "limit" => 1
        ]);
        $user = $a->doRequest($this->requestURL, $args_);
        // echo gettype(json_decode($user, true));exit;
        $u = json_decode($user, true)["items"][0];
        
        if(!empty($u)) {
            $data["cid"] = $u['id'];
        }
        $response = service('response');
        try {
            $saved = $PetModel->save($data);
            
            if($saved) {
                $dbID = $PetModel->insertID();
                $pet = $PetModel->find($dbID);
                return $response->setJSON([
                    "error" => false,
                    'message' => "Seu Pet foi cadastrado com sucesso!",
                    'pet_data' => $pet
                ]);
            }
        } catch (Exception $ex) {
            return $response->setJSON([
                "error" => true,
                'message' => "Erro ao salvar cadastro do seu Pet. Tente novamente. Se o erro persistir, entre em contato.",
                'pl' => $ex->getMessage()
            ]);
        }
        
    }

    public function saveMyData()
    {
        helper(['form']);
        session();
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
                ],
                
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
        ];
        // var_dump($this->validate($rules));
        // print_r($this->request->getPost());exit;
        if ($this->validate($rules)) {
            $model = new UserModel();
            if(isset($_SESSION['email'])) {
                $this->dbUser = $model->where("email", $_SESSION['email'])->first();
            } else {
                return redirect()->to('/login');
            }
            

            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
            ];
            
            try {
                if ($model->update($this->dbUser['id'], $data)) {
                   
                    $a = new Home();
                    $args = [];
                    $args["m"] = "GET";
                    $this->requestURL = $a->baseApi . "customers";
                    $args["pl"] = json_encode([
                        "query" => $_SESSION['email'],
                        "limit" => 1
                    ]);
                    $user = $a->doRequest($this->requestURL, $args);
                    
                    $u = json_decode($user, true);
                    unset($user);
                    $user = [];
                    if($u["totalItems"] > 0) {
                        $user = $u['items'][0];
                    }
                    $cep = str_replace('.', '', $this->request->getVar('cep')) ;
                    $cep = str_replace('-', '', $cep) ;
                    
                    
                    $iuguData = [
                        // "email" => $this->request->getVar('email'),
                        "name" => $this->request->getVar('name'),
                        "number" => $this->request->getVar('number'),
                        "zip_code" => $cep,
                        "street" => $this->request->getVar('address'),
                        "city" => $this->request->getVar('cidade'),
                        "state" => $this->request->getVar('estado'),
                        "district" => $this->request->getVar('bairro'),
                        "complement" => $this->request->getVar('complemento'),
                        "customer_id" => $user["id"]
                    ];
                    // print_r($iuguData);exit;
                    $a = new Home();
                    $args = [];
                    $args["m"] = "PUT";
                    $this->requestURL = $a->baseApi . "customers/".$user["id"];
                    $args["pl"] = json_encode($iuguData);
                    

                    
                    
                        $r = $a->doRequest($this->requestURL, $args);
                        $rr = json_decode($r, true);
                        if(isset($rr["errors"])) {
                            
                            echo json_encode($rr);
                           
                            throw new \Exception($rr);
                        } else {
                            return $this->response->setJSON($rr);
                           
                        }
                    
                    
                    

                    
                } else {
                    $rr = json_encode([
                        'error' => true,
                        'message' => "Erro ao gravar atualizações.",
                        'error_code' => "USER_DATA_UPDATE_FAIL"
                    ]);
                    throw new \Exception($rr, 100000001);
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
            
            $errors = $validation->getErrors();
            $response = [
                "error" => true,
                "error_code" => "REQ_FIELDS",
                "message" => "Verifique os campos obrigatórios",
                "errors" => $errors
            ];
            

            echo json_encode($response);
            exit;
        }
    }

    public function saveNewPass()
    {
        helper(['form']);
        session();
        $rules = [
            'currentpassword'  => [
                'rules' => [
                    'required'
                ],
                'errors' => [
                    'required' => 'Senha atual obrigatória.'
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
        ];
        $model = new UserModel();
        $response = service('response');
        if(isset($_SESSION['email'])) {
            $this->dbUser = $model->where("email", $_SESSION['email'])->first();
        } else {
            return redirect()->to('/login');
        }
        // var_dump($this->validate($rules));
        // print_r($this->request->getPost());exit;
        $pass = $this->dbUser['password'];
        // echo $pass;
        // echo "<hr>";
        $password = $this->request->getVar('currentpassword');
        // echo $password;
        $pwd_verify = password_verify($password, $pass);
        if($pwd_verify){
            if ($this->validate($rules)) {
            
                $data = [
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                ];
                
                try {
                    if ($model->update($this->dbUser['id'], $data)) {
                        return $response->setJSON([
                            "error" => false,
                            'message' => "Sua senha foi atualizada com sucesso!",
                        ]);
    
                        
                    } else {
                        $rr = json_encode([
                            'error' => true,
                            'message' => "Erro ao salvar dados.",
                            'error_code' => "DB_STORE_ERROR"
                        ]);
                        throw new \Exception($rr, 100000000);
                        exit;
                    }
                } catch (\Exception $e) {
                    // print_r($e->getMessage());
                    
                    return $response->setJSON([
                        "error" => true,
                        'message' => "Erro ao atualizar senha!",
                        'e' => $e->getMessage(),
                        'ec' => $e->getCode(),
                    ]);
                    exit;
                
                }
                
               
                
    
                // return redirect()->to('/login');
            } else {
                $validation = $this->validator;
                
                $errors = $validation->getErrors();
                $response = [
                    "error" => true,
                    "error_code" => "REQ_FIELDS",
                    "message" => "Verifique os campos obrigatórios",
                    "errors" => $errors
                ];
                
    
                echo json_encode($response);
                exit;
            }
        } else {
            return $response->setJSON([
                "error" => true,
                'message' => "Erro ao atualizar senha! Senha atual inválida.",
            ]);
            exit;
        }
        exit;
        
    }
}
