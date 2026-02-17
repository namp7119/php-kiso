<?php

class Student {
    private $name;
    private $studentId;

    public function __construct($name , $studentId) {
        $this->name = $name;
        $this->studentId = $studentId;
    }

    public function getName() {
        return $this->name;
    }
}

class Course {
    private $name;
    private $students = [];

    public function __construct($name) {
        $this->name =$name;
    }

    public function addStudent(Student $student) {
        $this->students[] = $student;
    }

    public function getStudents() {
        $names = [];
        foreach ($this->students as $student) {
            $names[] = $student->getName();
        }
        return "コース名: {$this->name} | 生徒: " . implode(", ", $names);
    }    
}

class Grade {
    private $student;
    private $course;
    private $grade;

    public function __construct($student, $course, $grade) {
    $this->student = $student;
    $this->course = $course;
    $this->grade = $grade;
    }

    public function getGrade() {
        return "生徒: {$this->student->getName()} | 成績: {$this->grade}";
    }
}

$student = new Student("浅沼", "123");
$course =new Course("英語");

$course->addStudent ($student);

$grade = new Grade($student, $course, "4");

echo $course->getStudents() . "\n";
echo $grade->getGrade() . "\n";