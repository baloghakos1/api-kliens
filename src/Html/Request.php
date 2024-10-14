<?php
namespace App\Html;

//use App\Pdf\Pdf;
use App\RestApiClient\Client;
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

class Request 
{
    static function handle() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "POST":
                self::postRequest();
                break;
            case "GET":
            default:
                self::getRequest();
                break;
        }
    }

    private static function postRequest()
    {
        $request = $_REQUEST;
        switch ($request) 
        {
            case isset($request['btn-counties']) :
            PageCounties::table (self::getCounties()) ;
            break;
        }
    }

    private static function getCounties(): array{
        $client = new Client();
        $response = $client->get('counties');

        return $response['data'];
    }
}