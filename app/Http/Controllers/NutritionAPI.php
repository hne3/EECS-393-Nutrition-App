<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 9/20/15
 * Time: 2:51 AM
 */

namespace App\Http\Controllers;

class NutritionAPI extends Controller
{
    protected $base_url = 'http://api.nal.usda.gov/ndb/';
    protected $type;
    protected $form;
    protected $offset = 0;
    protected $max = 50;
    protected $sort = 'id';

    public static function Food(){
        $newAPI = new static();
        $newAPI->form = 'reports';
        return $newAPI;
    }

    public static function Nutrients(){
        $newAPI = new static();
        $newAPI->form = 'reports';
        return $newAPI;
    }


    public function sortByName(){
        $this->sort = 'n';
        return $this;
    }

    public function sortByID(){
        $this->sort = 'id';
        return $this;
    }

    public function toURL(){
        return $this->buildURL();
    }

    public function get(){
        $url = $this->buildURL();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($output,true);
        dd($response);
        return $response['list']['item'];
    }

    private function buildURL(){
        return $this->base_url . $this->form . '?api_key=' . env('NUTRITION_API_KEY', '') . '&offset=' . $this->offset . '&max=' . $this->max . '&sort='.$this->sort . '&ndbno=208';
    }

}