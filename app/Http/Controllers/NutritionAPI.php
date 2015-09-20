<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 9/20/15
 * Time: 2:51 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;

class NutritionAPI extends Controller
{
    protected $base_url = 'http://api.nal.usda.gov/ndb/';
    protected $type;
    protected $form;
    protected $offset = 0;

    public static function Food(){
        $newAPI = new static();
        $newAPI->form = 'list';
        $newAPI->type = 'f';
        return $newAPI;
    }

    public function get(){
        $url = $this->base_url . $this->form . '?lt=' . $this->type . '&offset=' . $this->offset . '&api_key=' . env('NUTRITION_API_KEY', '');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}