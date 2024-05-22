<?php declare(strict_types=1);

namespace Tables;
use Interfaces\TableWrapperInterface;

class UserTableWrapper implements TableWrapperInterface
{
    private array $rows;
    public function insert(array $values): void
    {
        $this->rows[] = $values;
    }

    public function update(int $id, array $values): array
    {
        foreach ($this->rows as $row) {
            if ($row['id'] === $id) {
                $row = array_merge($row, $values);
                return $row;
            }
        }
        return [];
    }

    public function delete(int $id): void
    {
        foreach ($this->rows as $key => $row) {
            if ($row['id'] === $id) {
                unset($this->rows[$key]);
                return;
            }
        }
    }

    public function get(): array
    {
        return $this->rows;
    }
}