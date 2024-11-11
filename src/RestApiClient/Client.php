<?php
 
namespace App\RestApiClient;
 
use App\Interfaces\ClientInterface;
use Exeception;
 
class Client
{
 
    const API_URL = 'http://localhost:8000/';
    protected $url;
 
    function __construct($url = self::API_URL)
    {
        $this->url = $url;
    }
 
    public function getUrl() {
        return $this->url;
    }
 
    function get($route, array $query = [])
    {
        $url = $this->geturl() . $route;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($curl);
        if  (!$response) {
            trigger_error(curl_error($curl));
        }
        curl_close($curl);
 
        return json_decode($response, TRUE);
    }

    function post($route, array $data = [])
    {
        $url = $this->getUrl() . $route;
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data)); 
        
        $response = curl_exec($curl);
        
        if (!$response) {
            throw new Exception(curl_error($curl)); 
        }
        
        curl_close($curl);
        
        return json_decode($response, TRUE);
    }

    
    function delete($route)
    {
        $url = $this->getUrl() . $route;
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return [
            'status' => $httpCode,
            'data' => json_decode($response, TRUE),
        ];
    }

    public function put($route, array $data = [])
    {
        $url = $this->getUrl() . $route;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);
        
        if (!$response) {
            throw new \Exception(curl_error($curl));
        }
        
        curl_close($curl);
        
        return json_decode($response, TRUE);
    }

    
}

