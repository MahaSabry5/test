<?php
require 'dbConnect.php';
?>
<!--<h1 class="text-4xl mb-10">View Posts </h1>-->
<h1 class="text-4xl mb-10">View Employees </h1>

    <table border="2">
        <tr>
<!--            <td>ID</td>-->
<!--            <td>Post Author</td>-->
<!--            <td>Email</td>-->
<!--            <td>Title</td>-->
<!--            <td>Content</td>-->
<!--            <td>Created At</td>-->
<!--            <td>MetaData</td>-->
<!--            <td>Comments</td>-->
<!--            <td>Comment Author</td>-->
            <td>Name</td>
            <td>SSN</td>
            <td>Birthdate</td>
            <td>Supervisor</td>
            <td>Department</td>
            <td>Department Manager</td>
            <td>Project</td>
            <td>Hours</td>
        </tr>
        <?php
//        $sql = "SELECT  wp_posts.id,wp_posts.post_author, wp_posts.post_title, wp_posts.post_content, wp_posts.post_date , wp_postmeta.meta_key, wp_users.user_nicename,wp_users.user_email,wp_comments.comment_post_ID,wp_comments.comment_author,wp_comments.comment_content
//FROM wp_posts LEFT OUTER JOIN wp_postmeta
//ON wp_posts.ID = wp_postmeta.post_id
//LEFT OUTER JOIN  wp_users
//ON wp_posts.post_author = wp_users.ID
//LEFT OUTER JOIN wp_comments
//ON wp_posts.ID = wp_comments.comment_post_ID
//";
        //without any views
//        $sql = "SELECT  CONCAT(e.fname ,' ', e.lname) as name , e.ssn , e.bdate ,super.fname as supervisor, d.dname , d.mgrssn, mgr.fname as dep_manage,works_on.pno,project.pname,works_on.hours
//FROM employee as e
//LEFT OUTER JOIN department as d ON e.dno = d.dnumber
//LEFT OUTER JOIN works_on ON works_on.essn = e.ssn
//LEFT  JOIN employee as super ON e.superssn = super.ssn
//INNER JOIN project ON works_on.pno = project.pnumber
//INNER JOIN employee as mgr
//on d.mgrssn = mgr.ssn";
        //with work_hours view
//        $sql="SELECT  work_hours.name, work_hours.ssn , e.bdate ,super.fname as supervisor, d.dname , d.mgrssn, mgr.fname as dep_manage , work_hours.pname,work_hours.hours
//FROM employee as e
//INNER JOIN work_hours ON work_hours.ssn=e.ssn
//LEFT OUTER JOIN department as d ON e.dno = d.dnumber
//LEFT  JOIN employee as super ON e.superssn = super.ssn
//INNER JOIN employee as mgr ON d.mgrssn = mgr.ssn";
        //with work_hours + department_mangers views
        $view1="CREATE VIEW IF NOT EXISTS work_hours
            AS
            SELECT employee.ssn,CONCAT(employee.fname ,' ', employee.lname) as name , project.pname,works_on.hours
            FROM employee,project,works_on
            WHERE works_on.essn=employee.ssn AND works_on.pno = project.pnumber";
        $conn->query($view1);

        $view2="CREATE VIEW IF NOT EXISTS department_mangers
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
        $sql="SELECT * From employees_Data";
        $records = $conn->query($sql);

        while($row = $records->fetch_assoc()) {  ?>
        <tr>
<!--            <td>--><?php //echo $row['id']; ?><!--</td>-->
<!--            <td>--><?php //echo $row['user_nicename']; ?><!--</td>-->
<!--            <td>--><?php //echo $row['user_email']; ?><!--</td>-->
<!--            <td>--><?php //echo $row['post_title']; ?><!--</td>-->
<!--            <td>--><?php //echo $row['post_content']; ?><!--</td>-->
<!--            <td>--><?php //echo $row['post_date']; ?><!--</td>-->
<!--            <td>--><?php //echo $row['meta_key']; ?><!--</td>-->
<!--            <td>--><?php //echo $row['comment_content']; ?><!--</td>-->
<!--            <td>--><?php //echo $row['comment_author']; ?><!--</td>-->
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['ssn']; ?></td>
            <td><?php echo $row['bdate']; ?></td>
            <td><?php echo $row['supervisor']; ?></td>
            <td><?php echo $row['dname']; ?></td>
            <td><?php echo $row['dep_manage']; ?> </td>
            <td><?php echo $row['pname']; ?></td>
            <td><?php echo $row['hours']; ?></td>


        </tr>
        <?php }?>
    </table>

