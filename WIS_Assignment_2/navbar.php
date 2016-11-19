<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="My Website" height="30" width="30"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
          <?php
          session_start();
          if(isset($_SESSION['user_id'])){
              echo "<li><a href=\"AccountSummary.php\"><img src=\"images/avatar.png\" alt=\"User Photo\" height=\"30\" width=\"30\"></a></li>";
              echo "<li><a href=\"logout.php\"> Sign Out</a></li>";
          }else{
              echo "<li><a href=\"login_signup.php\"><span class=\"glyphicon glyphicon-user\"></span> Login / Sign Up</a></li>";
          }
          ?>
      </ul>
    </div>
  </div>
</nav>