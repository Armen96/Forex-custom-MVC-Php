<!DOCTYPE html>
<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "<?= $baseurl ?>/a_assets/css/login.css">
        <link rel = "stylesheet" type = "text/css" href = "<?= $baseurl ?>/a_assets/css/font-awesome.min.css">
    </head>
    <body>
        <div id='mainForm'>
            <h1>Petlox</h1>
            <div id='div_form'>
                <form id='form' action='' method='post'>
                    <div id='sign_in'>Log in</div>
                    <div id="login">
                        <div class='input_user'>
                            <input id="log" class="input" type="text" name="login" placeholder="Login">	
                            <span class='icon_input' <?php if (isset($_SESSION['error'])) echo "style='color:" . $_SESSION['error'] . "'"; ?>><i class="fa fa-user"></i></span>
                        </div>
                        <div class='input_user'>
                            <input id="pass" class="input" type="password" name="password" placeholder="password">
                            <span class='icon_input' <?php if (isset($_SESSION['error'])) echo "style='color:" . $_SESSION['error'] . "'"; ?> ><i class="fa fa-lock"></i></span>							
                        </div>
                        <button id='login_but' for="form">Login</button>
                        <p id="error"></p>
                    </div>	
                </form>	
            </div>
        </div>	
    </body>
</html>