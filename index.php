<?php
    // connection to database
    $conn = mysqli_connect("localhost", "cris", "bebe", "GWP");
    if (!$conn) {
      echo 'Connection error: ' . mysqli_connect_error();
    }
    // constructed query (not used)
    $sql = "SELECT location FROM General";

  	// get the result set (set of rows)
    $result = mysqli_query($conn, $sql);
    
    // fetch the resulting rows as an array.  To receive data from DB.
    $emailQuery = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    //print_r($emailQuery);

    if (!$conn){
      echo "Connection error: " . mysqli_connect_error();
    }

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

    if ($errorEmail == "" && $errorText == "") {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $textArea = mysqli_real_escape_string($conn, $_POST['textArea']);
		
			// create query for entering data
			$sql = "INSERT INTO General(email, Message) VALUES('$email', '$textArea')";

			// saves data from user to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
      }
    } 
    //ends connection. this needs to be at the end of all queries run
    mysqli_close($conn);
  }
?>
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
