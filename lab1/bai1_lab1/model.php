<?php
    //hàm lấy toàn bộ khoá học
    function get_courses() {
        include "data.php";
        return $course;
    }

    //hàm tìm kiếm khoá học theo học kì
    function find_by_semester($semester){
        include "data.php";
        return array_key_exists($semester, $course) ? $course[$semester] : "Invalid course";
    }
?>