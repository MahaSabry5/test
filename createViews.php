<?php
require 'dbConnect.php';

$view1 = "CREATE VIEW IF NOT EXISTS work_hours
            AS
            SELECT employee.ssn,CONCAT(employee.fname ,' ', employee.lname) as name , project.pname,works_on.hours
            FROM employee,project,works_on
            WHERE works_on.essn=employee.ssn AND works_on.pno = project.pnumber";
$conn->query($view1);

$view2 = "CREATE VIEW IF NOT EXISTS department_mangers
            AS
            SELECT department.dname,department.dnumber,department.mgrssn,employee.fname
            FROM employee,department
            WHERE department.mgrssn=employee.ssn";
$conn->query($view2);

$view3 = "CREATE VIEW IF NOT EXISTS employees_Data
            AS 
            SELECT  work_hours.name, work_hours.ssn , e.bdate ,super.fname as supervisor, department_mangers.dname ,  department_mangers.fname as dep_manage , work_hours.pname,work_hours.hours
            FROM employee as e
            INNER JOIN work_hours
            ON work_hours.ssn=e.ssn
            LEFT JOIN department_mangers
            ON e.dno = department_mangers.dnumber
            LEFT JOIN employee as super ON e.superssn = super.ssn";
$conn->query($view3);


