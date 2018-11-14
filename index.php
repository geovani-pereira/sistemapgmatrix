
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <!-- Website CSS style -->
   <link rel="stylesheet" type="text/css" href="css/login.css">

    <!-- Website Font style -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!-- Fonts -->
    <script>
    $(function () { 
      //validação dos campos
      $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
      
    } );
  </script>

    <title>PG MATRIX </title>
  </head>
  <body>
    <div class="container">
      <div class="row main">
        <div class="panel-heading">
                 <div class="panel-title text-center">
                    <div class="title">
                        <img src="imagens/logo.png" width="300">
                    </div>
                    <hr/>
                  </div>
              </div> 
        <div class="main-login main-center">
          <form method="post" action="verifica.php">
            <div class="form-group">
              <label for="login" class="cols-sm-2 control-label">Usuário</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="login" id="login"  placeholder="Digite seu nome de usuário"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label">Senha</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="senha" id="senha"  placeholder="Digite sua senha"/>
                </div>
              </div>
            </div>

            <div class="form-group ">
              <button type="submit" class="btn btn-success btn-lg btn-block login-button">Efetuar Login</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>

    
  </body>
</html>