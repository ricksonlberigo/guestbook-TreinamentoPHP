<?php

require_once __DIR__ . '/./guestbookController.php';

function connect()
{
  return fopen(getenv('GUESTBOOK'), 'a+');
}

function close($handle)
{
  fclose($handle);
}

// Save Visitor
function saveVisitor(array $visitor)
{
  $handle = connect();
  fputcsv($handle, $visitor);
  close($handle);
}

// Find Visitor
function findVisitor(string $email)
{
  $handle = connect();
  while (false === feof($handle)) {
    $register = fgetcsv($handle);
    if ($register && $register[0] == $email) {
      return [
        'email' => $register[0],
        'name' => $register[1]
      ];
    }
  }
  close($handle);
  return null;
}

// Delete Visitor
function deleteVisitor(string $email)
{
  $handle = connect();
  $tmp = fopen('tmp_delete.csv', 'w');
  while (false === feof($handle)) {
    $register = fgetcsv($handle);
    if ($register && $register[0] != $email) {
      fputcsv($tmp, $register);
    }
  }
  close($handle);
  fclose($tmp);
  unlink(getenv('GUESTBOOK'));
  rename('tmp_delete.csv', getenv('GUESTBOOK'));
}
