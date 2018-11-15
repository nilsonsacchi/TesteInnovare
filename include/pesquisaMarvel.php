<!DOCTYPE html>
	<html lang="pt-br">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>		
		<script src="public/js/jquery.js"></script>
		<script src="public/js/bootstrap.min.js"></script> 
		<script src="public/js/jquery.quicksearch.js"></script>
		<link rel="stylesheet" href="public/css/botaoVoltar.css">
	</head>				
	<br>
	<br>
	<title>Teste Innovare</title>
	<body>
		<!-- botão com estilo para figuras, não fechei a tag do botão para ter o efeito de clicar em qq card e voltar -->
		<button type="button" name="" value="" class="css3button" onclick='history.go(-1)'>
		<br>
		<br>
		<br>
	</body>
</html>

<?php

	//<input type='button' value='Voltar' onclick='history.go(-1)' />

	$conteudo = $_POST['consulta'];
	
	pesquisaMarvel($conteudo);
	
	
	function pesquisaMarvel($conteudo)
	{
		//Define os dados de cabeçalho da requisição
		$cabecalho = 'Content-Type: application/json';

		$ts = 1;
		$keyPublic = "3002d47a3b43a850792bb9518e59c1ad";
		$keyPrivate = "c806e5d931bd0a7f717f9e1f9bcfbea0f22ea6ba";
		
		$hash = md5($ts . $keyPrivate . $keyPublic);

		//$url = $urltmpInicio2 . "&apikey=" . $md5Key;
		$url = "https://gateway.marvel.com:443/v1/public/characters?ts=1&apikey=$keyPublic&nameStartsWith=$conteudo&hash=$hash";

		$ch = curl_init($url);
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		
		//Marca que vai enviar por POST(1=SIM), caso tpRequisicao seja igual a "POST"
		//curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_HTTPGET, 1);								

		//Passa o conteúdo para o campo de envio por POST
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $conteudoAEnviar);
		
		$cabecalho = array(
			'Content-Type: application/json',
			'X-AUTH-TOKEN: @@@@@@@@@@@@@@@@@@@');

		//Se foi passado como parâmetro, adiciona o cabeçalho à requisição
		curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecalho);

		//Marca que vai receber string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//Inicia a conexão
		$resposta = curl_exec($ch);
		
		//Fecha a conexão
		curl_close($ch);
		
		$json = json_decode($resposta);
		
		$arr = array();
		foreach($json->data->results as $itens)
		{
			//$arr = array("<img src=" . $itens->thumbnail->path . "." . $itens->thumbnail->extension . " float:right width='150px' height='200px' id='centro'>");
			echo "<img src=" . $itens->thumbnail->path . "." . $itens->thumbnail->extension . " float:right width='150px' height='200px' id='centro'>";
			
			//,"<span>" . $itens->name . "</span>"			
		}
		
		//print_r ($arr);

		//foreach($json->data->results as $itens)
		//{
		//	echo "<img src=" . $itens->thumbnail->path . "." . $itens->thumbnail->extension . " float:right width='150px' height='200px' id='centro'>";
		//	echo "<span>" . $itens->name . "</span>";
		//}
	}
?>


