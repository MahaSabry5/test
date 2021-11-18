<?php
//require 'dbConnect.php';
include 'createViews.php';
?>
<h1 class="text-4xl mb-10">View Employees </h1>

    <table border="2">
        <tr>
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
        $sql="SELECT * From employees_Data";
        $records = $conn->query($sql);
        while($row = $records->fetch_assoc()) {  ?>
        <tr>
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

