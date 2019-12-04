<?php include "incluir/cabecalho_site.php"; ?>

<body>
	<div class='container box-mensagem-crud'>
		<?php 
		require 'conexao.php';

		// Atribui uma conexão PDO
		$conexao = conexao::getInstance();

		// Recebe os dados enviados pela submissão
		$acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
		$id_cpf   = (isset($_POST['cpf'])) ? str_replace(array('.','-'), '', $_POST['cpf']): '';
		$data  = (isset($_POST['data'])) ? $_POST['data'] : '';
		$hora  = (isset($_POST['hora'])) ? $_POST['hora'] : '';
		$valor  = (isset($_POST['valor'])) ? $_POST['valor'] : '';
		$pagamento    		  = (isset($_POST['status'])) ? $_POST['status'] : '';
		$comparecimento    		  = (isset($_POST['status_comp'])) ? $_POST['status_comp'] : '';
		$anotacoes  = (isset($_POST['anotacoes'])) ? $_POST['anotacoes'] : '';

		// Valida os dados recebidos
		$mensagem = '';
		if ($acao == 'editar' && $id_cpf == ''):
		    $mensagem .= '<li>CPF do registros desconhecido.</li>';
	    endif;

	    // Se for ação diferente de excluir valida os dados obrigatórios
	    if ($acao != 'excluir'):
			
			if ($id_cpf == ''):
			   $mensagem .= '<li>Favor preencher o CPF.</li>';
		    elseif(strlen($id_cpf) < 11):
				  $mensagem .= '<li>Formato do CPF inválido.</li>';
		    endif;

		    if ($data == ''): 		
				$mensagem .= '<li>Favor preencher a Data de Agendamento.</li>';
			endif;

			if ($hora == ''): 		
				$mensagem .= '<li>Favor preencher a Hora de Agendamento.</li>';
			endif;

			if ($valor == ''):
			   $mensagem .= '<li>Favor preencher o Valor.</li>';
		    elseif(strlen($valor) < 0 ):
				  $mensagem .= '<li>Formato do valor inválido.</li>';
		    endif;


			if ($mensagem != ''):
				$mensagem = '<ul>' . $mensagem . '</ul>';
				echo "<div class='alert alert-danger' role='alert'>".$mensagem."</div> ";
				exit;
			endif;

		endif;



		// Verifica se foi solicitada a inclusão de dados
		if ($acao == 'incluir'):

			$sql = 'INSERT INTO `tab_agenda` (`data`, `hora`,`pagamento`, `comparecimento`, `anotacoes`, `id_cpf`, `valor`)
			VALUES(:data, :hora, :pagamento, :comparecimento, :anotacoes, :id_cpf, :valor)';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':data', $data);
			$stm->bindValue(':hora', $hora);
			$stm->bindValue(':pagamento', $pagamento);
			$stm->bindValue(':comparecimento', $comparecimento);
			$stm->bindValue(':anotacoes', $anotacoes);
			$stm->bindValue(':id_cpf', $id_cpf);			
			$stm->bindValue(':valor', $valor);						
			
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=agenda.php'>";
		endif;


		// Verifica se foi solicitada a edição de dados
		if ($acao == 'editar'):

			$sql = 'UPDATE tab_agenda SET data=:data, hora=:hora, pagamento=:pagamento, comparecimento=:comparecimento, anotacoes=:anotacoes, valor=:valor';
			$sql .= 'WHERE id_cpf=:id_cpf';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':data', $data);
			$stm->bindValue(':hora', $hora);
			$stm->bindValue(':pagamento', $pagamento);
			$stm->bindValue(':comparecimento', $comparecimento);
			$stm->bindValue(':anotacoes', $anotacoes);
			$stm->bindValue(':id_cpf', $id_cpf);			
			$stm->bindValue(':valor', $valor);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=agenda.php'>";
		endif;


		// Verifica se foi solicitada a exclusão dos dados
		if ($acao == 'excluir'):

			
			// Exclui o registro do banco de dados
			$sql = 'DELETE FROM `tab_agenda` WHERE `tab_agenda`.`data`=:data AND `tab_agenda`.`hora`=:hora AND `tab_agenda`.`id_cpf`=:id_cpf';
//			$sql = 'DELETE FROM tab_agenda WHERE id_cpf=:id_cpf';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':data', $data);
			$stm->bindValue(':hora', $hora);
			$stm->bindValue(':id_cpf', $id_cpf);
			
			$retorno = $stm->execute();


			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
			endif;

//			echo "<meta http-equiv=refresh content='3;URL=agenda.php'>";
		endif;
		?>

	</div>
</body>
</html>