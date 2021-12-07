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
        
        $rdata = (array) $this->request->getPost();
        if(empty($rdata)) {
            $rdata = (array) $this->request->getJSON();
        }
        // $rdata = (array) $this->request->getJSON();
        // var_dump($rdata);exit;
        try {
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
                    $rdata["payload"]["set_as_default"] = true;
                    $rdata["payload"]["customer_id"] = $u["id"];
                    $rdata["payload"]["description"] = "Teste";


                    $args_cc = [];
                    $args_cc["m"] = "POST";
                    $args_cc["pl"] = json_encode($rdata["payload"]);

                    $r = $this->doRequest($this->requestURL, $args_cc);
                    $rr = json_decode($r, true);
                    if(isset($rr["errors"])) {
                        return $this->response->setJSON([
                            "error" => true,
                            "message" => "Erro ao salvar cartão",
                            "response" => $rr
                        ]);
                    } else {
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
                        $rr["cardCount"] = count($u["payment_methods"]);
                        return $this->response->setJSON([
                            "error" => false,
                            "message" => "Cartão salvo com sucesso",
                            "response_data" => $rr
                        ]);
                    }
                    
                    // echo $this->requestURL;
                    // exit;
                } else if ($rdata["call"] == "subscriptions" && $rdata["method"] == "POST") {
                    $this->requestURL = $this->baseApi . $rdata["call"];
                    $rdata["payload"]["suspend_on_invoice_expired"] = true;
                    $rdata["payload"]["only_charge_on_due_date"] = false;
                    $rdata["payload"]["only_on_charge_success"] = true;
                } else if (preg_match_all('/^subscriptions.*suspend$/', $rdata["call"]) && $rdata["method"] == "POST") {
                    $this->requestURL = $this->baseApi . "subscriptions/" . $rdata["payload"]['id'] ."/suspend";
                    // print_r($rdata);
                    $args = [];
                    $args["m"] = "POST";
                    $args["pl"] = json_encode($rdata["payload"]);
                    $assinatura = json_decode($this->doRequest($this->requestURL, $args),true);
                    foreach($assinatura['logs'] as $i=> $log): 
                        $due_date = date_create($log['created_at']);
                        $data = $due_date->format('d/m/Y H:i:s');
                        // // echo $due_date;
                        $assinatura['logs'][$i]['data'] = $data;
                    endforeach;
                    return $this->response->setJSON($assinatura);
                    // return $this->response->setJSON($this->requestURL);
                    // exit;
                    // $rdata["payload"]["suspend_on_invoice_expired"] = true;
                    // $rdata["payload"]["only_charge_on_due_date"] = false;
                    // $rdata["payload"]["only_on_charge_success"] = true;
                } else if (preg_match_all('/^subscriptions.*activate$/', $rdata["call"]) && $rdata["method"] == "POST") {
                    $this->requestURL = $this->baseApi . "subscriptions/" . $rdata["payload"]['id'] ."/activate";
                    $args = [];
                    $args["m"] = "POST";
                    $args["pl"] = json_encode($rdata["payload"]);
                    $assinatura = json_decode($this->doRequest($this->requestURL, $args),true);
                    // print_r($assinatura);exit;
                    foreach($assinatura['logs'] as $i=> $log): 
                        $due_date = date_create($log['created_at']);
                        $data = $due_date->format('d/m/Y H:i:s');
                        // echo "DUO" .$due_date;
                        $assinatura['logs'][$i]['data'] = $data;
                    endforeach;
                    
                    return $this->response->setJSON($assinatura);
                    // return $this->response->setJSON($this->requestURL);
                    // exit;
                    // $rdata["payload"]["suspend_on_invoice_expired"] = true;
                    // $rdata["payload"]["only_charge_on_due_date"] = false;
                    // $rdata["payload"]["only_on_charge_success"] = true;
                } else if (preg_match_all('/^customers.*payment_methods.*/', $rdata["call"]) && $rdata["method"] == "DELETE") {
                    session();
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
                        // var_dump($user);exit;
                        $u = json_decode($user, true);
                        unset($user);
                        $user = [];
                        if($u["totalItems"] > 0) {
                            $user = $u['items'][0];
                        }

                        $this->requestURL = $this->baseApi . "customers/" . $user['id'] ."/payment_methods/".$rdata["payload"]['id'];
                        // print_r($this->requestURL);exit;
                    } 
                    
                    // return $this->response->setJSON($this->requestURL);
                    // exit;
                    // $rdata["payload"]["suspend_on_invoice_expired"] = true;
                    // $rdata["payload"]["only_charge_on_due_date"] = false;
                    // $rdata["payload"]["only_on_charge_success"] = true;
                } else if (preg_match_all('/^customers.*/', $rdata["call"]) && $rdata["method"] == "PUT") {
                    session();
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
                        // var_dump($user);exit;
                        $u = json_decode($user, true);
                        unset($user);
                        $user = [];
                        if($u["totalItems"] > 0) {
                            $user = $u['items'][0];
                        }
                        $args = [];
                        $args["m"] = "PUT";
                        $rdata["payload"]["default_payment_method_id"] = $rdata["payload"]['id'];
                        $args["pl"] = json_encode($rdata["payload"]);
                        
                        $this->requestURL = $this->baseApi . "customers/" . $user['id'];
                        $user = json_decode($this->doRequest($this->requestURL, $args),true);
                        // print_r($user);exit;
                        
                        
                        return $this->response->setJSON($user);
                        
                    }
                } else {
                    echo "else";
                    print_r($rdata);
                    $this->requestURL = $this->baseApi . $rdata["call"];
                }
                
                
            } else {
                throw new \Exception("invalid call");
            }
        } catch (\Exception $e) {
            
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
        
    }
}
