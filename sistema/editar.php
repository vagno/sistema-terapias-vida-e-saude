<?php
require 'conexao.php';

// Recebe o id do cliente do cliente via GET
$id_cliente = (isset($_GET['cpf'])) ? $_GET['cpf'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id_cliente) && is_numeric($id_cliente)):

	// Captura os dados do cliente solicitado
	$conexao = conexao::getInstance();
	$sql = 'SELECT cpf, nome, email, cpf, idade, telefone, celular, status, foto FROM tab_clientes WHERE cpf = :cpf';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':cpf', $id_cliente);
	$stm->execute();
	$cliente = $stm->fetch(PDO::FETCH_OBJ);

endif;

?>
<?php include "incluir/cabecalho_site.php"; ?>

<body>
	<div class='container'>
		<fieldset>
			<legend><h1>Formulário - Edição de Cliente</h1></legend>
			
			<?php if(empty($cliente)):?>
				<h3 class="text-center text-danger">Cliente não encontrado!</h3>
			<?php else: ?>
				<form action="action_cliente.php" method="post" id='form-contato' enctype='multipart/form-data'>
					<div class="row">
						<label for="nome">Alterar Foto</label>
				      	<div class="col-md-2">
						    <a href="#" class="thumbnail">
						      <img src="fotos/<?=$cliente->foto?>" height="190" width="150" id="foto-cliente">
						    </a>
					  	</div>
					  	<input type="file" name="foto" id="foto" value="foto" >
				  	</div>

				    <div class="form-group">
				      <label for="nome">Nome</label>
				      <input type="text" class="form-control" id="nome" name="nome" value="<?=$cliente->nome?>" placeholder="Infome o Nome">
				      <span class='msg-erro msg-nome'></span>
				    </div>

				    <div class="form-group">
				      <label for="email">E-mail</label>
				      <input type="email" class="form-control" id="email" name="email" value="<?=$cliente->email?>" placeholder="Informe o E-mail">
				      <span class='msg-erro msg-email'></span>
				    </div>

				    <div class="form-group">
				      <label for="cpf">CPF</label>
				      <input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" value="<?=$cliente->cpf?>" placeholder="Informe o CPF">
				      <span class='msg-erro msg-cpf'></span>
				    </div>
				    <div class="form-group">
				      <label for="idade">Idade</label>
				      <input type="idade" class="form-control" id="idade" maxlength="14" name="idade" value="<?=$cliente->idade?>" placeholder="Informe a Idade">
				      <span class='msg-erro msg-idade'></span>
				    </div>				    
				    <div class="form-group">
				      <label for="telefone">Telefone</label>
				      <input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" value="<?=$cliente->telefone?>" placeholder="Informe o Telefone">
				      <span class='msg-erro msg-telefone'></span>
				    </div>
				    <div class="form-group">
				      <label for="celular">Celular</label>
				      <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" value="<?=$cliente->celular?>" placeholder="Informe o Celular">
				      <span class='msg-erro msg-celular'></span>
				    </div>
				    <div class="form-group">
				      <label for="status">Status</label>
				      <select class="form-control" name="status" id="status">
					    <option value="<?=$cliente->status?>"><?=$cliente->status?></option>
					    <option value="Sem débito">Sem débito</option>
				    	<option value="Com débito">Com débito</option>
					  </select>
					  <span class='msg-erro msg-status'></span>
				    </div>

				    <input type="hidden" name="acao" value="editar">
				    <input type="hidden" name="id" value="<?=$cliente->id?>">
				    <input type="hidden" name="foto_atual" value="<?=$cliente->foto?>">
				    <button type="submit" class="btn btn-primary" id='botao'> 
				      Gravar
				    </button>
				    <a href='index.php' class="btn btn-danger">Cancelar</a>
				</form>
			<?php endif; ?>
		</fieldset>

	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>