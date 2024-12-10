<?php

namespace App\Html;

use App\RestApiClient\Client;

class Request {
    static function handle()
    {
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "POST":
                self::postRequest();
                break;
            case "GET":
                self::getRequest();
                break;
            case "PUT":
                self::putRequest();
                break;
            case "DELETE":
                self::deleteRequest();
                break;
            default:
                echo 'Unknown request type';
                break;
        }
    }

    private static function postRequest()
    {
        $request = $_REQUEST;
        switch (true) {
            case isset($request['btn-counties']):
                PageCounties::table(self::getCounties(), self::getCounties(), 0, null);
                break;
            case isset($request['btn-cities']):
                PageCities::table(self::getCounties(), self::getCities(), 0, null);
                break;
            case isset($request['btn-select-county']):
                $id = $_POST['counties'];
                PageCities::table(self::getCounties(), self::getCitiesByCounty($id), $id, self::getABC($id));
                break;
            /*
            case isset($request['btn-search']):
                $id = $request['needle'] ?? null;
                if ($id) 
                {
                    PageCounties::table([self::getCountyById($id)]);
                } 
                else 
                {
                    echo "Nem adtál meg keresési kifejezést!";
                }
                break;
            */
            case isset($request['btn-save-county']):
                $client = new Client();
                $data = [];         
                if (!empty($request['id'])) {
                    $data['id'] = $request['id'];
                }
                $data['name'] = $request['name'];
                $response = $client->post('counties', $data);
                echo 'Az új megye hozzáadása sikeres!';
                break;
                
            case isset($request['btn-del-county']):
                $client = new Client();
                $id = $request['btn-del-county'] ?? null; 
                $response = $client->delete("counties/{$id}");
                echo 'A törlés sikeres volt!';
                break;


            case isset($request['btn-edit-county']):
                $id = $request['edit_county_id'];
                $name = $request['edit_county_name'];
                PageCounties::showModifyCounties($id,$name);
                break;
    
            case isset($request['btn-save-modified-county']):
                $client = new Client();
                $id = $request['modified_county_id'];
                $name = $request['modified_county_name'];
    
                if ($id && $name) {
                    $data = ['id' => $id, 'name' => $name];
                    $response = $client->put("counties/{$id}", $data);
                    echo 'A módosítás sikeres!';
                }
                break;

            case isset($request['btn-del-city']):
                $client = new Client();
                $id = $request['btn-del-city'] ?? null; 
                $response = $client->delete("cities/{$id}");
                echo 'A törlés sikeres volt!';
                break;

            case isset($request['btn-edit-city']):
                $id = $request['edit_city_id'];
                $name = $request['edit_city_name'];
                $zip = $request['edit_city_zip'];
                PageCities::showModifyCities($id,$name,$zip);
                break;

            case isset($request['btn-save-modified-city']):
                $client = new Client();
                $id = $request['modified_city_id'];
                $name = $request['modified_city_name'];
                $zip = $request['modified_city_zip'];
    
                if ($id && $name) {
                    $data = ['id' => $id, 'city' => $name, 'zip_code' => $zip];
                    $response = $client->put("cities/{$id}", $data);
                    echo 'A módosítás sikeres!';
                }
                break;
            
            case isset($request['btn-save-city']):
                if ($request['id_county'] == 0) {
                    echo 'Válassz megyét!';
                }
                else {
                    $client = new Client();
                $data = [];         
                if (!empty($request['id'])) {
                    $data['id'] = $request['id'];
                }
                if (!empty($request['id_county'])) {
                    $data['id_county'] = $request['id_county'];
                }
                $data['city'] = $request['city'];
                $data['zip_code'] = $request['zip_code'];
                $response = $client->post('cities', $data);
                echo 'Az új város hozzáadása sikeres!';
                }
                break;
            
        }
    }
    
    private static function getRequest()
    {
    }

    private static function putRequest()
    {
    }

    private static function deleteRequest()
    {
    }
    

    private static function getCountyById($id) : ?array
    {
        $client = new Client();
        $response = $client->get("counties/{$id}");

        return $response['data'] ?? null;
    }

    private static function getCounties() : ?array
    {
        $client = new Client();
        $response = $client->get('counties');

        return $response['data'] ?? null;
    }

    private static function getCities() : ?array
    {
        $client = new Client();
        $response = $client->get('cities');

        return $response['data'] ?? null;
    }
    private static function getCitiesByCounty($countyId) : ?array
    {
        $client = new Client();
        $response = $client->get("counties/{$countyId}/cities");

        return $response['data'] ?? null;
    }

    private static function getABC($countyId) : ?array
    {
        $client = new Client();
        $response = $client->get("counties/{$countyId}/cities/ABC");

        return $response['data'] ?? null;
    }

    
}
