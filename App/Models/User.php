<?php

namespace App\Models;

class User
{
    private static $table = 'user';

    public static function select(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function selectAll()
    {
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . '(email, password ,name) VALUES (:email,:password,:name)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':password', $data['password']);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir usuário(a)!");
        }
    }

    public static function put($data)
    {
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = "UPDATE " . self::$table . " SET email=:email, password=:password, name=:name WHERE id = :id";

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $data['id']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':password', $data['password']);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) atualizado com sucesso!';
        } else {
            throw new \Exception("Falha ao atualizar usuário(a)!");
        }
    }

    public static function delete($data)
    {
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = "DELETE FROM " . self::$table . " WHERE id = :id";

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', intval($data['id']));

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) deletado com sucesso!';
        } else {
            throw new \Exception("Falha ao deletar usuário(a)!");
        }
    }
}
