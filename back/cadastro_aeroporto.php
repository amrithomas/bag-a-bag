<!DOCTYPE html>
<html>
<head>
	<title>Formulário de Aeroportos</title>
</head>
<body>

	<h1>Cadastro de Aeroportos</h1>

	<form action="controller/controller_cadastro_aeroporto.php" method="POST">

		<label for="sigla">Sigla:</label>
		<input type="text" id="sigla" name="sigla" required><br>

		<label for="nome_aeroporto">Nome do Aeroporto:</label>
		<input type="text" id="nome_aeroporto" name="nome_aeroporto" required><br>

		<label for="pais">País:</label>
		<input type="text" id="pais" name="pais" required><br>

		<label for="cidade">Cidade:</label>
		<input type="text" id="cidade" name="cidade" required><br>

		<input type="submit" value="Enviar">

	</form>

</body>
</html>
