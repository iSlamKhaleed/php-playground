<?php
class IndexModel
{
    private $mysql;

    public function __construct()
    {
        $this->mysql = new PDO('mysql:host=localhost;dbname=mvc_demo', 'root', 'root', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function getAllEntries()
    {
        $stmt = $this->mysql->prepare('SELECT * FROM demo');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insert($details)
    {
        $stmt = $this->mysql->prepare('INSERT into demo (details) VALUES (?)');
        $stmt->execute([$details]);
    }

    public function update($id, $details)
    {
        $stmt = $this->mysql->prepare('UPDATE demo SET details = ? WHERE id = ?');
        $stmt->execute([$details, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->mysql->prepare('DELETE FROM demo WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function getEntry($id)
    {
        $stmt = $this->mysql->prepare('SELECT * FROM demo WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll()[0];
    }
}
