<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Entities\User;


class UserRepository extends BaseRepository
{
    //private \PDO $pdo;
    //private $db;

    private string $table = 'users';
   
    /*
    public function __construct(\PDO $pdo)
    {
        // Recommended PDO attributes (set here or where you build PDO)
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $this->pdo = $pdo;
    }
    */
public function insert(User $u): int
    {
        $sql = "INSERT INTO {$this->table} (
            user_id, user_name, email, password, first_name, last_name, phone_number, verification_code,alias,
            /*is_active, is_blocked, is_reported, is_special,*/
            login_type, user_type, status, suscription_id,
            birthday, last_login, created_at, updated_at
        ) VALUES (
            :user_id, :user_name, :email, :password, :first_name, :last_name, :phone_number, :verification_code,:alias,
            /*:is_active, :is_blocked, :is_reported, :is_special,*/
            :login_type, :user_type, :status, :suscription_id,
            :birthday, :last_login, :created_at, :updated_at
        )";
        $stmt = $this->pdo->prepare($sql);
        $data = $this->bindUserParams($u);
        $stmt->execute($data);
        $id = (int)$this->pdo->lastInsertId();
        $u->setId($id);
        return $id;
        
    }

    public function update(User $u): bool
    {
        if ($u->getId() === null) {
            throw new \InvalidArgumentException('Cannot update User without id');
        }
        $sql = "UPDATE {$this->table} SET
            user_id = :user_id,
            user_name = :user_name,
            email = :email,
            password = :password,
            first_name = :first_name,
            last_name = :last_name,
            phone_number = :phone_number,
            verification_code = :verification_code,
            alias = :alias,
            is_active = :is_active,
            is_blocked = :is_blocked,
            is_reported = :is_reported,
            is_special = :is_special,
            login_type = :login_type,
            user_type = :user_type,
            status = :status,
            suscription_id = :suscription_id,
            birthday = :birthday,
            last_login = :last_login,
            created_at = :created_at,
            updated_at = :updated_at
        WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $data = $this->bindUserParams($u);
        $data[':id'] = $u->getId();
        return $stmt->execute($data);
    }

// Upsert helper: insert if new, else update
    public function save(User $u): int
    {
        if ($u->getId() === null) {
            return $this->insert($u);
        }
        $this->update($u);
        return (int)$u->getId();
    }
    // Read — by primary key
    public function findById(int $id): ?User
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ? User::fromArray($row) : null;
    }

    // Read — by user_id (UUID)
    public function findByUserId(string $userId): ?User
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        $row = $stmt->fetch();
        return $row ? User::fromArray($row) : null;
    }
    // Read — by email
    public function findByEmail(string $email): ?User
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch();
        return $row ? User::fromArray($row) : null;
    }
    // List with optional filters and pagination
    public function list(
        ?bool $isActive = null,
        ?int $limit = 50,
        ?int $offset = 0,
        ?string $orderBy = 'id',
        string $direction = 'DESC'
    ): array {
        $allowedOrder = ['id','created_at','email','user_name','last_login'];
        if (!in_array($orderBy, $allowedOrder, true)) {
            $orderBy = 'id';
        }
        $direction = strtoupper($direction) === 'ASC' ? 'ASC' : 'DESC';
        $where = [];
        $params = [];
        if ($isActive !== null) {
            $where[] = 'is_active = :is_active';
            $params[':is_active'] = $isActive ? 1 : 0; // BIT -> tinyint param
        }
        $whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';
        $limitSql = $limit !== null ? ' LIMIT :limit' : '';
        $offsetSql = $offset !== null && $limit !== null ? ' OFFSET :offset' : '';
        $sql = "SELECT * FROM {$this->table} {$whereSql} ORDER BY {$orderBy} {$direction}{$limitSql}{$offsetSql}";
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, \PDO::PARAM_INT);
        }
        if ($limit !== null) {
            $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        }
        if ($offset !== null && $limit !== null) {
            $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        }
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $users = [];
        foreach ($rows as $row) {
            $users[] = User::fromArray($row);
        }
        return $users;
    }
    // Delete — by id
    public function deleteById(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    // Count (optionally filtered)
    public function count(?bool $isActive = null): int
    {
        $where = '';
        $params = [];
        if ($isActive !== null) {
            $where = 'WHERE is_active = :is_active';
            $params[':is_active'] = $isActive ? 1 : 0;
        }
        $sql = "SELECT COUNT(*) AS c FROM {$this->table} {$where}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    }




    private function bindUserParams(User $u): array
    {
        // Convert entity to DB-friendly values
        return [
            ':user_id' => $u->getUserId(), // DB has default UUID(), but we allow explicit set
            ':user_name' => $u->getUserName(),
            ':email' => $u->getEmail(),
            ':password' => $u->getPassword(),
            ':first_name' => $u->getFirstName(),
            ':last_name' => $u->getLastName(),
            ':phone_number' => $u->getPhoneNumber(),
            ':verification_code' => $u->getVerificationCode(),
            ':alias' => $u->getAlias(),
           // ':is_active' => $u->isActive() ? 1 : 0,
           // ':is_blocked' => $u->isBlocked() ? 1 : 0,
           // ':is_reported' => $u->isReported() ? 1 : 0,
           // ':is_special' => $u->isSpecial() ? 1 : 0,
            ':login_type' => $u->getLoginType(),
            ':user_type' => $u->getUserType(),
            ':status' => $u->getStatus(),
            ':suscription_id' => $u->getSuscriptionId(),
            ':birthday' => $u->getBirthday()?->format('Y-m-d'),
            ':last_login' => $u->getLastLogin()?->format('Y-m-d H:i:s'),
            ':created_at' => $u->getCreatedAt()->format('Y-m-d H:i:s'),
            ':updated_at' => $u->getUpdatedAt()?->format('Y-m-d H:i:s'),
        ];
    }


    public function updateLastLogin(int $u): bool
    {
        $sql = "UPDATE {$this->table} SET last_login = NOW() WHERE id =" . $u;

         $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([]);
    }



}

//Usages

/*

php


<?php
$pdo = new PDO(
    'mysql:host=127.0.0.1;dbname=your_db;charset=utf8mb4',
    'your_user',
    'your_pass',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);
$repo = new UserRepository($pdo);
// Create
$user = new User();
$user
    ->setUserId('') // leave empty if you want DB default; else set a UUID string
    ->setUserName('jdoe')
    ->setEmail('jdoe@example.com')
    ->setPassword(password_hash('secret', PASSWORD_DEFAULT))
    ->setFirstName('John')
    ->setLastName('Doe')
    ->setPhoneNumber('+52 55 1234 5678')
    ->setVerificationCode('ABC123')
    ->setIsActive(true)
    ->setCreatedAt(new DateTimeImmutable('now'));
$id = $repo->insert($user);
// Read
$found = $repo->findById($id);
// Update
$found->setLastLogin(new DateTimeImmutable('now'))
      ->setUpdatedAt(new DateTimeImmutable('now'));
$repo->update($found);
// List
$list = $repo->list(isActive: true, limit: 20, offset: 0);
// Delete
$repo->deleteById($id);


*/