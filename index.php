<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GWP</title>
    <style type="text/css"> body{
      text-align: center;
    }
    </style>
  </head>
  <body onload="getLoc()">
    <h1>GWP QR API</h1>
    <iframe name="iframe" id="google_map" src=""></iframe></br>
    <form action="gwp.php" method="POST">
      <h2>Unique Product Number: 123</h2>
      <label>Leave a Gift Message! ❤️</label><br>
      <textarea class="text-area" name="text-area" rows="4" cols="50"></textarea></br>
      </br>
      <label>Please Enter Your Email</label></br>
      <input name="email" type="text" class="email-input"></br>
      <br>
      <input name="submit" type="submit" class="submit" value="submit"></br>
    </form>
    <?php
    if(isset($_POST["submit"])){
      echo "</br>
      <h2>The Server Has Received The Following User Data:</h2></br>";
      echo "<h3>Email Is: </h3>";
      echo $_POST["email"];
      echo "</br>";
      echo "<h3>Message Is: <span></span></h3>";
      echo $_POST["text-area"];
      echo "</br>";
    } 
  ?>
    <script>
      var c = function(pos){
        var lat = pos.coords.latitude,
            long = pos.coords.longitude,
            coords = lat + ", " + long;

            document.getElementById("google_map").setAttribute("src", "https://maps.google.co.uk?q="+ coords +"&output=embed");

      }
      function getLoc(){
        navigator.geolocation.getCurrentPosition(c);  
      }
      
    </script>
  </body>
</html>
