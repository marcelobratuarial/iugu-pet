<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Home extends BaseController
{
    use ResponseTrait;
    private $payload;
    public $baseApi;
    public $requestURL;
    protected $k;
    
    public function __construct () {
        $this->baseApi = 'https://api.iugu.com/v1/';
        $this->k = base64_encode(env("KEY_IUGU").":"); //$_SERVER['KEY_IUGU'].":";
        // $this->payload = $this->request->getJSON();;
        $this->requestURL = "";
    }

    public function index()
    {
        // echo base64_encode($this->k);exit;
        $args = [];
        $this->requestURL = $this->baseApi . "plans?limit=3";
        $args["m"] = "GET";
        // $args["pl"] = [

        // ];
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $this->doRequest($this->requestURL, $args);
        $planos = json_decode($r, true)["items"];
        // echo "<pre>";
        // print_r(json_decode($r, true));exit;
        return view('home', ["plans" => $planos]);
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
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";
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
        
        
        // echo "<pre>";
        // print_r(json_decode($user, true));;
        // print_r(json_decode($plano, true));exit;
        return view('assinar', ["plan" => json_decode($plano), "user" => $user]);

    }

    public function services()
    {
        // echo base64_encode($this->k);exit;
        
        
        return view('services');
    }

    public function doRequest($url, $args) {

        // echo "<pre>";
        // print_r($args);exit;
        // echo $this->k;
        // print_r($args);exit;
        $curl = curl_init();
        $data = [
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $args["m"],
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic '.$this->k,
                'Accept: application/json',
                'Content-Type: application/json'
            ]
        ];
        if(isset($args["pl"])) {
            $data[CURLOPT_POSTFIELDS] = $args["pl"];
        }
        curl_setopt_array($curl, $data);
        // echo "<pre>";
        // print_r(curl_getinfo($curl));exit;
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function api() {
        $rdata = $this->request->getPost();
        $args = [];
        if(isset($rdata["call"])) {
            if($rdata["call"] == "payment_methods") {
                $session = session();
                $session->get('email');
                $args_ = [];
                $args_["m"] = "GET";
                $this->requestURL = $this->baseApi . "customers";
                $args_["pl"] = json_encode([
                    "query" => $session->get('email'),
                    "limit" => 1
                ]);
                $user = $this->doRequest($this->requestURL, $args_);
                // echo gettype(json_decode($user, true));exit;
                $u = json_decode($user, true)["items"][0];
                // var_dump($u);exit;
                // echo json_encode($u);
                $this->requestURL = $this->baseApi . "customers/".$u["id"]."/".$rdata["call"];
                $rdata["payload"]["customer_id"] = $u["id"];
                $rdata["payload"]["description"] = "Teste";
                $rdata["method"] = "GET";
                // echo $this->requestURL;
                // exit;
            } else {
                $this->requestURL = $this->baseApi . $rdata["call"];
            }
            
            
        } else {
            throw new \Exception("invalid call");
        }
        if(isset($rdata["method"])) {
            $args["m"] = $rdata["method"];
        } else{
            throw new \Exception("invalid method");
        }
        if(in_array($rdata["method"], ["POST", "PUT"]) && !isset($rdata["payload"])) {
            throw new \Exception("invalid payload");
        } else if(in_array($rdata["method"], ["POST", "PUT"]) && isset($rdata["payload"])) {
            
            $args["pl"] = json_encode($rdata["payload"]);
        }
        
        // print_r($this->requestURL);exit;
        // $this->requestURL = $this->baseApi . $rdata['call'];
        // $pl = $rdata['payload'];
        $r = $this->doRequest($this->requestURL, $args);
        
        print_r($r);
        $args__ = [];
        $args__["m"] = "GET";
        $args__["pl"] = json_encode([
            "customer_id" => $u["id"]
        ]);
        $user = $this->doRequest($this->requestURL, $args__);
        // echo gettype(json_decode($user, true));exit;
        $u = json_decode($user, true);
        print_r($u);
        exit;
    }
}
