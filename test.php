<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<div id="auto"></div>
 

<script src="vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready( function(){
    $('#auto').load('load.php');
    refresh();
    });
    
    function refresh()
    {
        setTimeout( function() {
        $('#auto').load('load.php');
        refresh();
        }, 2000);
    }
</script>
</body>
</html>