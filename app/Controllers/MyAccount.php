<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Controllers\Home;

class MyAccount extends BaseController
{
    use ResponseTrait;
    private $payload;
    public $requestURL;
    protected $k;
    
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
        $uid = $user["id"];
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
                
                if($pm["id"] == $dft_pmt || count($user["payment_methods"]) == 1) {
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
                
                if($pm["id"] == $dft_pmt || count($user["payment_methods"]) == 1) {
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
        // print_r($user);exit;
        return view('account/assinaturas', ["assinaturas" => $assinaturas, "user"=>$user]);
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
        
        
        return view('account/assinatura', ["assinatura" => $assinatura,true, "user" => $user]);

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

}
