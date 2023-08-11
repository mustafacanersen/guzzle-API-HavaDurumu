<?php
require_once __DIR__.'/vendor/autoload.php';
use GuzzleHttp\Client;

$router = new AltoRouter();
$router->setBasePath('/guzzle-API-HavaDurumu');

$router->map('GET','/',function(){
    require_once __DIR__.'/anasayfa.view.php';
});

$router->map('POST','/', function(){
    
    try{
        $client = new Client([
            'base_uri'  => 'https://api.collectapi.com/',
            'headers'   => [
                'authorization' => 'apikey 5aF3J9rP2Luj8gsVj28Lwh:4hlGK7uTkRMQ99IcdQsJqO',
                'content-type'  => 'application/json'
            ]
        ]);
        $response = $client->request('GET', 'weather/getWeather?data.lang=tr&data.city=izmir');
        $response = $response->getBody();
        $result = json_decode($response, true);

        if (isset($result['result']) && is_array($result['result'])) {
            echo "<div class='weather-container' style='display:flex;width: 100%;align-items: center;justify-content: center;justify-content: space-around;'>";

            foreach ($result['result'] as $weatherData) {
                echo "<div class='card' style='border-style:solid; border-width: 1px; border-color: white;width: 200px;height: auto; display: flex; flex-direction: column; align-items: center;background-color: rgba(115, 228, 250, 0.3);box-shadow: 2px 2px 2px 2px white;border-radius: 5px 5px 5px 5px;'>
                        <p>" . $weatherData['date'] . "</p>
                        <p>" . ucfirst($result['city']) . "</p>
                        <img src='" . $weatherData['icon'] . "' style='width: 100px; height: auto;'>
                        <p style='font-size:x-large;'>" . $weatherData['degree'] . "</p>
                        <p>" . $weatherData['day'] . "</p>
                        <p>" . ucfirst($weatherData['description']) . "</p>
                        <p>En Düşük: " . $weatherData['min'] . "</p>
                        <p>En Yüksek: " . $weatherData['max'] . "</p>
                    </div>";
            }
            echo "</div>";
        } else {
            echo "Hava durumu verisi yok";
        }

    }
    catch (\Exception $e) {
        echo "API isteği sırasında bir hata oluştu: " . $e->getMessage();
    }
    catch (\Throwable $th) {
        echo "API isteği sırasında bir hata oluştu: " . $th->getMessage();
    }
    catch (GuzzleHttp\Exception $ge) {
        echo "API isteği sırasında bir hata oluştu: " . $ge->getMessage();
    }
});

$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] ); 
} else {
    echo 'rota bulunamadı url: '.$_SERVER['REQUEST_URI'];
    //header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

// Problem 1: Route match yok dolayısıyla / rotası eşleşip anasayfa.view.php'yi çağırmıyor jslerin görüneceği sayfa hiç yüklenmiyor yani
// dizin adından dolayı index.php default page olarak çalışıyor ama rota yapısı dışında kod barındırmadığı için de çıktı üretmiyor
// Çözüm 1: Match kodlarını ekliyoruz bu alana ve rotanın eşleşmesini sağlıyoruz