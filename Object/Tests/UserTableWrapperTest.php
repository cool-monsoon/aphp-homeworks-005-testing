<?php 
declare(strict_types=1);

namespace Tests;

require_once './autoload.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tables\UserTableWrapper;
//use Interfaces\TableWrapperInterface;


class UserTableWrapperTest extends TestCase
{
    protected $userTable;
    
    public function create()
    {
      return new UserTableWrapper();
    }

    public static function insertProvider(): array
    {
        return [
            [['id' => 1, 'login' => 'user']],
            [['id' => 2, 'login' => 'user2']]
        ];
    }

    #[DataProvider('insertProvider')]

    public function testInsert(array $values): void
    {
        $this->userTable = $this->create();
        $this->userTable->insert($values);
        $userTableGet = $this->userTable->get();
        $this->assertContains($values, $userTableGet);
    }

    public function testGet(): void
    {
        
        $expected = ['id' => 1, 'login' => 'user'];
        $this->userTable = $this->create();
        $this->userTable->insert($expected);
        $result = $this->userTable->get();

        $this->assertEquals($expected, $result[0]);
    }

    public function testUpdate(): void
    {
      $this->userTable = $this->create();
        $this->userTable->insert(['id' => 1, 'login' => 'user']);
        $updatedArr = $this->userTable->update(1, ['login' => 'user5']);

        $this->assertSame('user5', $updatedArr['login']);
    }

    #[DataProvider('insertProvider')]
    public function testDelete($values):void
    {
        $this->userTable = $this->create();
        $this->userTable->insert($values);
        $this->userTable->delete(1);

        $this->assertNotContains(['id' => 1, 'login' => 'user'], $this->userTable->get());
    }
   
}