<?php

require("include/pesquisaMarvel.php");

?>

<!DOCTYPE html>
	<html lang="pt-br">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>		
		<script src="public/js/jquery.js"></script>
		<script src="public/js/bootstrap.min.js"></script> 
		<script src="public/js/jquery.quicksearch.js"></script>
		<link rel="stylesheet" href="public/css/bootstrap.min.css">
		<link rel="stylesheet" href="public/css/pesquisar.css">
		<link rel="stylesheet" href="public/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>				
	<br>
	<title>Teste Innovare</title>
	<body>
	<br>
	<br>
	<div class="cabecalho">
		<h1>Pesquisa de personagens</h1>
		<br>	
		<br>	
		<br>	
	</div>
	<div class="pesquisar">			
		<form action="" method="POST">				
			<div>				
				<input name="consulta" placeholder="Digite..." type="search" class="form-control">						
			</div>
		</form>				
	</div>
	<br>
	<br>
		<div>
		<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$conteudo = $_POST['consulta'];
			$cards = array();
			$cards = Marvel::getMarvel($conteudo);
			$contador = 0;
			foreach($cards as $card): ?>
			<?php if ($contador == 0) {
				echo "<div class='w3-row-padding w3-margin-top'>";
			}?>
			  <div class="w3-third">
				<div class="w3-card">
				  <img src="<?php echo $card->imagem ?>" height="260" width="100%">
				  <div class="w3-container">
					<h6><?php echo $card->nome ?></h6>
					<h6><?php echo $card->descricao ?></h6>
					
					<!-- inserir os link para mais detalhes -->
					
					<?php if (!empty($card->maisDetail) or !empty($card->maisComic) or !empty($card->maisWiki)) { ?> 
						
					<div class="w3-dropdown-hover w3-mobile">
						<button class="w3-button">mais...<i class="fa fa-caret-down"></i></button>
							<div class="w3-dropdown-content w3-bar-block w3-dark-white">
								<?php if (!empty($card->maisDetail)) { ?> 
								<a href="<?php echo $card->maisDetail ?>" target="_blank" class="w3-bar-item w3-button w3-mobile">Detail</a>
								<?php } ?>
								
								<?php if (!empty($card->maisComic)) { ?> 
								<a href="<?php echo $card->maisComic ?>" target="_blank" class="w3-bar-item w3-button w3-mobile">Comic Link</a>
								<?php } ?>
								
								<?php if (!empty($card->maisWiki)) { ?> 
								<a href="<?php echo $card->maisWiki ?>" target="_blank" class="w3-bar-item w3-button w3-mobile">Wiki </a>
								<?php } ?>
							</div>
					</div>
					
					<?php } ?>
					
				  </div>
				</div>
			  </div>
			  <?php if ($contador == 2) {
				  echo "</div> ";
				 $contador =0;
			  }else{
				$contador = $contador + 1;				  
			  } 
			  endforeach;
		}?>
		</div>
	</body>	
</html>
