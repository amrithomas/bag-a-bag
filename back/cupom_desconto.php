

<!DOCTYPE html>
<html lang="pt-br">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro-Endereço</title>

</head>

<body >

  
    <form action="controller_cupom.php" method="post">

       
        
        <label>Código Cupom:</label>
        <input type="text" id="cupom" name="cupom" placeholder="XXX000" maxlength="6" required>

        <label>Valor em Porcentagem:</label>
        <input type="number" id="valor" name="valor" maxlength="3" placeholder="20" required>

       
      
      <!-- Botão -->
      <br><br><br><button type="submit">ENVIAR</button>
                 

    </form>
  
                
    


</body>
</html>