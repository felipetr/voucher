<?php session_start();
@header('Access-Control-Allow-Origin: *');
include 'configuracoes.php';
include 'conectar.php';
//include 'funcoes.php';
//include '../../includes/arrays.php';
$email = $_POST['email'];
$user = $_POST['user'];
$nome = strtolower($_POST['nome']);
$nome = str_replace('+',' ',$nome);

$cpf = str_replace('.','',$_POST['cpf']);
$cpf = str_replace('-','',$cpf);




$query = "SELECT * FROM ft_vouchers WHERE (LOWER(nome) LIKE  '%{$nome}%' OR  email = '{$email}' OR cpf = '{$cpf}') AND user = '{$user}' AND status = 1";


$result = mysqli_query($link_db, $query);
$num_rows = mysqli_num_rows($result);

if ($num_rows == 0)
{
    $mensagem = '<div class="alert alert-danger text-center">Nenhum usuário encontrado!</div>';
	
}else{

    $mensagem = '<div class="bg-transparent-dark p-3 py-1">';
while ($row = mysqli_fetch_array($result)) {
    $mensagem .= '<a href="validar.html?token='.$row['token'].'" class="btn-block my-2 btn radius-50 btn-light">'.$row['nome'].'</a>';
}

    $mensagem .= '</div>';

}

echo $mensagem;