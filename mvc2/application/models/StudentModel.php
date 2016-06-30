<?php
/**
 * Project: mvc.com
 * Author: Ilia Ovchinnikov
 * Date: 24-Sep-14
 * Time: 20:51
 */

require LIB_PATH . '/Model.php';

class StudentModel extends Model {
    private $id = null;
    private $name = null;
    private $sname = null;
    private $course = null;
    private $group = null;

    function __construct($id = null) {
        parent::__construct();
        if ($id) {
            $id = (int)$id;
            $student = $this->db->query("SELECT * FROM students WHERE id=" . $id)
                                ->fetch();
            if (count($student) == 0)
                throw new Exception("No student with id = " . $id);

            $this->setId($student['id']);
            $this->setName($student['name']);
            $this->setSname($student['sname']);
            $this->setCourse($student['course']);
            $this->setGroup($student['group']);
        }
    }

    public function getCourse() {
        return $this->course;
    }

    public function setCourse($course) {
        if (empty($course))
            throw new InvalidArgumentException('Param $course should be not empty!');
        $this->course = $course;
    }

    public function getGroup() {
        return $this->group;
    }

    public function setGroup($group) {
        if (empty($group))
            throw new InvalidArgumentException('Param $group should be not empty!');
        $this->group = $group;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        if (empty($id))
            throw new InvalidArgumentException('Param $id should be not empty!');
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        if (empty($name))
            throw new InvalidArgumentException('Param $name should be not empty!');
        $this->name = $name;
    }

    public function getSname() {
        return $this->sname;
    }

    public function setSname($sname) {
        if (empty($sname))
            throw new InvalidArgumentException('Param $sname should be not empty!');
        $this->sname = $sname;
    }

    public function getAll() {
        $query = $this->db->query('SELECT * FROM students')->fetchAll();
        $result = array();

        foreach ($query as $row) {
            $m = new StudentModel();
            $m->setName($row['name']);
            $m->setId($row['id']);
            $m->setSname($row['sname']);
            $m->setCourse($row['course']);
            $m->setGroup($row['group']);
            $result[] = $m;
        }
        return $result;
    }

    public function save() {
        if ($this->getName() == null || $this->getSname() == null || $this->getGroup() == null || $this->getCourse() == null)
            throw new Exception("Student model is not formed correctly!");

        if ($this->getId()) {
            $query = $this->db->prepare("UPDATE students SET name=:_name, sname=:_sname, course=:_course, `group`=:_group WHERE id=:_id;");
            $query->bindParam(':_name', $this->getName());
            $query->bindParam(':_sname', $this->getSname());
            $query->bindParam(':_course', $this->getCourse());
            $query->bindParam(':_group', $this->getGroup());
            $query->bindParam(':_id', $this->getId());
            $query->execute();
        } else {
            $query = $this->db->prepare("INSERT INTO students (name, sname, course, `group`) VALUES (:_name, :_sname, :_course, :_group)");
            $query->bindParam(':_name', $this->getName());
            $query->bindParam(':_sname', $this->getSname());
            $query->bindParam(':_course', $this->getCourse());
            $query->bindParam(':_group', $this->getGroup());
            $query->execute();
        }

        return !!$query;
    }
} 