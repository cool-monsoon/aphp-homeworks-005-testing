<?php declare(strict_types=1);
require_once './autoload.php';

use Tables\UserTableWrapper;

$userTable = new UserTableWrapper();
$userTable->insert(['id' => 1, 'login' => 'user1', 'email' => 'user1@gmail.com']);
$userTable->insert(['id' => 2, 'login' => 'user2', 'email' => 'user2@gmail.com']);
echo "user1 and user2 inserted" . PHP_EOL;;
$userTableRows = $userTable->get();
print_r($userTableRows);
echo "user2 updated" . PHP_EOL;;
$updatedArr = $userTable->update(2, ['login' => 'user5']);
print_r($updatedArr);
echo PHP_EOL;
echo 'user2 deleted' . PHP_EOL;
$userTable->delete(2);
$userTableRows = $userTable->get();
print_r($userTableRows);