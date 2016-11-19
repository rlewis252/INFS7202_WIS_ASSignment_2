<?php include 'header.php'; ?>
    <body>
        <?php include 'navbar.php';?>

        <div class="container">
            <div class="row row-centered">
                <div class="col-xs-6 col-centered">
                    <h1>Login:</h1>
                    <form class="form-horizontal" role="form" action="login.php" method="POST" id="login_form">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">UserName:</label>
                      <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="username" placeholder="Enter Username">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Password:</label>
                      <div class="col-sm-10"> 
                          <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password">
                      </div>
                    </div>
                    <div class="form-group"> 
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-xs-6 col-centered">
                    <h1>Sign Up:</h1>
                    <form class="form-horizontal" role="form" action="signup.php" method="POST" id="sign_up_form">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Name:</label>
                      <div class="col-sm-10">
                          <input type="text" name="name" id="sign_up_name" class="form-control" placeholder="Enter Name">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Username:</label>
                      <div class="col-sm-10">
                          <input type="email" name="username" id="sign_up_username" class="form-control" placeholder="Enter Username(Email)...">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Password:</label>
                      <div class="col-sm-10"> 
                          <input type="password" class="form-control" id="sign_up_pwd" name="password" placeholder="Enter password">
                      </div>
                    </div>
                    <div class="form-group"> 
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <p id="error" style="color: red">
                    <?php
                        if(isset($_GET['error'])){
                            echo $_GET['error'];
                        }
                    ?>
                </p>
            </div>
            <br><br><br>
        </div>
<?php include 'footer.php'; ?>
    </body>
</html>
