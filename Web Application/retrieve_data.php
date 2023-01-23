<?php
session_start();
if (!empty($_POST["user_name"]) and !empty($_POST["password"])) {
    include "inc_conn.php";
    $user_name = htmlspecialchars(
        trim(addslashes($_POST["user_name"])),
        ENT_QUOTES
    );
    $password = htmlspecialchars(
        trim(addslashes($_POST["password"])),
        ENT_QUOTES
    );
    $sql = "SELECT * FROM bookmark_users WHERE user_name='$user_name' and password='$password'";
    if ($result = $conn->query($sql)) {
        $rowcount = mysqli_num_rows($result);
        if ($rowcount == 1) {
            $row = $result->fetch_assoc();
            $level = $row["level"];
            $_SESSION["user_name"] = $user_name;
            $_SESSION["level"] = $level;
            echo "Logged in successfully";
        }
        if ($rowcount == 0) {
            echo "Wrong username or password";
        }
    }
}

// display main screen or display partial category search
if (
    !empty($_POST["user_name"]) and
    !empty($_POST["tab"]) and
    !empty($_POST["partial_search"]) and
    ($_POST["partial_search"] == "yes" or $_POST["partial_search"] == "no")
) {
    $user_name = htmlspecialchars(
        trim(addslashes($_POST["user_name"])),
        ENT_QUOTES
    );
    $tab = htmlspecialchars(trim(addslashes($_POST["tab"])), ENT_QUOTES);
    $partial_search = htmlspecialchars(
        trim(addslashes($_POST["partial_search"])),
        ENT_QUOTES
    );
    $specificUserForDataRetrieve = $user_name;
    include "inc_conn.php";
    if ($partial_search == "no") {
        if ($tab == "display_all" or $tab == "Main") {
            $sql = "SELECT distinct category FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' ORDER by id ASC";
        }
        if ($tab != "display_all" and $tab != "Main") {
            $sql = "SELECT distinct category FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' and tab='$tab' ORDER by id ASC";
        }
    }
    if ($partial_search == "yes") {
        $sql = "SELECT distinct category FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' and category like '%$tab%' ORDER by id ASC";
    }
    if ($result = $conn->query($sql)) {
        $rowcount = mysqli_num_rows($result);
        if ($rowcount >= 1) {
            while ($row = $result->fetch_assoc()) {
                $currentCategory = $row["category"];
                $currentCategory_headline = ucwords(
                    str_replace("_", " ", $currentCategory)
                );
                $sql_inner = "SELECT * FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' and category='$currentCategory' ORDER by id ASC";
                if ($result_inner = $conn->query($sql_inner)) {
                    $rowcount_inner = mysqli_num_rows($result_inner);
                    if ($rowcount_inner >= 1) {
                        // inner loop - start
                        $currentRow = 0;
                        while ($row_inner = $result_inner->fetch_assoc()) {
                            $headline_style = $row_inner["category_style"];
                            if ($currentRow == 0) {
                                echo "
                            <div class='categoryContainer'>
                            <div id='categoryContainer_headline_$currentCategory' class='categoryContainer_headline' style='$headline_style'>
                                <div class='categoryContainer_headline_left'>$currentCategory_headline</div>
                                <div class='categoryContainer_headline_right'><div class='arrowDownIconUser' style='font-size: 24px;' 
                                onclick=\"openCloseWindow('categoryContainer_bookmarks_$currentCategory','plusMinusCategoryContainer_$currentCategory');\"> 
                                </i><i id='plusMinusCategoryContainer_$currentCategory' class='fa fa-minus'></i> </div></div>
                            </div>
                            <div id='categoryContainer_bookmarks_$currentCategory' class='categoryContainer_bookmarks'>
                            ";
                            }
                            $headline = $row_inner["bookmark_headline"];
                            $url = $row_inner["bookmark_url"];
                            $alt = $row_inner["bookmark_notes"];
                            if ($alt == "no info") {
                                $alt = "";
                            }
                            echo "
                                    <div class='categoryContainer_bookmarks_bookmark'><div class='url_icon'><img src='https://www.google.com/s2/favicons?domain_url=$url'></img>
                                     </div><div class='url_description'> <a class='bookmarks_a'  target='_blank' href='$url' title='$alt'>$headline</a> </div></div>
                        ";
                            $currentRow++;
                        }
                        echo "
                        </div>
                    </div>
                    ";
                    }
                }
                // inner loop - end
            }
        }
    }
}

