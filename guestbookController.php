<?php

require_once __DIR__ . '/./guestbookRepository.php';

function debugger($code)
{
  echo '<pre>';
  print_r($code);
  echo '</pre>';
}

$config = parse_ini_file('config.ini');
putenv('GUESTBOOK=' . $config['GUESTBOOK']);

$visitor = [
  'email' => $_POST['email'] ?? NULL,
  'name' => $_POST['name'] ?? NULL,
];

try {
  if (!$visitor['email']) {
    throw new Exception('Preencha o campo e-mail para prosseguir');
  }
  if (!$visitor['name']) {
    throw new Exception('Preencha o campo nome para prosseguir');
  }
} catch (Exception $e) {
  header('Content-Type: text/html; charset=utf-8', true, 400);
  echo $e->getMessage() . '<br> <a href="' . $_SERVER['HTTP_REFERER'] . '">Voltar para a home.</a>';
  exit(1);
}

saveVisitor($visitor);
header('Location: ' . $_SERVER['HTTP_REFERER'], true, 303);
