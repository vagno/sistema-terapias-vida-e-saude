<?php
require 'conexao.php';

// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)):

	$conexao = conexao::getInstance();
	$sql = 'SELECT nome, cpf, idade, email, celular, status, foto FROM tab_clientes';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);

else:

	// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
	$conexao = conexao::getInstance();
	$sql = 'SELECT nome, cpf, idade, email, celular, status, foto FROM tab_clientes WHERE nome LIKE :nome OR email LIKE :email';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':nome', $termo.'%');
	$stm->bindValue(':email', $termo.'%');
	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
?>
<?php include "incluir/cabecalho_site.php"; ?>

<body>
	<div class='container'>
		<fieldset>
			<?php
				include "incluir/cabecalho_menu.php";
			?>
			<!-- Cabeçalho da Listagem -->
			<legend><h2>Listagem de Clientes</h2></legend>


			<!-- Formulário de Pesquisa -->
			<form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
				<label class="col-md-2 control-label" for="termo">Pesquisar</label>
				<div class='col-md-7'>
			    	<input type="text" class="form-control" id="termo" name="termo" placeholder="Infome o Nome">
				</div>
			    <button type="submit" class="btn btn-primary">Pesquisar</button>
			    <a href='cliente.php' class="btn btn-primary">Ver Todos</a>
			</form>

			<!-- Link para página de cadastro -->
			<a href='cadastro.php' class="btn btn-success pull-right">Cadastrar Cliente</a>
			<div class='clearfix'></div>

			<?php if(!empty($clientes)):?>

				<!-- Tabela de Clientes -->
				<table class="table table-striped">
					<tr class='active'>
						<th>Foto</th>
						<th>Nome</th>
						<th>CPF</th>
						<th>Idade</th>
						<th>E-mail</th>
						<th>Celular</th>
						<th>Status</th>
						<th>Ação</th>
					</tr>
					<?php foreach($clientes as $cliente):?>
						<tr>
							<td><img src='fotos/<?=$cliente->foto?>' height='40' width='40'></td>
							<td><?=$cliente->nome?></td>
							<td><?=$cliente->cpf?></td>
							<td><?=$cliente->idade?></td>
							<td><?=$cliente->email?></td>
							<td><?=$cliente->celular?></td>
							<td><?=$cliente->status?></td>
							<td>
								<a href='editar.php?cpf=<?=$cliente->cpf?>' class="btn btn-primary">Editar</a>
								<a href='javascript:void(0)' class="btn btn-danger link_exclusao" rel="<?=$cliente->cpf?>">Excluir</a>
							</td>
						</tr>	
					<?php endforeach;?>
				</table>

			<?php else: ?>

				<!-- Mensagem caso não exista clientes ou não encontrado  -->
				<h3 class="text-center text-primary">Não existem clientes cadastrados!</h3>
			<?php endif; ?>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>