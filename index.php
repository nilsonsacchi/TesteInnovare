<?php

require("include/pesquisaMarvel.php");

//echo "<pre>";
//var_dump($cards);
//echo "</pre>";

//die();

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
		<link rel="stylesheet" href="public/css/font-awesome.min.css">
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
		</div>
		<div class="cabecalho">			
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
		
		<!-- exemplo  album de fotos
		<div class="w3-row-padding w3-margin-top">
		  <div class="w3-third">
			<div class="w3-card">
			  <img src="img_5terre.jpg" style="width:100%">
			  <div class="w3-container">      
				<h1>5 Terre</h1>
				<h6>5 Terre</h6>
				<h6>5 Terre</h6>
				
				
				<div class="w3-dropdown-hover w3-mobile">
					<button class="w3-button">... <i class="fa fa-caret-down"></i></button>
						<div class="w3-dropdown-content w3-bar-block w3-dark-white">
							<a href="#" class="w3-bar-item w3-button w3-mobile">Detail</a>
							<a href="#" class="w3-bar-item w3-button w3-mobile">Conic Link</a>
							<a href="#" class="w3-bar-item w3-button w3-mobile">Wiki </a>
						</div>
				</div>

			  </div>
			</div>
		  </div>

		  <div class="w3-third">
			<div class="w3-card">
			  <img src="img_monterosso.jpg" style="width:100%">
			  <div class="w3-container">
				<h1>Monterosso</h1>		      
				<h6>Monterosso</h6>
				
				
			  </div>
			</div>
		  </div>

		  <div class="w3-third">
			<div class="w3-card">
			  <img src="img_vernazza.jpg" style="width:100%">
			  <div class="w3-container">
				
			  </div>
			</div>
		  </div>
		</div>

		<div class="w3-row-padding w3-margin-top">
		  <div class="w3-third">
			<div class="w3-card">
			  <img src="img_manarola.jpg" style="width:100%">
			  <div class="w3-container">
				<h5>Manarola</h5>
			  </div>
			</div>
		  </div>

		  <div class="w3-third">
			<div class="w3-card">
			  <img src="img_corniglia.jpg" style="width:100%">
			  <div class="w3-container">
				<h5>Corniglia</h5>
			  </div>
			</div>
		  </div>

		  <div class="w3-third">
			<div class="w3-card">
			  <img src="img_riomaggiore.jpg" style="width:100%">
			  <div class="w3-container">
				<h5>Riomaggiore</h5>
			  </div>
			</div>
		  </div>
		</div>
		-->
		
		</div>
	</body>	
</html>