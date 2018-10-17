<?php session_start();
@header('Access-Control-Allow-Origin: *');
include 'configuracoes.php';
include 'conectar.php';
//include 'funcoes.php';
//include '../../includes/arrays.php';
$token = $_POST['token'];
$user = $_POST['user'];
$nome = strtolower($_POST['nome']);
$nome = str_replace('+',' ',$nome);

$cpf = str_replace('.','',$_POST['cpf']);
$cpf = str_replace('-','',$cpf);




$query = "SELECT * FROM ft_vouchers WHERE token = '{$token}' AND user = '{$user}' AND status != 0";


$result = mysqli_query($link_db, $query);
$num_rows = mysqli_num_rows($result);

if ($num_rows == 0)
{
    $mensagem = '<div class="alert alert-danger text-center">Voucher indisponível!</div>';
	
}else{


while ($row = mysqli_fetch_array($result)) {
    if ($row['status'] == 2)
    {
        $datahora = $row['usadoem'];


        $data = explode(' ', $datahora)[0];
        $hora = explode(' ', $datahora)[1];

        $data = explode('-', $data);

        $data = $data[2].'/'.$data[1].'/'.$data[0];


        $horaapenas =  intval(explode(' ', $hora)[0]);

        $plural = ' à ';
        if ($horaapenas)
        {
            $plural = ' às ';
        }

        $datahora = $data.$plural.$hora;


        $mensagem = '<div class="alert alert-danger text-center">Voucher utilizado em '.$datahora.'!</div>';
    }else
    {
        $mensagem = '';
        $mensagem .= '<div class="text-center bg-transparent-dark p-5">';
        $mensagem .= '<h3>'.$row['nome'].'</h3>';
        $mensagem .= '<div class="mb-5">'.$row['email'].'</div>';
        $mensagem .= '<button class="btn btn-block radius-50 btn-success" onclick="validarvoucher(\''.$row['token'].'\');">Validar</button>';
        $mensagem .= '</div>';

    }

}



}

echo $mensagem;