<?php
session_start();
if (empty($_SESSION["user_name"]) || empty($_SESSION["level"])) {
    exit();
}
?>
<?php header("Content-type: text/html; charset=UTF-8"); ?>
<?php
if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://tihnun.net/bookmark/v2/index.php");
    exit();
}
if (empty($_GET["idForUpdate"]) or !is_numeric($_GET["idForUpdate"])) {
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookmark From Outer Space . . .</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style/update_bookmark_style.css">
    <style></style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<?php function returnInfoForIdAndColumnName($infoId, $infoColumnName)
{
    include "inc_conn.php";
    $sql = "Select $infoColumnName from bookmark_main_table where id=$infoId";
    $returnValue = "";
    if ($result = $conn->query($sql)) {
        $rowcount = mysqli_num_rows($result);
        if ($rowcount == 1) {
            $row = $result->fetch_assoc();
            $returnValue = $row[$infoColumnName];
        }
        return $returnValue;
    } else {
        return "error";
    }
} ?>
<div id='lower_part'> 
<div id='lower_part_user_update_bookmark'>
            <div id='lower_part_user_inner_update_bookmark' class='lower_part_window' style="">
                <div id='lower_part_user_inner_form_update_bookmark'>
                    <input list="list_of_tabs" id="lower_part_user_update_bookmark_tab" placeholder='Select Tab'
                     class='inputText' style='margin-bottom:20px;' value='<?php
                     $id = $_GET["idForUpdate"];
                     echo returnInfoForIdAndColumnName($id, "tab");
                     ?>'/>
                    <datalist id="list_of_tabs">
                        <option value="Main">
                        <?php
                        include "inc_conn.php";
                        $user_name = $_SESSION["user_name"];
                        $sql =
                            "SELECT DISTINCT tab FROM bookmark_main_table WHERE tab<>'Main' and tab<>'' ";
                        if ($result = $conn->query($sql)) {
                            $rowcount = mysqli_num_rows($result);
                            if ($rowcount >= 1) {
                                while ($row = $result->fetch_assoc()) {
                                    $tab = $row["tab"];
                                    echo "<option value='$tab'>";
                                }
                            }
                        }
                        ?>
                    </datalist>
                    <input list="list_of_Categories" id="lower_part_user_update_bookmark_category" placeholder='Select Category' value='<?php
                    $id = $_GET["idForUpdate"];
                    echo returnInfoForIdAndColumnName($id, "category");
                    ?>' 
                     class='inputText' style='margin-bottom:20px;' />
                    <datalist id="list_of_Categories">
                        <option value="main">
                        <?php
                        include "inc_conn.php";
                        $user_name = $_SESSION["user_name"];
                        $sql =
                            "SELECT DISTINCT category FROM bookmark_main_table WHERE category<>'main' and category<>'' ";
                        if ($result = $conn->query($sql)) {
                            $rowcount = mysqli_num_rows($result);
                            if ($rowcount >= 1) {
                                while ($row = $result->fetch_assoc()) {
                                    $category = $row["category"];
                                    echo "<option value='$category'>";
                                }
                            }
                        }
                        ?>
                    </datalist>
                    <input type='text' id='lower_part_user_update_bookmark_bookmark_headline' value='<?php
                    $id = $_GET["idForUpdate"];
                    echo returnInfoForIdAndColumnName($id, "bookmark_headline");
                    ?>' 
                    placeholder='Bookmark Headline' class='inputText' style='margin-bottom:20px;'/>
                    <input type='text' id='lower_part_user_update_bookmark_bookmark_url' value='<?php
                    $id = $_GET["idForUpdate"];
                    echo returnInfoForIdAndColumnName($id, "bookmark_url");
                    ?>' 
                     placeholder='Bookmark URL' class='inputText' style='margin-bottom:20px;'/>
                    <input type='text' id='lower_part_user_update_bookmark_bookmark_meta'  value='<?php
                    $id = $_GET["idForUpdate"];
                    echo returnInfoForIdAndColumnName($id, "bookmark_meta");
                    ?>' 
                     placeholder='Bookmark Meta' class='inputText' style='margin-bottom:20px;'/>
                    <input type='text' id='lower_part_user_update_bookmark_bookmark_notes'  value='<?php
                    $id = $_GET["idForUpdate"];
                    echo returnInfoForIdAndColumnName($id, "bookmark_notes");
                    ?>' 
                    placeholder='Bookmark Notes' class='inputText' style='margin-bottom:20px;'/>
                    <div class='btn' id='lower_part_user_loginBtn_update_bookmark' onclick='update_bookmark()'>Update <i style='margin-left:12px;margin-right:30px;' class="fa fa-cloud-arrow-up"></i> </div>
                    <div class='btn' id='lower_part_user_closeBtn_update_bookmark' onclick='window.close();'>Close 
                    <i style='margin-left:12px;margin-right:30px;' class="fa fa-rectangle-xmark"></i> </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
            function update_bookmark(){
                document.getElementById('lower_part_user_loginBtn_update_bookmark').
                innerHTML="Update <i style='margin-left:12px;margin-right:30px;' class='fa fa-cloud-arrow-up'></i> ";
                                var idForUpdate=<?php echo $_GET[
                                    "idForUpdate"
                                ]; ?>;
                                var user_name='<?php echo $_SESSION[
                                    "user_name"
                                ]; ?>';
                                var tab=document.getElementById('lower_part_user_update_bookmark_tab').value;
                                var category=document.getElementById('lower_part_user_update_bookmark_category').value;
                                var bookmark_headline=document.getElementById('lower_part_user_update_bookmark_bookmark_headline').value;
                                var bookmark_url=document.getElementById('lower_part_user_update_bookmark_bookmark_url').value;
                                var bookmark_meta=document.getElementById('lower_part_user_update_bookmark_bookmark_meta').value;
                                var bookmark_notes=document.getElementById('lower_part_user_update_bookmark_bookmark_notes').value;
                                if(tab==''){tab='Main';}
                                if(category==''){category='personal';}
                                if(bookmark_headline=='' || bookmark_url==''){
                                    document.getElementById('lower_part_user_loginBtn_update_bookmark').
                                     innerHTML="Update <i style='margin-left:12px;margin-right:30px;color:tomato;' class='fa fa-cloud-arrow-up'></i> Headline and URL Required ";
                                     document.getElementById("lower_part_user_loginBtn_update_bookmark").style.cssText+='color:	tomato;';
                                }
                                if(bookmark_meta==''){bookmark_meta='no info';}
                                if(bookmark_notes==''){bookmark_notes='no info';}
                if(bookmark_headline!='' && bookmark_url!=''){
                var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open("POST","https://tihnun.net/bookmark/v2/insert_data.php",true);
                    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlHttp.onreadystatechange = function() {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            document.getElementById("lower_part_user_loginBtn_update_bookmark")
                            .innerHTML="Update <i style='margin-left:12px;margin-right:30px;color:	RGB(25, 135, 84);' class='fa fa-cloud-arrow-up'></i>"+xmlHttp.responseText;
                            document.getElementById("lower_part_user_loginBtn_update_bookmark").style.cssText+='color:	RGB(25, 135, 84);';
                        }
                    }
                                xmlHttp.send(
                                "&idForUpdate="+idForUpdate+
                                "&update_user_name="+user_name+
                                "&update_tab="+tab+
                                "&update_category="+category+
                                "&update_bookmark_headline="+bookmark_headline+
                                "&update_bookmark_url="+bookmark_url+
                                "&update_bookmark_meta="+bookmark_meta+
                                "&update_bookmark_notes="+bookmark_notes
                                );
                }
        }

</script>
</html>