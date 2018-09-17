<?php
	function __autoload($class_name){
		require_once 'classes/' . $class_name . '.php';
	}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <div class="content-center">

<?php

$cliente = new cliente();
if(isset($_POST['cadastrar'])):
  $nome  = $_POST['nome'];
  $divida = $_POST['divida'];
  $telefone = $_POST['telefone'];
  $cliente->setNome($nome);
  $cliente->setDivida($divida);
  $cliente->setTelefone($telefone);
  # Insert
  if($cliente->insert()){
    echo "Inserido com sucesso!";
  }
endif;
?>

<body>
<header class="masthead">
  <h1 class="btn-padding muted d-flex justify-content-center">Cadastrar dívidas dos clientes</h1>
  <nav class=" navbar btn-pagina-inicial d-flex justify-content-center  btn-padding">
    <div class="navbar-inner">
      <div class="container-fluid">
        <ul class="nav">
          <li class="active"><a href="index.php" class="
          btn btn-secondary " >Página inicial</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<?php 
if(isset($_POST['atualizar'])):
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $divida = $_POST['divida'];
  $telefone = $_POST['telefone'];
  $cliente->setNome($nome);
  $cliente->setDivida($divida);
  $cliente->setTelefone($telefone);
  if($cliente->update($id)){
    echo "Atualizado com sucesso!";
  }
endif;
?>

<?php
if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
  $id = (int)$_GET['id'];
  if($cliente->delete($id)){
    echo "Deletado com sucesso!";
  }
endif;
?>

<?php
if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
  $id = (int)$_GET['id'];
  $resultado = $cliente->find($id);
?>

<form method="post" action="">
  <div class="form-group col-md-4">
    <i class="fas fa-dollar-sign"></i></span>
    <input type="text" class="form-control" name="nome" value="<?php echo $resultado->nome; ?>" placeholder="Nome:" />
  </div>
  <div class="form-group col-md-4">
    <span class="add-on"><i class="icon-envelope"></i></span>
    <input class="form-control" type="float" name="divida" value="<?php echo $resultado->divida; ?>" placeholder="Dívida:" />
  </div>
  <div class="form-group col-md-4">
    <span class="add-on"><i class="icon-envelope"></i></span>
    <input type="text" name="telefone" value="<?php echo $resultado->telefone; ?>" placeholder="Telefone:" />
  </div>
  <input type="hidden" name="id" value="<?php echo $resultado->id; ?>">
  <br />
  <input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">				
</form>


<?php }else{ ?>


<form method="post" action="">
  <div class="form-row">
  <div class="col-md-10">
    <span class="add-on"><i class="icon-user"></i></span>
    <input class="form-control" type="text" name="nome" placeholder="Nome:" />
</div>
</div>
  <div class="form-row">
  <div class="col-md-10">
    <span class="add-on"><i class="icon-envelope"></i></span>
    <input class="form-control" type="text" name="divida" placeholder="Dívida:" />
  </div>
</div>
  <div class="form-row">
  <div class="col-md-10">
    <span class="add-on"><i class="icon-envelope"></i></span>
    <input class="form-control" type="tel" name="telefone" placeholder="Telefone:" />
  </div>
</div>

  <br />
  <div class=" form-group-row">
    <div class= "col-sm-10  d-flex justify-content-center btn-padding">
  <input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar dados">					
</div>
</div>
</form>

<?php } ?>

<table class="table table-hover table-dark">
  
  <thead>
    <tr>
      <th>#</th>
      <th>Nome:</th>
      <th>Dívida:</th>
      <th>Telefone:</th>
      <th>Ações:</th>
    </tr>
  </thead>
  
  <?php foreach($cliente->findAll() as $key => $value): ?>

  <tbody>
    <tr>
      <td><?php echo $value->id; ?></td>
      <td><?php echo $value->nome; ?></td>
      <td><?php echo $value->divida; ?></td>
      <td><?php echo $value->telefone; ?></td>
      <td>
        <?php echo "<a href='index.php?acao=editar&id= role=button class=btn btn-info" . $value->id . "'>Editar</a>"; ?>
        <?php echo "<a href='index.php?acao=deletar&id=" . $value->id . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
      </td>
    </tr>
  </tbody>

  <?php endforeach; ?>
</div>
</table>
</body>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  </body>
</html>