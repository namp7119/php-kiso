<?php

class Student {
    private $name;
    private $studentId;

    public function __construct($name , $studentId) {
        $this->name = $name;
        $this->studentId = $studentId;
    }

    public function getName() {return $this->name;}
    public function getStudentId() {return $this->studentId;}
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

    public function getName() {return $this->name;}
    public function getStudents() {return $this->students;}    
}

class Grade {
    private $student;
    private $course;
    private $grade;

    public function __construct(Student $student, Course $course, $grade) {
    $this->student = $student;
    $this->course = $course;
    $this->grade = $grade;
    }

    public function getGrade() {
        return [
            'student' => $this->student->getName(),
            'course' => $this->course->getName(),
            'grade'=> $this-> grade,
        ];
    }
}

$student = new Student("浅沼", "123");
$course =new Course("英語");

$course->addStudent ($student);

$grade = new Grade($student, $course, "4");

$result = $grade->getGrade();
echo "成績照会" . PHP_EOL;
echo "学生名: " . $result['student'] . PHP_EOL;
echo "科目名: " . $result['course'] . PHP_EOL;
echo "評価 : " . $result['grade'] . PHP_EOL;