<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use \Firebase\JWT\JWT;
use Exception;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('cookie');
        // var_dump(get_cookie("jwtteste"));
        $token = get_cookie("jwtteste");
        // echo $token;exit;
        
        $key = getenv('JWT_SECRET');
        /* DEFAULT 
        $header = $request->getHeader("Authorization");
        $token = null;
 
        // extract the token from the header
        if(!empty($header)) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                $token = $matches[1];
            }
        } */
        // var_dump($request->isAJAX());exit;
        // check if token is null or empty
        if(is_null($token) || empty($token)) {
            // echo "ee";exit;
            if($request->isAJAX()) {
                $response = service('response');
                return $response->setJSON([
                    "error" => true,
                    'message' => "unauthorized"
                ]);
            } else {
                $response = service('response');
                return redirect()->to('minha-conta/login'); 
            }
            
            // $response->setBody('Access denied2');
            // $response->setStatusCode(401);
            // return $response;
        } else {
            // echo "go on";exit;
        }
        // print_r($key);exit;
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
            // print_r($decoded);exit;
        } catch (Exception $ex) {
            $response = service('response');
            if($request->isAJAX()) {
                return $response->setJSON([
                    "error" => true,
                    'message' => "unauthorized",
                    'data' => $ex
                ]);
            } else {
                
                return redirect()->to('minha-conta/login'); 
            }
            // print_r($ex);exit;
            // $response = service('response');
            // return redirect()->to('minha-conta/login'); 
            
            // $response->setBody('Access denied3');
            // $response->setStatusCode(401);
            // return $response;
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
