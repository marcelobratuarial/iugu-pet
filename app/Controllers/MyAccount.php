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
        print_r($assinaturas);exit;
        return view('account/dashboard', ["plans" => $planos]);
    }
    public function mailTeste() {
        $conf = [
            'name' => "marcelo",
            'code' => '132 123'
        ];
        return view("mail/codConfirm", $conf);
    }
    public function assinar($id)
    {
        // // parent::Controller();
        session();
        // echo "<pre>";print_r($a->get("name"));exit;
        
        $args = [];
        $this->requestURL = $this->baseApi . "plans/".$id;
        $args["m"] = "GET";
        // $args["pl"] = [

        // ];
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $plano = $this->doRequest($this->requestURL, $args);
        
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
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
            foreach($user["payment_methods"] as $pm) {
                if($pm["id"] == $dft_pmt || count($user["payment_methods"]) >= 1) {
                    $user_default_payment = $pm;
                    break;
                }
            }
        }
        // print_r($user_default_payment);exit;
            // echo "</pre>";
        
        if(isset($user["custom_variables"]) && !empty($user["custom_variables"])) {
            $cf_refs = [
                'pet_name' => [
                    'display' => "Nome do Pet",
                ],
                'pet_peso' => [
                    'display' => "Peso",
                ],
                'pet_raca' => [
                    'display' => "Raça",
                ],
                'pet_nasc' => [
                    'display' => "Nascimento",
                ],
            ];
            $user["pet_data"] = [];
            foreach($user["custom_variables"] as $v) {
                $cf_refs[$v["name"]]["value"] = $v["value"];
                // print_r($cf_refs);
                $user["pet_data"][] = $cf_refs[$v["name"]];
            }
            $address = [];
            
            $address["rua"] = '';
            $address["rua"] .= (!empty($user["street"])) ? $user["street"] : '[Não informado]';
            $address["rua"] .= (!empty($user["number"])) ? ', '.$user["number"] : '[S/N]';
            $address["rua"] .= (!empty($user["complement"])) ? ', '.$user["complement"] : '[S/N]';
            $address["bairro"] = '';
            $address["bairro"] .= (!empty($user["district"])) ? $user["district"] : '[Não informado]';
            $address["cidade"] = '';
            $address["cidade"] .= (!empty($user["city"])) ? $user["city"] : '[Não informado]';
            $address["estado"] = '';
            $address["estado"] .= (!empty($user["state"])) ? $user["state"] : '[Não informado]';
    
            $user["address"] = $address;
        }
        
        // print_r($user["pet_data"]);exit;
        // $args__ = [];
        // $args__["m"] = "GET";
        // $args__["pl"] = json_encode([
        //     "customer_id" => $user["id"]
        // ]);
        // $this->requestURL = $this->baseApi . 'customers/'.$user["id"].'/payment_methods';
        // // print_r($this->requestURL);exit;
        // // print_r($args__);
        // // exit;
        // $payment_forms = $this->doRequest($this->requestURL, $args__);
        // // echo gettype(json_decode($payment_forms, true));exit;
        // $pf = json_decode($payment_forms, true);
        // print_r($pf);
        // exit;
        
        // echo "<pre>";
        // print_r(json_decode($user, true));;
        // print_r(json_decode($plano, true));exit;
        return view('assinar', ["plan" => json_decode($plano), "user" => $user, "payment"=>$user_default_payment]);

    }

}
