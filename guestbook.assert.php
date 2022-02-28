<?php

require_once __DIR__ . '/./guestbookRepository.php';

$assertFile = 'guestbook.assert.csv';
putenv('GUESTBOOK=' . $assertFile);

$visitor = [
  'email' => 'teste@gmail.com',
  'name' => 'teste'
];

saveVisitor($visitor);
assert(
  strstr(file_get_contents($assertFile), $visitor['email']),
  new \Exception('não funcionou a função')
);

$foundedVisitor = findVisitor($visitor['email']);
assert($foundedVisitor == $visitor, new \Exception('Não encontrou o visitor'));

deleteVisitor($visitor['email']);
assert(0 < filesize($assertFile), new \Exception('Apagou a menos'));
