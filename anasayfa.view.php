<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript""></script>
    <script>
    $(document).ready(function(){
        $.ajax({
            url: 'localhost/guzzle-API-HavaDurumu/',
            type: 'POST',
            error: function(xhr, status, error) {
                console.error('API isteği sırasında hata oluştu. Hata: ' + error);
            }
        });
        setInterval(1200000);
    }
    </script>
</head>
<body>
    
</body>
</html>