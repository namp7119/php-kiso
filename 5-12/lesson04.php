<?php

class Person {
    protected $name;
    protected $age;

    public function __construct($name , $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }
}

class Teacher extends Person {
    private $subject;

    public function __construct($name, $age, $subject) {
        parent::__construct($name, $age);
        $this->subject =$subject;
    }

    public function getSubject() {
        return $this->subject;
    }   
}

class Student extends Person {
    private $studentId;

    public function __construct($name, $age, $studentId) {
        parent::__construct($name, $age);
        $this->studentId = $studentId;
    }
    
    public function getStudentId() {
        return $this->studentId;
    }
}


$teacher = new Teacher("関根" , 40, "音楽");
$student = new Student("浅沼" ,15, "123");

echo "私の名前は{$teacher->getName()}、{$teacher->getAge()}歳です。" .PHP_EOL;
echo "私の名前は{$student->getName()}、{$student->getAge()}歳です。" .PHP_EOL;

echo " 「私は{$teacher->getName()}です、{$teacher->getSubject()}を教えています」" . PHP_EOL;
echo " 「私は{$student->getName()}です、学生IDは{$student->getStudentId()}です」" . PHP_EOL;