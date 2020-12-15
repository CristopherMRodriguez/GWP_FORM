<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta HTTP-EQUIV=Refresh CONTENT="4"> -->
    <title>GWP</title>
    <style type="text/css"> 
      body{
        text-align: center;
      }
      .red{
        color: red;
      }
    </style>
  </head>
  <?php
    $errorText = "";
    $errorEmail = "";
    $textArea = "";
    $email = "";
    
    if(isset($_POST["submit"])){
      $textArea = $_POST["text-area"];  
      $email = $_POST["email"];
      
      if (empty($textArea)){
        $errorText = "Please enter a gift message.";
      } 

      if(empty($email)){
        $errorEmail = "Please enter email.";
      } else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errorEmail = "Email Must Be a Valid Email Address.";
        } 
      }

      if($errorEmail != ""){
        echo "There is an error!";
      } else {
        echo "There is NO error!";
      }
    }
  ?>
  <body onload="getLoc()">
    <h1>GWP QR API</h1>
    <iframe name="iframe" id="google_map" ></iframe></br>
    <form action="index.php" method="POST">
      <h2>Unique Product Number: 123</h2>
      <label>Leave a Gift Message! ❤️</label><br>
            <textarea class="text-area" name="text-area" rows="4" cols="50"><?php echo htmlspecialchars($textArea); ?></textarea></br>
      <div class="red"><?php echo $errorText; ?></div>
      </br>
      <label>Please Enter Your Email</label></br>
            <input name="email" type="text" class="email-input" value="<?php echo htmlspecialchars($email); ?>"></br>
      <div class="red"><?php echo $errorEmail; ?></div>
      <br>
      <input name="submit" type="submit" class="submit" value="submit"></br>
    </form>
    
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
