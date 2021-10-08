<?php
class Entity
{
    protected $table;

    public function findBy($col, $val)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $col . ' = ?');
        $stmt->execute([$val]);
        // $stmt->debugDumpParams();
        $entities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($entities) < 1)
            return false;
        $this->setValues($entities[0]);
        return true;
    }

    private function setValues($entity)
    {
        foreach ($entity as $col => $val)
            $this->$col = $val;
    }
}
