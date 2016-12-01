<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="js/3rdparty/cryptojs/sha1.js"></script>
  </head>
  <body>
    <?php
      session_start();
      if(isset($_SESSION["id"])) {
        session_destroy();
      }
      if($_GET["permission_err"] == "true") {
        if(!in_array($_SESSION["type"], array("admin"))) {
          printf("%s", "<script>alert('접근 권한이 없습니다');</script>");
        }
      }
    ?>
    <form id="login" action=/Accounts/login_process.php method=post>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">로그인</h3>
              </div>
              <div class="panel-body">
                <form accept-charset="UTF-8" role="form">
                  <fieldset>
                      <div class="form-group">
                        <input class="form-control" placeholder="아이디" name="id" type="text">
                      </div>
                      <div class="form-group">
                          <input class="form-control" placeholder="비밀번호" name="pw" type="password" 
                          value="">
                      </div>
                      <input class="btn btn-lg btn-success btn-block" type="submit" value="로그인하기">
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <script>
      $('#login').submit(function(){
        var passwd = document.forms["login"]["pw"].value;
        passwd = CryptoJS.SHA1(passwd);
        document.forms["login"]["pw"].value = passwd;
      });
    </script>
  </body>
</html>