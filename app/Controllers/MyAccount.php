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
            "customer_id" => "74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "active"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas = json_decode($r, true)["items"];
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
        return view('account/cartoes', ["dft_payment"=>$user_default_payment, "user"=>$user]);
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
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        }
        $uid = $user["id"];
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => "74AE1E1406354345AE23CCC30DAA5BD6",
            "status_filter" => "active"
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $a->doRequest($this->requestURL, $args);
        $assinaturas = json_decode($r, true)["items"];
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
        // print_r($user);exit;
        return view('account/assinaturas', ["assinaturas" => $assinaturas, "user"=>$user]);
    }
    public function login() {
        
        return view("account/login", ["user"=> []]);
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
        // print_r($assinatura);exit;
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

}
