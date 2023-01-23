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
<?php // display all of my bookmarks


if (
    !empty($_POST["user_name"]) and
    $_POST["display_my_bookmarks"] == "activate" and
    ($_POST["order_by"] == "alphanumeric" or $_POST["order_by"] == "cronologic")
) {
    $user_name = htmlspecialchars(
        trim(addslashes($_POST["user_name"])),
        ENT_QUOTES
    );
    $order_by = htmlspecialchars(
        trim(addslashes($_POST["order_by"])),
        ENT_QUOTES
    );
    $sql_order_by = "";
    if ($order_by == "alphanumeric") {
        $sql_order_by = "ORDER by bookmark_headline ASC";
    }
    if ($order_by == "cronologic") {
        $sql_order_by = "ORDER by entry_time DESC";
    }
    $specificUserForDataRetrieve = $user_name;
    include "inc_conn.php";
    $sql = "SELECT *  FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' $sql_order_by";
    if ($result = $conn->query($sql)) {
        $rowcount = mysqli_num_rows($result);
        if ($rowcount >= 1) {
            $currentRow = 0;
            $currentCategory = "bookmarks";
            $currentCategory_headline = "Bookmarks";
            $headline_style = "background-color:rgb(92,120,174);";
            while ($row = $result->fetch_assoc()) {
                if ($currentRow == 0) {
                    echo "
                        <div class='categoryContainer'>
                        <div id='categoryContainer_headline_$currentCategory' class='categoryContainer_headline' style='$headline_style'>
                            <div class='categoryContainer_headline_left'>$currentCategory_headline</div>
                            <div class='categoryContainer_headline_right'><div class='arrowDownIconUser' style='font-size: 24px;' 
                            onclick=\"openCloseWindow('categoryContainer_bookmarks_$currentCategory','plusMinusCategoryContainer_$currentCategory');\"> 
                            </div></div>
                        </div>
                        <div id='categoryContainer_bookmarks_$currentCategory' class='categoryContainer_bookmarks'>
                        ";
                }
                $id = $row["id"];
                $headline = $row["bookmark_headline"];
                $url = $row["bookmark_url"];
                $alt = $row["bookmark_notes"];
                if ($alt == "no info") {
                    $alt = "";
                }
                echo "
                                <div id='categoryContainer_bookmarks_bookmark_$currentRow' class='categoryContainer_bookmarks_bookmark' style='margin-bottom:20px;'>
                                    <i style='margin-left:12px;margin-right:30px;cursor:pointer;' class='fa fa-xmark' title='remove' onclick='deleteBookmarkbyId($id,\"$headline\")'></i>
                                    <i style='margin-left:12px;margin-right:30px;cursor:pointer;' class='fa fa-user-pen' title='edit' onclick='updateBookmarkbyId($id);'></i>
                                    <div class='url_icon'><img src='https://www.google.com/s2/favicons?domain_url=$url'></img></div>
                                    <div class='url_description'> <a class='bookmarks_a' target='_blank' href='$url' title='$alt'>$headline</a></div>
                                </div>
                    ";
                $currentRow++;
            }
            echo "
                    </div>
                </div>
                ";
        }
    }
} // delete bookmark by id
if (
    !empty($_POST["user_name"]) and
    $_POST["user_name"] != "visitor" and
    !empty($_POST["idForDelete"]) and
    is_numeric($_POST["idForDelete"])
) {
    $user_name = htmlspecialchars(
        trim(addslashes($_POST["user_name"])),
        ENT_QUOTES
    );
    $idForDelete = htmlspecialchars(
        trim(addslashes($_POST["idForDelete"])),
        ENT_QUOTES
    );
    include "inc_conn.php";
    $sql = "DELETE FROM bookmark_main_table WHERE id=$idForDelete";
    if ($result = $conn->query($sql)) {
        $sql = str_replace("'", "#", $sql);
        $sql_insert_to_logs = "INSERT INTO bookmark_logs (id, time_stamp, user_name, task) VALUES (NULL, now(), '$user_name', '$sql')";
        $conn->query($sql_insert_to_logs);
    }
}
 ?>
