<?php

if(isset($_REQUEST['valor'])and($_REQUEST['valor'] == 'enviado')){
    session_start();
    $_SESSION['cadastro'] = $_POST['cadastro'];
    $_SESSION['senha'] = $_POST['senha'];
    
    echo "<a href='sessao2.php'>Ir para a página da Empresa</a>";
}
else{
    ?>
    <form name="form1" action="sessao2.php" value="enviado" method="Post">
   <!--Digite seu Usuário:-->
    <input type="text" name="cadastro"></br>
    <!--Digite sua Senha:-->
    <input type="text" name="senha"></br>
    <input type="submit" value="Enviar"></br>
    </form>
<?php 
}
?>
