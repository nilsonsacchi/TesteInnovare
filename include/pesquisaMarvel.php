<?php

class Cards{
	public $nome;
	public $descricao;
	public $imagem;
	public $maisDetail;
	public $maisComic;
	public $maisWiki;

	public function __construct($nome, $descricao, $imagem, $maisDetail, $maisComic, $maisWiki){
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->imagem = $imagem;
		$this->maisDetail = $maisDetail;
		$this->maisComic = $maisComic;
		$this->maisWiki = $maisWiki;
	}
}	
		
class Marvel{
	
	private function getMarvelFromApi($conteudo)
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
		
		return $json;
	}
	
	public static function getMarvel($conte)
	{
		//$conteudo = $_POST['consulta'];
		
		//echo $conte;
		
		//Chama a api e retorna o json
		$json = Marvel::getMarvelFromApi($conte);
		
		//echo "<pre>";
		//print_r($json);
		//echo "</pre>";

		$cardss = array();		
		foreach($json->data->results as $itens)
		{
			//Nome do card
			$nome = $itens->name;
			
			//Descrição
			if ($itens->description == "")
			{
				$descricao = "Sem descrição";
			}else
			{
				$descricao = $itens->description;	
			}
			
			//Imagem
			$imagem = $itens->thumbnail->path . "." . $itens->thumbnail->extension;
			
			//Detalhe			
			foreach ($itens->urls as $urlsDetalhes)
			{
				if ($urlsDetalhes->type == "detail")
				{
					$maisDetail = $urlsDetalhes->url;
				}
				else{
					$maisDetail = "";
				}
				
				if ($urlsDetalhes->type == "wiki")
				{
					$maisWiki = $urlsDetalhes->url;
				}
				else{
					$maisWiki = "";
				}
				
				if ($urlsDetalhes->type == "comiclink")
				{
					$maisComic = $urlsDetalhes->url;
				}
				else{
					$maisComic = "";
				}
			}
			
			//Adiciona na class
			$card = new Cards($nome, $descricao, $imagem, $maisDetail, $maisComic, $maisWiki);
			
			array_push($cardss, $card);
		}
		
		return $cardss;
	}
}
?>
