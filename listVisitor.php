<?php

require_once __DIR__ . '/./guestbookRepository.php';

$config = parse_ini_file('config.ini');
putenv('GUESTBOOK=' . $config['GUESTBOOK']);

$email = $_GET['email'] ?? NULL;
$visitors = listAllVisitors($email);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Guestbook - Treinamento PHP Hypersoft" />
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

  <title>Guestbook - Treinamento PHP Hypersoft</title>
</head>

<body>
  <div class="container">
    <h2 class="text-center mt-5">Lista de visitantes</h2>

    <form method="GET" class="row g-3 mt-5">
      <div class="col-9">
        <input type="email" class="form-control" value="<?= $email ?>" name="email" placeholder="Digite o e-mail para pesquisar">
      </div>
      <div class="col-3">
        <input type="submit" class="btn btn-primary" value="Procurar visitante" />
      </div>
    </form>

    <table class="table mt-5">
      <thead>
        <tr>
          <th scope="col">E-mail</th>
          <th scope="col">Nome</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($visitors as $visitor) : ?>
          <tr>
            <td><?= $visitor['email']; ?></td>
            <td><?= $visitor['name']; ?></td>
            <td>
              <a href="./editVisitor.php?email=<?= $visitor['email']; ?>" class="btn btn-secondary btn-sm">Editar</a>
              <a href="./deleteVisitor.php?email=<?= $visitor['email']; ?>" class="btn btn-danger btn-sm">Deletar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>