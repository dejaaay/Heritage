
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/login.css" rel="stylesheet">
        <link rel="shortcut icon" href="https://raw.githubusercontent.com/dejaaay/Cabelen/main/assets/img/Cabalen.png">
        <title>LogIn</title>
    </head>
    <style>
    body {
      background-image: url('../img/loginbg.png');
    }
    </style>
    <body style="background-color:grey;     
    display: flex;
    align-items: center;
    justify-content: center;">

    <div class="login" id="login" style=>
      <form  method="post" onSubmit="validate();">
        
        <h1 style="padding-top: 20px;">LogIn</h1>
        
        <fieldset>
        <?php if(isset($msg)){?>
        <tr>
        <td colspan="3" align="center" valign="top"><?php echo $msg;?></td>
        </tr>
         <?php } ?>
          <label for="mail" style="padding-top: 10px;" name="email">Email:</label>
          <input type="email" id="mail" name="user_email">
          
          <label for="password" name="password">Password:</label>
          <input type="password" id="user_password" name="user_password">
    
        </fieldset>
     
        <button name="Submit" type="submit">LogIn</button>
        
      </form>
      </div>
      <script> 
    </script>
    </body>
</html>