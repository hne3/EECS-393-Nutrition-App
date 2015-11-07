<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Nutrient;

class UpdateNutritionData extends Command
{

    protected $baseURL = "http://ndb.nal.usda.gov/ndb/nutrients/download?nutrient1={{id}}&nutrient2=&nutrient3=&fg=&subset=0&sort=f&totCount=8490&max=&measureby=g";
    protected $storageLoc;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nutritiondata:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves the latest nutrition data from the national database and saves it as CSV files.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->storageLoc = base_path() . '/database/seeds/csvs/';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //get base food data
        $this->info('Updating base food data.');
        $dataURL = str_replace("{{id}}", "208", $this->baseURL);
        $data = $this->getCSVFromURL($dataURL);
        $data = $this->processCSV($data, ['id', 'name', 'calories']);
        $this->storeCSV( 'fooddata.csv',$data);

        //for each of the nutrients we care about, update that data too
        $nutrients = Nutrient::lists('name','id');
        foreach($nutrients as $id=>$name){
            $this->info('Updating '.$name.' data.');
            $dataURL = str_replace('{{id}}',$id,$this->baseURL);
            $data = $this->getCSVFromURL($dataURL);
            $data = $this->processCSV($data,['food_id','nutrient_id','amount_in_food'],[
                '1'=>$id
            ]);
            $fileName = strtolower(str_replace(' ','',str_replace('-','',$name))).'data.csv';
            $this->storeCSV($fileName,$data);
        }
    }


    private function storeCSV($filename, $data){
        $path = $this->storageLoc . $filename;
        file_put_contents($path, $data);
    }

    private function processCSV($data, $headers,$replacements = null)
    {
        $res = '';
        $lines = explode(PHP_EOL,$data);
        $numHeaders = count($headers);
        foreach ($lines as $i => $line) {
            if ($i < 7) {
                continue;
            }
            else if ($i == 7) {
                foreach ($headers as $j => $header) {
                    if ($j != $numHeaders - 1) {
                        $res = $res . $header . ',';
                    } else {
                        $res = $res . $header . "\n";
                    }
                }
            } else {
                $parts = str_getcsv($line);
                foreach($parts as $j=>$part){
                    $val = $part;
                    if($replacements != null && array_key_exists($j,$replacements)){
                        $val = $replacements[$j];
                    }
                    if(str_contains($val,',')){
                        $val = "\"".$val."\"";
                    }
                    if ($j < $numHeaders-1) {
                        $res = $res . $val . ',';
                    } else if($j == $numHeaders - 1){
                        $res = $res . $val . "\n";
                    } else {
                        //Do nothing - ignore any data that isn't going to align with a header
                    }
                }
            }
        }
        return $res;
    }

    private function getCSVFromURL($url)
    {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curlSession);
        curl_close($curlSession);
        return $data;
    }
}
