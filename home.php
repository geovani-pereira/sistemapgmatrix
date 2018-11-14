<?php
		session_start();		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == "admin"){
			include "menu.php";
			exit;
		}else{
			include "menufunc.php";
			exit;
		}
?>
<div class="container">
    <div class="row">
        <div class=" col-md-12 text-center">
	        <br></br>
	        <br></br>
	        <br></br>
	        <br></br>
            <img src="imagens/logo.png" width="300"> 
        </div>              
    </div>
</div>