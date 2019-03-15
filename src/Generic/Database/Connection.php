<?php
namespace Generic\Database;

// permet d'établir connexion avec bdd et de lancer requête sql

class Connection
{
    private $pdo;

    public function __construct(string $databaseName, string $databaseUser, string $databasePass)
    {
        // info nécessaire
        $dsn ='mysql:host=localhost;dbname=bdd_mysql_command'.$databaseName;
        $this->connect($dsn, $databaseUser, $databasePass);
    }


// etablit une connexion avec la base de données
// @param string $dsn
// @param string $user
// @param string $pass

    private function connect(string $dsn, string $user, string $pass): void
    {
        try {
            $this->pdo = new \PDO($dsn, $user, $pass, [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET names utf8"]);
        } catch (PDOException $e) {
            echo "Erreur lors de la connexion: " . $e->getMessage() . "<br/>";
            die(); // Arrêt du script
        }
    }

    public function query(string $query)
    {
        $pdoStatement = $this->pdo->query($query);
        return $pdoStatement->fetchAll();
    }

    public function preparedQuery(int $id):array
    {
        // préparation
        $query= "SELECT * FROM product WHERE id = :id";
        $statement = $this->pdo->prepare($query);

        // execution
        // $id = 1;
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetchAll();
    }
}
