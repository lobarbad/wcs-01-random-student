<?php

class Speeches
{
    /**
     * @var int
     */
    private $speechesID;
    /**
     * @var int
     */
    private $studentID;
    /**
     * @var string
     */
    private $date;

    /**
     * @return int
     */
    public function getSpeechesID()
    {
        return $this->speechesID;
    }

    /**
     * @param int $speechesID
     */
    public function setSpeechesID($speechesID)
    {
        $this->speechesID = $speechesID;
        return $this;
    }

    /**
     * @return int
     */
    public function getStudentID()
    {
        return $this->studentID;
    }

    /**
     * @param int $studentID
     */
    public function setStudentID($studentID)
    {
        $this->studentID = $studentID;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public static function getAll(): array
    {
        $pdo   = MyDB::getPDOInstance();
        $query = $pdo->query('SELECT * FROM speeches ORDER BY date DESC');
        return $query->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function countSpeechesStudentID($id)
    {
        $pdo   = MyDB::getPDOInstance();
        $query = $pdo->query('SELECT COUNT(speechesID) FROM speeches WHERE studentID =' . $id);
        return $query->fetchColumn();
    }
    public static function maxCount()
    {
        $pdo   = MyDB::getPDOInstance();
        $query = $pdo->query('SELECT count(*) as nb FROM speeches GROUP BY studentID ORDER BY nb DESC');
        return $query->fetchColumn();
    }

    public function createInDB()
    {
        $pdo  = MyDB::getPDOInstance();
        $exec = $pdo->exec('INSERT INTO speeches (studentID,date) VALUES (' . $pdo->quote($this->studentID) . ',' . $pdo->quote($this->date) . ')');
        if (!!$exec) {
            $this->studentID = $pdo->lastInsertId();
        }
        return !!$exec;
    }

}