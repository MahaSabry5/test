<?php
require 'dbConnect.php';
?>
<h1 class="text-4xl mb-10">View Posts </h1>
    <table border="2">
        <tr>
            <td>ID</td>
            <td>Post Author</td>
            <td>Email</td>
            <td>Title</td>
            <td>Content</td>
            <td>Created At</td>
            <td>MetaData</td>
            <td>Comments</td>
            <td>Comment Author</td>

            <!--            <td>Content</td>-->
        </tr>
        <?php
        $sql = "SELECT  wp_posts.id,wp_posts.post_author, wp_posts.post_title, wp_posts.post_content, wp_posts.post_date , wp_postmeta.meta_key, wp_users.user_nicename,wp_users.user_email,wp_comments.comment_post_ID,wp_comments.comment_author,wp_comments.comment_content
FROM wp_posts LEFT OUTER JOIN wp_postmeta  
ON wp_posts.ID = wp_postmeta.post_id
LEFT OUTER JOIN  wp_users
ON wp_posts.post_author = wp_users.ID
LEFT OUTER JOIN wp_comments
ON wp_posts.ID = wp_comments.comment_post_ID
";
        $records = $conn->query($sql);

        while($row = $records->fetch_assoc()) {  ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_nicename']; ?></td>
            <td><?php echo $row['user_email']; ?></td>
            <td><?php echo $row['post_title']; ?></td>
            <td><?php echo $row['post_content']; ?></td>
            <td><?php echo $row['post_date']; ?></td>
            <td><?php echo $row['meta_key']; ?></td>
            <td><?php echo $row['comment_content']; ?></td>
            <td><?php echo $row['comment_author']; ?></td>


        </tr>
        <?php }?>
    </table>

