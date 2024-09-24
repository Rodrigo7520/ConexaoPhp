<?php 
$connect = mysql_connect('localhost','root','');
$db = mysql_select_db('bancodedados');
$query_select = "SELECT email FROM senha WHERE id = '$id'";
$select = mysql_query($query_select, $connect);
$array = mysql_fetch_array($select);
$logarray = $array['email'];

$email = $_POST['email'];
$novaSenha = $_POST['novasenha'];
$repetirSenha = MD5($_POST['repetirSenha']);
 
  if($email == "" || $email == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='
    senha.html';</script>";
 
    }else{
      if($logarray == $email){
 
        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login já existe');window.location.href='
        senha.html';</script>";
        die();
 
      }else{
        $query = "INSERT INTO senha (email, novaSenha, redefinirSenha) VALUES ('?','?','?')";
        $insert = mysql_query($query,$connect);
         
        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuário cadastrado com sucesso!');window.location.
          href='senha.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');window.location
          .href='senha.html'</script>";
        }
      }
      $sql = "DELETE FROM senha WHERE id = '$id'";

  if ($connect->query($sql) === TRUE) {
      echo "Registro excluído com sucesso";     
  } else {
      echo "Erro: " . $sql . "<br>" . $conn->error;
  }

  //O comando UPDATE é utilizado para modificar dados existentes em uma tabela. 
  $sql2 = "UPDATE senha SET email='$email' WHERE id ='$id'";

  if ($conn->query($sql2) === TRUE) {
    echo "Registro atualizado com sucesso";
  } else {
    echo "Erro: " . $sql2. "<br>" . $conn->error;
  }
}

    $query->close();
    $sql->close();
    $sql2->close();
    $connect->close();
    
?>
