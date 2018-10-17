<?php session_start();
@header('Access-Control-Allow-Origin: *');
@header('Content-Type: application/json');
include 'configuracoes.php';
include 'conectar.php';
//include 'funcoes.php';
//include '../../includes/arrays.php';
$login = $_POST['email'];
$senha = $_POST['senha'];
$query = "SELECT * FROM ft_admin WHERE login = '$login' OR  email = '$login'";
$result = mysqli_query($link_db, $query);
$num_rows = mysqli_num_rows($result);
$mensagem = '';
if ($num_rows == 0)
{
    $mensagem = 'Usuário ou senha inválidos!';
	
}
while ($row = mysqli_fetch_array($result)) {

    if ( $row['senha'] != $senha)
    {
        $mensagem = 'Usuário ou senha inválidos!';
  
    }
    if ( $row['ativo'] == 0)
    {
        $mensagem = 'Usuário inativo! Entre em contato com um administrador.';
  
    }


    if ($row['avatar']=='')
    {
        $female = '';
        if($row['sexo']=='a')
        {
            $female = 'fe';
        }
        $row['avatar'] = $female.'male-default.jpg';
    }
	
	
	if ($mensagem)
	{
			$msgarray = array('msg' => $mensagem, 'nome' => 0, 'email' => 0, 'sexo' => 0);

	}
	else{
		
		$msgarray = array('msg' => 'Login realizado com sucesso!', 'nome' => $row['nome'], 'email' => $row['email'], 'sexo' => $row['sexo']);
	}
	echo json_encode($msgarray);

}