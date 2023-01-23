<?php
if (
    !empty($_POST["user_name"]) and
    !empty($_POST["category"]) and
    !empty($_POST["color_property"])
) {
    $user_name = htmlspecialchars(
        trim(addslashes($_POST["user_name"])),
        ENT_QUOTES
    );
    $category = htmlspecialchars(
        trim(addslashes($_POST["category"])),
        ENT_QUOTES
    );
    $color_property = htmlspecialchars(
        trim(addslashes($_POST["color_property"])),
        ENT_QUOTES
    );
    include "inc_conn.php";
    $sql = "UPDATE bookmark_main_table SET category_style='$color_property' where user_name='$user_name' and category='$category'";
    if ($result = $conn->query($sql)) {
        $sql = str_replace("'", "#", $sql);
        $sql_insert_to_logs = "INSERT INTO bookmark_logs (id, time_stamp, user_name, task) VALUES (NULL, now(), '$user_name', '$sql')";
        $conn->query($sql_insert_to_logs);
    }
}
?>
