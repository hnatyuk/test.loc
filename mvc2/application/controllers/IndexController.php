<?php
/**
 * Project: mvc.com
 * Author: Ilia Ovchinnikov
 * Date: 24-Sep-14
 * Time: 20:20
 */

require LIB_PATH . '/View.php';
require APPLICATION_PATH . '/models/StudentModel.php';

class IndexController {
    public function indexAction() {
        $view = new View('index');
        $view->data->var = "Test!";
        $view->render();
    }

    public function studentsAction() {
        $illia = new StudentModel(1);   // Gets student with id=1 and fills an object
        echo '<pre>';
        echo "-------------------------------\n";
        echo "Name: " . $illia->getName() . "\n";
        echo "Surname: " . $illia->getSname() . "\n";
        echo "Course: " . $illia->getCourse() . "\n";
        echo "Group:" . $illia->getGroup() . "\n";
        echo "-------------------------------\n";
        echo '</pre>';

        $newStudent = new StudentModel();
        $newStudent->setName("Papa");
        $newStudent->setSname("Roach");
        $newStudent->setGroup("IN-21");
        $newStudent->setCourse(3);
        $newStudent->save(); // Should be in the DB now

        $all = $illia->getAll(); // getting all students
        echo '<pre>';
        echo "All students: \n";
        foreach ($all as $studentModel) {
            echo "Name: " . $studentModel->getName() . "\n";
            echo "Surname: " . $studentModel->getSname() . "\n";
            echo "Course: " . $studentModel->getCourse() . "\n";
            echo "Group:" . $studentModel->getGroup() . "\n";
            echo "\n";
        }
        echo '</pre>';
    }
}