// search for bookmarks by partial search
if (!empty($_POST["user_name"]) and !empty($_POST["bookmark"])) {
    $user_name = htmlspecialchars(
        trim(addslashes($_POST["user_name"])),
        ENT_QUOTES
    );
    $bookmark = htmlspecialchars(
        trim(addslashes($_POST["bookmark"])),
        ENT_QUOTES
    );
    $specificUserForDataRetrieve = $user_name;
    include "inc_conn.php";
    $sql_inner = "SELECT * FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' and bookmark_headline like '%$bookmark%' ORDER by id ASC";
    if ($result_inner = $conn->query($sql_inner)) {
        $rowcount_inner = mysqli_num_rows($result_inner);
        if ($rowcount_inner >= 1) {
            // inner loop - start
            $currentRow = 0;
            $currentCategory = "results";
            $currentCategory_headline = "Results";
            while ($row_inner = $result_inner->fetch_assoc()) {
                if ($currentRow == 0) {
                    echo "
                <div class='categoryContainer'>
                <div class='categoryContainer_headline'>
                    <div class='categoryContainer_headline_left'>$currentCategory_headline</div>
                    <div class='categoryContainer_headline_right'><div class='arrowDownIconUser' style='font-size: 24px;' 
                    onclick=\"openCloseWindow('categoryContainer_bookmarks_$currentCategory','plusMinusCategoryContainer_$currentCategory');\"> 
                    </i><i id='plusMinusCategoryContainer_$currentCategory' class='fa fa-minus'></i> </div></div>
                </div>
                <div id='categoryContainer_bookmarks_$currentCategory' class='categoryContainer_bookmarks'>
                ";
                }
                $headline = $row_inner["bookmark_headline"];
                $url = $row_inner["bookmark_url"];
                $alt = $row_inner["bookmark_notes"];
                echo "
                        <div class='categoryContainer_bookmarks_bookmark'><div class='url_icon'><img src='https://www.google.com/s2/favicons?domain_url=$url'></img>
                         </div><div class='url_description'> <a class='bookmarks_a' target='_blank' href='$url' alt='$alt'>$headline</a> </div></div>
            ";
                $currentRow++;
            }
            echo "
            </div>
        </div>
        ";
        }
    }
}
// display all of my categories
if (
    !empty($_POST["user_name"]) and
    $_POST["display_my_categories"] == "activate"
) {
    $user_name = htmlspecialchars(
        trim(addslashes($_POST["user_name"])),
        ENT_QUOTES
    );
    $specificUserForDataRetrieve = $user_name;
    include "inc_conn.php";
    $sql = "SELECT distinct category FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' ORDER by id ASC";
    // אפשר להוסיף מיון של הקטגרויות כאן
    if ($result = $conn->query($sql)) {
        $rowcount = mysqli_num_rows($result);
        if ($rowcount >= 1) {
            while ($row = $result->fetch_assoc()) {
                $currentCategory = $row["category"];
                $currentCategory_headline = ucwords(
                    str_replace("_", " ", $currentCategory)
                );

                $sql_inner = "SELECT * FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' and category='$currentCategory' ORDER by id ASC";

                if ($result_inner = $conn->query($sql_inner)) {
                    $rowcount_inner = mysqli_num_rows($result_inner);
                    if ($rowcount_inner >= 1) {
                        // inner loop - start
                        $currentRow = 0;
                        while ($row_inner = $result_inner->fetch_assoc()) {
                            $headline_style = $row_inner["category_style"];
                            $currentColor = str_replace(
                                "background-color:",
                                "",
                                $headline_style
                            );
                            $currentColor = str_replace(";", "", $currentColor);
                            if ($currentRow == 0) {
                                echo "
                            <div class='categoryContainer'>
                            <div id='categoryContainer_headline_$currentCategory' class='categoryContainer_headline' style='$headline_style'>
                                <div class='categoryContainer_headline_left'>$currentCategory_headline</div>
                                <div class='categoryContainer_headline_right'><div class='arrowDownIconUser' style='font-size: 24px;' 
                                onclick=\"changeCategoryColor('$user_name','$currentCategory','$currentColor','categoryContainer_headline_$currentCategory');\"> 
                                </i><i id='plusMinusCategoryContainer_$currentCategory' class='fa fa-palette'></i> </div></div>
                            </div>
                            
                            ";
                            }
                            $headline = $row_inner["bookmark_headline"];
                            $url = $row_inner["bookmark_url"];
                            $alt = $row_inner["bookmark_notes"];
                            $currentRow++;
                        }
                        echo "  
                    </div>
                    ";
                    }
                }
                //         inner loop - end
            }
        }
    }
}

?>
