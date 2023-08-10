<?php
require_once __DIR__.'/vendor/autoload.php';
use GuzzleHttp\Client;

$router = new AltoRouter();
$router->setBasePath('/guzzle-API-HavaDurumu');

$router->map('GET','/',function(){
    require_once __DIR__.'/anasayfa.view.php';
    
});

$router->map('POST','/', function(){
  
    $client = new Client([
        'base_uri' => 'https://collectapi.com/tr/api/',
        'headers' => 'apikey 5aF3J9rP2Luj8gsVj28Lwh:4hlGK7uTkRMQ99IcdQsJqO'
    ]);
    try{
        $response = $client->request('GET', 'weather/hava-durumu-api');
        $responseData = json_decode($response->getBody(), true);
        print_r($responseData);
    } catch (Exception $e) {
        echo "API isteği sırasında bir hata oluştu: " . $e->getMessage();
    }
    
})
?>