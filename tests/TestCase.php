<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    protected function seePageHasGetParameters($parameters = array()){
        $parts = explode('?',$this->currentUri);
        if(count($parts)==1){
            $this->assertEquals(0,count($parameters),'The URL has GET Parameters, but an empty array was provided.');
        } else {
            array_shift($parts);
            $parts = implode('?',$parts);
            $parts = explode('&',$parts);
            $queryParms = array();
            foreach($parts as $part){
                $temp = explode('=',$part,2);
                $queryParms[$temp[0]] = $temp[1];
            }
            foreach($parameters as $key=>$value){
                $this->assertArrayHasKey($key,$queryParms);
                $this->assertEquals($value,$queryParms[$key]);
            }
        }
        return $this;
    }

    protected function seePageStartsWith($uri){
        $this->assertPageLoaded($uri = $this->prepareUrlForRequest($uri));
        $this->assertTrue(strlen($this->currentUri)>=strlen($uri));
        $this->assertEquals($uri,substr($this->currentUri,0,strlen($uri)));
        return $this;
    }
}
