<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript""></script>
    <script>
    function getCurrentWeather(){
        $.ajax({
            url: '',
            type: 'POST',
            error: function(xhr, status, error) {
                console.error('API isteği sırasında hata oluştu. Hata: ' + error);
            },
            success: function(result){
               $('body').empty().append(result);
            }
        });
    }
    $(document).ready(function(){
        getCurrentWeather();
        setInterval(getCurrentWeather, 1200000);
    })
    </script>
    <style>
        html{
            height: 100%;
            width: 100%;
            margin: 0;
            display:flex;
        }
        body{
            height: 100%;
            width: 100%;
            margin: 0;
            display:flex;
            background-image:url(images/background.jpg);
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

        }
    </style>
</head>
<body>
    
</body>
</html>