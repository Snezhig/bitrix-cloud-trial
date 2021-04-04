<?php


namespace XS\BX24\Trial\Models;


use PDO;

class UserMapper
{

    private PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function insert(User $user): bool
    {
        if ($user->getBxId() <= 0) {
            throw new \InvalidArgumentException('bx_id must be more than 0');
        }
        $stmt = $this->pdo->prepare('INSERT INTO users (bx_id, last_lead_timestamp) VALUES (:id, :stamp)');
        $stmt->execute([
            ':id'    => $user->getBxId(),
            ':stamp' => $user->getLastLeadTimestamp()
        ]);
        return (int)$this->pdo->lastInsertId() === $user->getBxId();
    }

    /**
     * @return User[]
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users');
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch()) {
            $result[] = new User($row);
        }
        return $result;
    }

}