<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */

namespace App\Model;

use App\Model\Connection;
use PDO;

/**
 * Abstract class handling default manager.
 */
abstract class AbstractManager
{
    protected PDO $pdo; //variable de connexion

    /**
     * Initializes Manager Abstract class.
     * @param string $table
     */
    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getPdoConnection();
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAll(): array
    {
        return $this->pdo->query('SELECT * FROM ' . static::TABLE)->fetchAll();
    }

    /**
     * Get one row from database by ID.
     *
     * @param  int $id
     *
     * @return array
     */
    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
