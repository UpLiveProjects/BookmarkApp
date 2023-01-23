<?php
session_start();
if (empty($_SESSION["user_name"]) || empty($_SESSION["level"])) {
    exit();
}
?>
<?php header("Content-type: text/html; charset=UTF-8"); ?>
<?php if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://tihnun.net/bookmark/v2/index.php");
    exit();
} ?>
<?php
if (
    !empty($_POST["user_name"]) and
    !empty($_POST["bookmark_headline"]) and
    !empty($_POST["bookmark_url"])
) {
    $user_name = htmlspecialchars(
        trim(addslashes($_POST["user_name"])),
        ENT_QUOTES
    );
    $tab = htmlspecialchars(trim(addslashes($_POST["tab"])), ENT_QUOTES);
    $tab = strtolower($tab);
    $tab = ucwords($tab);
    $tab = str_replace(" ", "_", $tab);
    $category = htmlspecialchars(
        trim(addslashes($_POST["category"])),
        ENT_QUOTES
    );
    $category = strtolower($category);
    $category = str_replace(" ", "_", $category);
    $bookmark_headline = htmlspecialchars(
        trim(addslashes($_POST["bookmark_headline"])),
        ENT_QUOTES
    );
    $bookmark_url = htmlspecialchars(
        trim(addslashes($_POST["bookmark_url"])),
        ENT_QUOTES
    );
    $bookmark_meta = htmlspecialchars(
        trim(addslashes($_POST["bookmark_meta"])),
        ENT_QUOTES
    );
    $bookmark_notes = htmlspecialchars(
        trim(addslashes($_POST["bookmark_notes"])),
        ENT_QUOTES
    );
    include "inc_conn.php";
    $sql = "
    INSERT INTO bookmark_main_table (id, user_name, entry_time, tab, category, category_display, category_style, bookmark_headline, bookmark_url, bookmark_meta, bookmark_notes) VALUES 
    (NULL, '$user_name', now() , '$tab', '$category','on','background-color:rgb(92,120,174);', '$bookmark_headline', '$bookmark_url', '$bookmark_meta', '$bookmark_notes');
    ";
    if ($result = $conn->query($sql)) {
        echo "Uploaded Successfully";
        $sql = str_replace("'", "#", $sql);
        $sql_insert_to_logs = "INSERT INTO bookmark_logs (id, time_stamp, user_name, task) VALUES (NULL, now(), '$user_name', '$sql')";
        $conn->query($sql_insert_to_logs);
    }
} //update bookmark
if (
    !empty($_POST["update_user_name"]) and
    !empty($_POST["update_bookmark_headline"]) and
    !empty($_POST["update_bookmark_url"]) and
    !empty($_POST["idForUpdate"]) and
    is_numeric($_POST["idForUpdate"])
) {
    $id = htmlspecialchars(trim(addslashes($_POST["idForUpdate"])), ENT_QUOTES);
    $user_name = htmlspecialchars(
        trim(addslashes($_POST["update_user_name"])),
        ENT_QUOTES
    );
    $tab = htmlspecialchars(trim(addslashes($_POST["update_tab"])), ENT_QUOTES);
    $tab = strtolower($tab);
    $tab = ucwords($tab);
    $tab = str_replace(" ", "_", $tab);
    $category = htmlspecialchars(
        trim(addslashes($_POST["update_category"])),
        ENT_QUOTES
    );
    $category = strtolower($category);
    $category = str_replace(" ", "_", $category);
    $bookmark_headline = htmlspecialchars(
        trim(addslashes($_POST["update_bookmark_headline"])),
        ENT_QUOTES
    );
    $bookmark_url = htmlspecialchars(
        trim(addslashes($_POST["update_bookmark_url"])),
        ENT_QUOTES
    );
    $bookmark_meta = htmlspecialchars(
        trim(addslashes($_POST["update_bookmark_meta"])),
        ENT_QUOTES
    );
    $bookmark_notes = htmlspecialchars(
        trim(addslashes($_POST["update_bookmark_notes"])),
        ENT_QUOTES
    );
    include "inc_conn.php";
    $sql = "
    UPDATE bookmark_main_table SET user_name='$user_name',
                                   tab='$tab',
                                   category='$category',
                                   bookmark_headline='$bookmark_headline',
                                   bookmark_url='$bookmark_url',
                                   bookmark_meta='$bookmark_meta',
                                   bookmark_notes='$bookmark_notes'
                                   where id='$id'
    ";
    if ($result = $conn->query($sql)) {
        echo "Uploaded Successfully";
        $sql = str_replace("'", "#", $sql);
        $sql_insert_to_logs = "INSERT INTO bookmark_logs (id, time_stamp, user_name, task) VALUES (NULL, now(), '$user_name', '$sql')";
        $conn->query($sql_insert_to_logs);
    }
}
 ?>
