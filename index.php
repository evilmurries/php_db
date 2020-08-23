<?php

require "classes/Database.php";

$database = new Database();

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if($post['submit']) {
    $title = $post['title'];
    $body = $post['body'];

    $database->query('INSERT INTO post (title, body) VALUES (:title, :body)');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->execute();

    if ($database->lastInsertId()) {
        echo '<p>Post Added</p>';
    }
}

$database->query('SELECT * FROM post');
$row = $database->resultSet();

?>
<h1>Add Post</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <label>Post ID</label><br>
    <input type="text" name="id" placeholder="Specify ID" /><br><br>
    <label>Post Title</label><br>
    <input type="text" name="title" placeholder="Add a Title" /><br><br>
    <label>Post Body</label><br>
    <textarea name="body"></textarea><br>
    <input type="submit" name="submit" value="submit" />
</form>


<h1>Posts</h1>
<div>
    <?php foreach($row as $post) : ?>
    <div>
        <h3><?php echo $post['title']; ?></h3>
        <p><?php echo $post['body'];  ?></p>
    </div>
    <?php endforeach; ?>
</div>
