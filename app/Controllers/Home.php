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
        if(isset($_SESSION['email'])) {
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";
        }
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
        
        $args = [];
        $args["m"] = "GET";
        $this->requestURL = $this->baseApi . "customers";
        $args["pl"] = json_encode([
            "query" => "marcelo@agencia.com.br",
            "limit" => 2
        ]);
        $user = $this->doRequest($this->requestURL, $args);
        // echo "<pre>";
        // print_r(json_decode($user, true));;
        // print_r(json_decode($plano, true));exit;
        return view('assinar', ["plan" => json_decode($plano), "user" => json_decode($user)]);

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
        $rdata = $this->request->getJSON();
        $args = [];
        if(isset($rdata->call)) {
            $this->requestURL = $this->baseApi . $rdata->call;
        } else {
            throw new \Exception("invalid call");
        }
        if(isset($rdata->method)) {
            $args["m"] = $rdata->method;
        } else{
            throw new \Exception("invalid method");
        }
        if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
            throw new \Exception("invalid payload");
        } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
            $args["pl"] = json_encode($rdata->payload);
        }
        
        // print_r($this->requestURL);exit;
        // $this->requestURL = $this->baseApi . $rdata['call'];
        // $pl = $rdata['payload'];
        $r = $this->doRequest($this->requestURL, $args);
            
        print_r($r);
        exit;
    }
}
