<?php

class Student
{
    /**
     * @var int
     */
    private $studentID;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;

    /**
     * @return int
     */
    public function getStudentID()
    {
        return $this->studentID;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public static function getByID($id)
    {
        $pdo   = MyDB::getPDOInstance();
        $query = $pdo->query('SELECT * FROM student WHERE studentID=' . $id);
        return $query->fetchObject(self::class);
    }

    public static function getAll(): array
    {
        $pdo   = MyDB::getPDOInstance();
        $query = $pdo->query('SELECT * FROM student ORDER BY lastname');
        return $query->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function getAllStudentID(): array
    {
        $pdo   = MyDB::getPDOInstance();
        $query = $pdo->query('SELECT studentID FROM student');
        return $query->fetchAll(PDO::FETCH_COLUMN, self::class);
    }

    public function updateInDB(): bool
    {
        $pdo = MyDB::getPDOInstance();
        return !!$pdo->exec('UPDATE student SET firstname= ' . $pdo->quote($this->firstname) . ',lastname= ' . $pdo->quote($this->lastname). ' WHERE studentID=' . $this->studentID);
    }

    public function deleteInDB(): bool
    {
        $pdo = MyDB::getPDOInstance();
        return !!$pdo->exec('DELETE FROM student WHERE studentID = ' . $pdo->quote($this->studentID));
    }

    public function createInDB()
    {
        $pdo  = MyDB::getPDOInstance();
        $exec = $pdo->exec('INSERT INTO student (firstname,lastName) VALUES (' . $pdo->quote($this->firstname) . ',' . $pdo->quote($this->lastname) . ')');
        if (!!$exec) {
            $this->studentID = $pdo->lastInsertId();
        }
        return !!$exec;
    }


}