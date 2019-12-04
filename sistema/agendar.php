<?php include "incluir/cabecalho_site.php"; ?>

<body>
	<div class='container'>
		<fieldset>
			<legend><h1>Formulário - Agendamento</h1></legend>
			
			<form action="action_agendar.php" method="post" id='form-contato' enctype='multipart/form-data'>
				
				<div class="form-group">
			      <label for="cpf">CPF</label>
			      <input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" placeholder="Informe o CPF">
			      <span class='msg-erro msg-cpf'></span>
			    </div>

			    <div class="form-group">
			      <label for="data">Data do Agendamento</label>
			      <input type="date" class="form-control" id="data" maxlength="10" name="data" placeholder="Infome a Data de Agendamento">
			      <span class='msg-erro msg-data'></span>
			    </div>

			    <div class="form-group">
			      <label for="hora">Hora do Agendamento</label>
			      <input type="time" class="form-control" id="hora" maxlength="10" name="hora" placeholder="Infome a Hora de Agendamento">
			      <span class='msg-erro msg-hora'></span>
			    </div>

			    <div class="form-group">
			      <label for="valor">Valor</label>
			      <input type="valor" class="form-control" id="valor" maxlength="10" name="valor"placeholder="Infome o valor">
			      <span class='msg-erro valor'></span>
			    </div>

			    <div class="form-group">
			      <label for="status">Pagamento Realizado</label>
			      <select class="form-control" name="status" id="status">
			      	<option value=''>Selecione uma Opção</option>
				    <option value="N">Não</option>
				    <option value="S">Sim</option>
				  </select>
				  <span class='msg-erro msg-status'></span>
			    </div>
			    
			    <div class="form-group">
			      <label>Compareceu a Consulta</label>
			      <select class="form-control" name="status_comp">
				    <option value="">Selecione uma Opção</option>
				    <option value="N">Não</option>
				    <option value="S">Sim</option>				    
				  </select>
			    </div>

			    <div class="form-group">
			      <label for="anotacoes">Observações</label>
			      <input type="text" class="form-control" id="anotacoes" maxlength="200" name="anotacoes" placeholder="Infome as Observações">
			      <span class='msg-erro msg-anotacoes'></span>
			    </div>

			    <input type="hidden" name="acao" value="incluir">
			    <button type="submit" class="btn btn-primary" id='botao'> 
			      Gravar
			    </button>
			    <a href='cliente.php' class="btn btn-danger">Cancelar</a>
			</form>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>