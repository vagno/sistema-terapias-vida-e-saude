<?php
/*
require 'conexao.php';

// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)):

	$conexao = conexao::getInstance();

	$sql = 'SELECT `tab_clientes`.`foto`,`tab_clientes`.`nome`, `tab_agenda`.`valor`,`tab_agenda`.`id_cpf`, `tab_agenda`.`data`, `tab_agenda`.`hora`, `tab_agenda`.`pagamento`, `tab_agenda`.`comparecimento`, `tab_agenda`.`anotacoes`FROM `tab_clientes`, `tab_agenda` WHERE `tab_clientes`.`cpf`=`tab_agenda`.`id_cpf`';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);

else:

	// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
	$conexao = conexao::getInstance();
	$sql = 'SELECT `tab_clientes`.`foto`, `tab_clientes`.`nome`, `tab_agenda`.`valor`,`tab_agenda`.`id_cpf`, `tab_agenda`.`data`, `tab_agenda`.`hora`, `tab_agenda`.`pagamento`, `tab_agenda`.`comparecimento`, `tab_agenda`.`anotacoes`FROM `tab_clientes`, `tab_agenda` WHERE nome LIKE :nome';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':nome', $termo.'%');
	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
*/
?>

<?php include "incluir/cabecalho_site.php"; ?>

<body>
	<div class='container'>
		<fieldset>

			<?php
				include "incluir/cabecalho_menu.php";
			?>

			<!-- Cabeçalho da Listagem -->
			<legend><h2>Controle Monetário</h2></legend>


			<!-- Formulário de Pesquisa -->
			<form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
				<label class="col-md-2 control-label" for="termo">Pesquisar</label>
				<div class='col-md-7'>
			    	<input type="text" class="form-control" id="termo" name="termo" placeholder="Infome o Nome">
				</div>
			    <button type="submit" class="btn btn-primary">Pesquisar</button>
			    <a href='financeiro.php' class="btn btn-primary">Ver Todos</a>
			</form>

			<!-- Link para página de cadastro -->
			<a href='agendar.php' class="btn btn-success pull-right">Fazer Agendamento</a>
			<div class='clearfix'></div>

			<?php if(!empty($clientes)):?>

				<!-- Tabela de Clientes -->
				<table class="table table-striped">
					<tr class='active'>
						<th>Foto</th>
						<th>Nome</th>
						<th>CPF</th>
						<th>Data</th>
						<th>Hora</th>
						<th>Veio</th>
						<th>Valor</th>
						<th>Pagamento</th>
						<th>Anotações</th>
						<th>Ação</th>
					</tr>
					<?php foreach($clientes as $cliente):?>
						<tr>
							<td><img src='fotos/<?=$cliente->foto?>' height='40' width='40'></td>
							<td><?=$cliente->nome?></td>
							<td><?=$cliente->id_cpf?></td>
							<td><?=$cliente->data?></td>
							<td><?=$cliente->hora?></td>
							<td><?=$cliente->comparecimento?></td>
							<td><?=$cliente->valor?></td>
							<td><?=$cliente->pagamento?></td>
							<td><?=$cliente->anotacoes?></td>

							<td>
								<a href='editar_agenda.php?id_cpf=<?=$cliente->id_cpf?>' class="btn btn-primary">Editar</a>
								<a href='javascript:void(0)' class="btn btn-danger link_exclusao" rel="<?=$cliente->id_cpf?><?=$cliente->data?><?=$cliente->hora?>">Excluir</a>
							</td>
						</tr>	
					<?php endforeach;?>
				</table>

			<?php else: ?>

				<!-- Mensagem caso não exista clientes ou não encontrado  -->
				<h3 class="text-center text-primary">Não existem eventos cadastrados!</h3>
			<?php endif; ?>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>