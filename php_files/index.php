<?php
header("Content-type: text/html; charset=UTF-8");
if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://tihnun.net/bookmark/v2/index.php");
    exit();
}
?>
<?php
session_start();
if (empty($_SESSION["user_name"]) || empty($_SESSION["level"])) {
    $_SESSION["user_name"] = "visitor";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookmark From Outer Space . . .</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style/style_main.css?v=1.0">
    <style></style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body onload='changeWelcomeMessage();reloadAndRetrieveData_lowerPannel("display_all","no");jumpTo("lower_part_main");'>
    <div class="divTopLogoAndHeadline">
        <div id="divTopLogoAndHeadline_left">
            <div class="headline" onclick='reloadAndRetrieveData_lowerPannel("display_all","no");jumpTo("lower_part_main");'><i>B</i>ookmark <i>F</i>rom <i>O</i>uter <i>S</i>pace . . .</div>
            <img id="logoImg" src="image_logo.png" onclick='reloadAndRetrieveData_lowerPannel("display_all","no");jumpTo("lower_part_main");'></img>
            <div class="divTopLogoAndHeadline_p" id='welcome_user'><input type='hidden' id='current_user_name' value='visitor'></div>
        </div>
        <div id="divTopLogoAndHeadline_right">
            <div class="divTopLogoAndHeadline_p" onclick='jumpTo("lower_part_main")'>Main</div>
            <div class="divTopLogoAndHeadline_p" onclick='jumpTo("lower_part_my_categories");display_my_categories_function("lower_part_my_categories_inner");'>My Categories</div>
            <div class="divTopLogoAndHeadline_p" onclick='jumpTo("lower_part_my_bookmarks");display_my_bookmarks_function("lower_part_my_bookmarks_inner");'>My Bookmarks</div>
            <div id='divTopLogoAndHeadline_right_user' class="divTopLogoAndHeadline_p" style="margin-right:0px;" onclick='jumpTo("lower_part_user")'>User <i class="fa fa-solid fa-caret-down"></i></div>
        </div>
    </div>
    <!-- mobile display only - headline start-->
    <div id="divTopLogoAndHeadline_mobile" class="mobileDisplayOnly">
        <div id="headline_mobile" class="mobileDisplayOnly" onclick='reloadAndRetrieveData_lowerPannel("display_all","no");jumpTo_mobile("lower_part_main");'><i>B</i>ookmark <i>A</i>lien</div>
        <img id="logoImg_mobile" src="image_logo.png" onclick='reloadAndRetrieveData_lowerPannel("display_all","no");jumpTo_mobile("lower_part_main");'></img>
    </div>
    <!-- mobile display only - headline end -->
    <div class="divTopTabs">
        <?php
        $specificUserForDataRetrieve = $_SESSION["user_name"];
        include "inc_conn.php";
        $sql = "SELECT distinct tab FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' ORDER by id ASC"; // אפשר להוסיף מיון של הקטגרויות כאן
        if ($result = $conn->query($sql)) {
            $rowcount = mysqli_num_rows($result);
            if ($rowcount >= 1) {
                while ($row = $result->fetch_assoc()) {
                    $tab = $row["tab"];
                    $secondFunction = "";
                    if ($tab == "Main") {
                        $secondFunction = "jumpTo('lower_part_main')";
                    }
                    echo "<div class='divTopTabs_p' onclick=\"reloadAndRetrieveData_lowerPannel('$tab','no');$secondFunction\">$tab</div>";
                }
            }
        }
        ?>
    </div>
    <!-- mobile display only - divTopTabs - start -->
    <div id="divTopTabs_mobile" class="mobileDisplayOnly">
        <div id="divTopTabs_mobile_p"><input type='hidden' id='current_user_name_mobile' value='visitor'>
        </div>
        <div id="divTopTabs_mobile_menu"><i id='bar_icon' class="fa fa-solid fa-bars" onclick='openOrCloseHamburgerMenuMobile();'></i></div>
    </div>
    <div id="mobile_hamburger_screen" class="mobileDisplayOnly" style=''>
        <div id="mobile_hamburger_screen_inner">
            <div id='mobile_hamburger_screen_inner_user' class='mobile_hamburger_screen_inner_p' onclick='jumpTo_mobile("lower_part_user")'>User  <i class="fa fa-user"></i></div>
            <div class='mobile_hamburger_screen_inner_p' onclick='jumpTo_mobile("lower_part_main")'>Main <i class="fa fa-chevron-down"></i></div>
            <div class='mobile_hamburger_screen_inner_p' onclick='jumpTo_mobile("lower_part_my_categories");display_my_categories_function("lower_part_my_categories_inner");'>My Categories  <i class="fa fa-chevron-down"></i></div>
            <div class='mobile_hamburger_screen_inner_p' onclick='jumpTo_mobile("lower_part_my_bookmarks");display_my_bookmarks_function("lower_part_my_bookmarks_inner");'>My Bookmarks  <i class="fa fa-bookmark"></i></div>
            <div class='mobile_hamburger_screen_inner_p' onclick='jumpTo_mobile("lower_part_user_add_new_bookmark");goto_addNewBookMark();'>Add new Bookmark  <i class="fa fa-cloud-arrow-up"></i></div>
        </div>
    </div>
    <div id="divMainFunctionalityAndSearchBars_mobile" class="mobileDisplayOnly">
        <div id="divTopTabs_mobile_p_large">        <?php
        $specificUserForDataRetrieve = $_SESSION["user_name"];
        include "inc_conn.php";
        $sql = "SELECT distinct tab FROM bookmark_main_table WHERE user_name='$specificUserForDataRetrieve' ORDER by id ASC"; // אפשר להוסיף מיון של הקטגרויות כאן
        if ($result = $conn->query($sql)) {
            $rowcount = mysqli_num_rows($result);
            if ($rowcount >= 1) {
                while ($row = $result->fetch_assoc()) {
                    $tab = $row["tab"];
                    $secondFunction = "";
                    if ($tab == "Main") {
                        $secondFunction = "jumpTo_mobile('lower_part_main')";
                    }
                    echo "<input type='button' class='divTopTabs_mobile_p_large_tabs' onclick=\"reloadAndRetrieveData_lowerPannel('$tab','no');$secondFunction\"  value='$tab'/>";
                }
            }
        }
        ?></div>
        <input type="text" class="inputText" placeholder="Find Category" onchange="reloadAndRetrieveData_lowerPannel(this.value,'yes');" />
        <input type="text" class="inputText" placeholder="Search Bookmarks" onchange="reloadAndRetrieveData_lowerPannel_search_bookmarks(this.value);" />
    </div>
    <!-- mobile display only - divTopTabs - end -->
    <div class="divMainFunctionalityAndSearchBars">
        <div class="divMainFunctionalityAndSearchBars_p" style="margin-left: 70px;display:inline;"><i class="fa fa-plus"></i><div id='add_new_bookmark_desktop' style='display:inline;' onclick='goto_addNewBookMark();'> Add New Bookmark </div></div>
        <div class="divMainFunctionalityAndSearchBars_searchBars">
        <div id='displayOnlyOnMainDesktop'>
        <select id="numColumnsSelector" class="inputText" onchange="changeDisplayedColumns(this.value);" style='width:140px;margin-right:12px'>
                    <option value=0>Num Columns</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                </select>
                <input type="text" class="inputText" placeholder="Find Category" onchange="reloadAndRetrieveData_lowerPannel(this.value,'yes');" style='margin-right:12px' />
                <input type="text" class="inputText" placeholder="Search Bookmarks" onchange="reloadAndRetrieveData_lowerPannel_search_bookmarks(this.value);" style='margin-right:12px' />
        </div>
        </div>
    </div>
    <div id='lower_part'> 
        <div id='lower_part_user'>
            <div id='lower_part_user_inner' class='lower_part_window' style="">
                <div id='lower_part_user_inner_form'>
                    <input type='text' id='lower_part_user_userName' placeholder='user name' class='inputText' style='margin-bottom:20px;'/>
                    <input type='password' id='lower_part_user_password' placeholder='password' class='inputText' style='margin-bottom:20px;'/>
                    <div id='lower_part_user_loginBtn' class='btn' onclick='loginFunction()'>Login <i style='margin-left:12px;' class="fa fa-right-to-bracket"></i></div>
                </div>
            </div>
        </div>
        <div id='lower_part_user_add_new_bookmark'>
            <div id='lower_part_user_inner_add_new_bookmark' class='lower_part_window' style="">
                <div id='lower_part_user_inner_form_add_new_bookmark'>   
                    <input list="list_of_tabs" id="lower_part_user_add_new_bookmark_tab" placeholder='Select Tab' class='inputText' style='margin-bottom:20px;' />
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
                    <input list="list_of_Categories" id="lower_part_user_add_new_bookmark_category" placeholder='Select Category' class='inputText' style='margin-bottom:20px;' />
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
                    <input type='text' id='lower_part_user_add_new_bookmark_bookmark_headline' placeholder='Bookmark Headline' class='inputText' style='margin-bottom:20px;'/>
                    <input type='text' id='lower_part_user_add_new_bookmark_bookmark_url' placeholder='Bookmark URL' class='inputText' style='margin-bottom:20px;'/>
                    <input type='text' id='lower_part_user_add_new_bookmark_bookmark_meta' placeholder='Bookmark Meta' class='inputText' style='margin-bottom:20px;'/>
                    <input type='text' id='lower_part_user_add_new_bookmark_bookmark_notes' placeholder='Bookmark Notes' class='inputText' style='margin-bottom:20px;'/>
                    <div class='btn' id='lower_part_user_loginBtn_add_new_bookmark' onclick='add_new_bookmark()'>Add <i style='margin-left:12px;margin-right:30px;' class="fa fa-cloud-arrow-up"></i> </div>
                </div>
            </div>
        </div>
        <div id='lower_part_settings'>
           <div id='lower_part_settings_inner' class='lower_part_window' style=""></div>
        </div>
        <div id='lower_part_my_bookmarks'>
            <div id='lower_part_my_bookmarks_inner' class='lower_part_window' style=""></div>
        </div>
        <div id='lower_part_my_categories'>
            <div id='lower_part_my_categories_inner' class='lower_part_window' style=""></div>
        </div>
        <div id='lower_part_main'>
            <div id='divCategoriesAndBookmarks_id' class="divCategoriesAndBookmarks_3">
            <!-- reloadAndRetrieveData_lowerPannel content goes here -->
            </div>
        </div>
        <div id='color_picker'>
            <p style="padding-left:5px;font-family:DMSans_Regular;">pick a color for the category</p>
            <input type='button' id='color_picker_1' class='color_picker_box' style="background-color:rgb(92,120,174);" value='background-color:rgb(92,120,174);'   onclick='userColorSelectionForCategory(this.id,this.value);' /> 
            <input type='button' id='color_picker_2' class='color_picker_box' style="background-color:rgb(214,65,97);" value='background-color:rgb(214,65,97);'     onclick='userColorSelectionForCategory(this.id,this.value);'  />
            <input type='button' id='color_picker_3' class='color_picker_box' style="background-color:rgb(135,143,153);" value='background-color:rgb(135,143,153);' onclick='userColorSelectionForCategory(this.id,this.value);'  />
            <input type='button' id='color_picker_4' class='color_picker_box' style="background-color:rgb(107,91,149);" value='background-color:rgb(107,91,149);'   onclick='userColorSelectionForCategory(this.id,this.value);'  />
            <input type='button' id='color_picker_5' class='color_picker_box' style="background-color:rgb(134,175,73);" value='background-color:rgb(134,175,73);'   onclick='userColorSelectionForCategory(this.id,this.value);'  />
            <input type='button' id='color_picker_6' class='color_picker_box' style="background-color:rgb(62,68,68);" value='background-color:rgb(62,68,68);'       onclick='userColorSelectionForCategory(this.id,this.value);'  />
            <input type='button' id='color_picker_7' class='color_picker_box' style="background-color:rgb(3,79,132);" value='background-color:rgb(3,79,132);'       onclick='userColorSelectionForCategory(this.id,this.value);'   />
            <input type='button' id='color_picker_8' class='color_picker_box' style="background-color:rgb(247,120,107);" value='background-color:rgb(247,120,107);' onclick='userColorSelectionForCategory(this.id,this.value);'  />
            <input type='button' id='color_picker_9' class='color_picker_box' style="background-color:rgb(201,76,76);" value='background-color:rgb(201,76,76);'     onclick='userColorSelectionForCategory(this.id,this.value);'  />
            <input type='button' id='color_picker_10' class='color_picker_box' style="background-color:rgb(194,86,26);" value='background-color:rgb(194,86,26);'  onclick='userColorSelectionForCategory(this.id,this.value);'   />
            <input type='button' id='color_picker_11' class='color_picker_box' style="background-color:rgb(235,200,68)" value='background-color:rgb(235,200,68);'      onclick='userColorSelectionForCategory(this.id,this.value);'  />
            <input type='button' id='color_picker_12' class='color_picker_box' style="background-color:rgb(241,108,32);" value='background-color:rgb(241,108,32);' onclick='userColorSelectionForCategory(this.id,this.value);' />
            <input type='button' id='color_picker_13' class='color_picker_box' style="background-color:rgb(97,134,133);" value='background-color:rgb(97,134,133);'  onclick='userColorSelectionForCategory(this.id,this.value);' />
            <input type='button' id='color_picker_14' class='color_picker_box' style="background-color:rgb(64,64,161);" value='background-color:rgb(64,64,161);'    onclick='userColorSelectionForCategory(this.id,this.value);'  />
            <input type='button' id='color_picker_15' class='color_picker_box' style="background-color:rgb(241,137,115);" value='background-color:rgb(241,137,115);' onclick='userColorSelectionForCategory(this.id,this.value);' />
            <input type='button' id='color_picker_16' class='color_picker_box' style="background-color:rgb(4,170,109);" value='background-color:rgb(4,170,109);'     onclick='userColorSelectionForCategory(this.id,this.value);' />
            <input type='hidden' id='color_picker_user_name' value='' />
            <input type='hidden' id='color_picker_current_category' value='' />
            <input type='hidden' id='color_picker_div_id_for_color_change' value='' />
            <input type='hidden' id='color_picker_selected_color' />
            <div class ='btn' onclick='saveSelectedColor();'> Save <i class="fa fa-floppy-disk" style='padding-left:12px;'></i></div>
        </div>
    </div>
    <script>
        function changeDisplayedColumns(numColumns){
            if(numColumns!=0){
                var numberOfColumns=numColumns;
                    document.getElementById('divCategoriesAndBookmarks_id').className = 'divCategoriesAndBookmarks_' +numberOfColumns;   
            }
        }
        function openCloseWindow(idOfCurrentDiv,idOfChangingSign){
            var x = document.getElementById(idOfCurrentDiv);
                if (x.style.display === "none") {
                    x.style.display = null;
                    document.getElementById(idOfChangingSign).className="fa fa-minus";
                } else {
                    x.style.display = "none";
                    document.getElementById(idOfChangingSign).className="fa fa-plus";
                }    
        }
        function reloadAndRetrieveData_lowerPannel(filterBy,is_partial_search){
            var affected_div= 'divCategoriesAndBookmarks_id';
            var user_name='visitor';
                if(document.getElementById('current_user_name')!=null){
                    user_name=document.getElementById('current_user_name').value; 
                }
            var tab=filterBy;
            var partial_search=is_partial_search;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("POST","https://tihnun.net/bookmark/v2/retrieve_data.php",true);
            xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlHttp.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    document.getElementById(affected_div).innerHTML=xmlHttp.responseText;
                    if(window.matchMedia('(max-width: 1000px)').matches){
                        closeBookmarksOnOpenMobile();

                    }
                }
            }
                        xmlHttp.send(
                        "user_name="+user_name+
                        "&tab="+tab+
                        "&partial_search="+partial_search);
                    
                    }
        function reloadAndRetrieveData_lowerPannel_search_bookmarks(filterBy){
            var affected_div= 'divCategoriesAndBookmarks_id';
            var user_name='visitor';
                if(document.getElementById('current_user_name')!=null){
                    user_name=document.getElementById('current_user_name').value; 
                }
            var bookmarks=filterBy;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("POST","https://tihnun.net/bookmark/v2/retrieve_data.php",true);
            xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlHttp.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    document.getElementById(affected_div).innerHTML=xmlHttp.responseText;
                }
            }
                        xmlHttp.send(
                        "user_name="+user_name+
                        "&bookmark="+bookmarks);      
        }

        function jumpTo(location){
            reloadAndRetrieveData_lowerPannel('display_all','no');
            document.getElementById('lower_part_settings').style="display:none;";
            document.getElementById('lower_part_my_bookmarks').style="display:none;";
            document.getElementById('lower_part_my_categories').style="display:none;";
            document.getElementById('lower_part_main').style="display:none;";
            document.getElementById('mobile_hamburger_screen').style="display:none;";
            document.getElementById('color_picker').style="display:none;";
            document.getElementById('displayOnlyOnMainDesktop').style='display:none;';
            document.getElementById('lower_part_user').style='display:none;';
            document.getElementById('lower_part_user_add_new_bookmark').style='display:none;';
                    document.getElementById(location).style=null;
                    if(location=='lower_part_main'){
                        document.getElementById('displayOnlyOnMainDesktop').style='display:flex;';
                    }
        }

        function jumpTo_mobile(location){
            reloadAndRetrieveData_lowerPannel('display_all','no');
            document.getElementById('lower_part_settings').style="display:none;";
            document.getElementById('lower_part_my_bookmarks').style="display:none;";
            document.getElementById('lower_part_my_categories').style="display:none;";
            document.getElementById('lower_part_main').style="display:none;";
            document.getElementById('mobile_hamburger_screen').style="display:none;";
            document.getElementById('color_picker').style="display:none;";
            document.getElementById('displayOnlyOnMainDesktop').style='display:none;';
            document.getElementById('lower_part_user').style='display:none;';
            document.getElementById('lower_part_user_add_new_bookmark').style='display:none;';
                    document.getElementById(location).style=null;
                    document.getElementById('bar_icon').className='fa fa-solid fa-bars';
                    document.getElementById('divMainFunctionalityAndSearchBars_mobile').style="display:none";
                    if(location=='lower_part_main'){
                        document.getElementById('divMainFunctionalityAndSearchBars_mobile').style='display:flex;';
                    }
        }
        function styleResetById(elementId){
            document.getElementById(elementId).style=null;
        }

        function openOrCloseHamburgerMenuMobile(){
            if(document.getElementById('bar_icon').className=='fa fa-solid fa-bars'){
                document.getElementById('bar_icon').className='fa-solid fa-xmark';
                document.getElementById('mobile_hamburger_screen').style=null;
            }
            else{
                document.getElementById('bar_icon').className='fa fa-solid fa-bars';
                document.getElementById('mobile_hamburger_screen').style="display:none;";
            }
        }
                function closeBookmarksOnOpenMobile(){
                    const nodeList = document.querySelectorAll('.categoryContainer_bookmarks');
                        for (let i = 0; i < nodeList.length; i++) {
                        nodeList[i].style='display:none;';
                        }
                    const nodeListMinusSigns=document.querySelectorAll('.fa.fa-minus');
                        for (let i = 0; i < nodeListMinusSigns.length; i++) {
                            nodeListMinusSigns[i].className="fa fa-plus";
                        }
                }
                function display_my_categories_function(changedDivName){
                    var affected_div= changedDivName;
                    var user_name='visitor';
                    if(document.getElementById('current_user_name')!=null){
                        user_name=document.getElementById('current_user_name').value; 
                    }
                    var display_my_categories='activate';
                    var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open("POST","https://tihnun.net/bookmark/v2/retrieve_data.php",true);
                    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlHttp.onreadystatechange = function() {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            document.getElementById(affected_div).innerHTML=xmlHttp.responseText;
                        }
                    }
                                xmlHttp.send(
                                "user_name="+user_name+
                                "&display_my_categories="+display_my_categories);
                    
        }
                function display_my_bookmarks_function(changedDivName){   
                        var affected_div= changedDivName;
                        var user_name='visitor';
                        if(document.getElementById('current_user_name')!=null){
                            user_name=document.getElementById('current_user_name').value; 
                        }
                        var display_my_bookmarks='activate';
                        var xmlHttp = new XMLHttpRequest();
                        xmlHttp.open("POST","https://tihnun.net/bookmark/v2/retrieve_and_update_data.php",true);
                        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xmlHttp.onreadystatechange = function() {
                            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                                document.getElementById(affected_div).innerHTML=xmlHttp.responseText;
                            }
                        }
                                    xmlHttp.send(
                                    "user_name="+user_name+
                                    "&display_my_bookmarks="+display_my_bookmarks+
                                    "&order_by=alphanumeric");
            }

        function changeCategoryColor(userName,currentCategory,currentColor,divIdForColorChange){
            var x = document.getElementById("color_picker");
                if (x.style.display === "none") {
                    x.style.display = "flex";
                } else {
                    x.style.display = "none";
                }
                const nodeList = document.querySelectorAll('.color_picker_box');
                        for (let i = 0; i < nodeList.length; i++) {
                            if(nodeList[i].value=='background-color:'+currentColor+';'){
                                 nodeList[i].style='background-color:'+currentColor+';border:2px dashed white;';
                            }
                        }
                        document.getElementById('color_picker_user_name').value=userName;
                        document.getElementById('color_picker_current_category').value=currentCategory;
                        document.getElementById('color_picker_div_id_for_color_change').value=divIdForColorChange;
        }

        function userColorSelectionForCategory(thisIdAsSelectedDiv,thisValueAsSelectedColor){
            const nodeList = document.querySelectorAll('.color_picker_box');
                        for (let i = 0; i < nodeList.length; i++) {
                             nodeList[i].style='background-color:'+nodeList[i].style.backgroundColor+';border:1px solid black;';
                        }
                        document.getElementById(thisIdAsSelectedDiv).style=thisValueAsSelectedColor+'border:2px dashed white;';
                        document.getElementById('color_picker_selected_color').value=thisValueAsSelectedColor;
        }

        function saveSelectedColor(){
            document.getElementById(document.getElementById('color_picker_div_id_for_color_change').value).
            style.cssText +=document.getElementById('color_picker_selected_color').value;
                var user_name='visitor';
                    if(document.getElementById('current_user_name')!=null){
                        user_name=document.getElementById('current_user_name').value; 
                    }
                    var category=document.getElementById('color_picker_current_category').value;
                    var color_property=document.getElementById('color_picker_selected_color').value;
                    var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open("POST","https://tihnun.net/bookmark/v2/update_data.php",true);
                    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlHttp.onreadystatechange = function() {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            //document.getElementById(affected_div).innerHTML=xmlHttp.responseText;
                            document.getElementById('color_picker').style='display:none';
                        }
                    }
                                xmlHttp.send(
                                "user_name="+user_name+
                                "&category="+category+
                                "&color_property="+color_property);
        }
        function loginFunction(){
                    var user_name=document.getElementById('lower_part_user_userName').value;
                    var password=document.getElementById('lower_part_user_password').value;
                    if(user_name!='' && password!=''){
                    var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open("POST","https://tihnun.net/bookmark/v2/retrieve_data.php",true);
                    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlHttp.onreadystatechange = function() {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                              if(xmlHttp.responseText!='Wrong username or password'){
                                    document.getElementById('lower_part_user_loginBtn').
                                    innerHTML='Login <i style="margin-left:12px;margin-right:30px;" class="fa fa-right-to-bracket"></i>'+xmlHttp.responseText;
                                    document.getElementById('lower_part_user_loginBtn').style.cssText+='color:rgb(20,164,77)';
                                    setTimeout(location.reload(), 8000);
                                }
                                if(xmlHttp.responseText=='Wrong username or password'){
                                    document.getElementById('lower_part_user_loginBtn').
                                    innerHTML='Login <i style="margin-left:12px;margin-right:30px;" class="fa fa-right-to-bracket"></i>'+xmlHttp.responseText;
                                    document.getElementById('lower_part_user_loginBtn').style.cssText+='color:tomato;';
                                    resetLogin();
                                }
                        }
                    }
                                xmlHttp.send(
                                "user_name="+user_name+
                                "&password="+password);  
                    }
        }
        function resetLogin(){
            setTimeout(() =>{
            document.getElementById('lower_part_user_password').value='';
            document.getElementById('lower_part_user_loginBtn').
                                    innerHTML='Login <i style="margin-left:12px;margin-right:30px;" class="fa fa-right-to-bracket"></i>';
                                    document.getElementById('lower_part_user_loginBtn').style=null;},4000);
        }
        function changeWelcomeMessage(){
            var user_name='<?php echo $_SESSION["user_name"]; ?>';
            document.getElementById('welcome_user').innerHTML='Welcome '+user_name+'<input type="hidden" id="current_user_name" value="<?php echo $_SESSION[
                "user_name"
            ]; ?>">';
            document.getElementById('divTopTabs_mobile_p').innerHTML='Welcome '+user_name+'<input type="hidden" id="current_user_name" value="<?php echo $_SESSION[
                "user_name"
            ]; ?>">';
            if(document.getElementById('current_user_name').value!='visitor' && document.getElementById('current_user_name').value!=''  ){
                changeToLogOut_desktop();
                changeToLogOut_mobile();
            }
        }
        function changeToLogOut_desktop(){
            document.getElementById('divTopLogoAndHeadline_right_user').innerHTML='<div style="cursor:pointer;" onclick="window.open(\'con_close.php\',\'_self\');">Logout  <i class="fa-solid fa-user"></i></div>';
        }
        function changeToLogOut_mobile(){
            document.getElementById('mobile_hamburger_screen_inner_user').innerHTML='<div style="cursor:pointer;" onclick="window.open(\'con_close.php\',\'_self\');">Logout  <i class="fa-solid fa-user"></i></div>';
        }
        function goto_addNewBookMark(){
            document.getElementById('lower_part_settings').style="display:none;";
            document.getElementById('lower_part_my_bookmarks').style="display:none;";
            document.getElementById('lower_part_my_categories').style="display:none;";
            document.getElementById('lower_part_main').style="display:none;";
            document.getElementById('mobile_hamburger_screen').style="display:none;";
            document.getElementById('color_picker').style="display:none;";
            document.getElementById('displayOnlyOnMainDesktop').style='display:none;';
            document.getElementById('lower_part_user').style='display:none;';
            document.getElementById('lower_part_user_add_new_bookmark').style='display:block;';
        }
        function add_new_bookmark(){
            if(document.getElementById('current_user_name').value=='visitor'){
                document.getElementById('lower_part_user_loginBtn_add_new_bookmark').
                innerHTML="Add <i style='margin-left:12px;margin-right:30px;color:tomato;' class='fa fa-cloud-arrow-up'></i> You have to Login... ";
            }
            if(document.getElementById('current_user_name').value!='visitor'){
                document.getElementById('lower_part_user_loginBtn_add_new_bookmark').
                innerHTML="Add <i style='margin-left:12px;margin-right:30px;' class='fa fa-cloud-arrow-up'></i> ";
                                var user_name=document.getElementById('current_user_name').value;
                                var tab=document.getElementById('lower_part_user_add_new_bookmark_tab').value;
                                var category=document.getElementById('lower_part_user_add_new_bookmark_category').value;
                                var bookmark_headline=document.getElementById('lower_part_user_add_new_bookmark_bookmark_headline').value;
                                var bookmark_url=document.getElementById('lower_part_user_add_new_bookmark_bookmark_url').value;
                                var bookmark_meta=document.getElementById('lower_part_user_add_new_bookmark_bookmark_meta').value;
                                var bookmark_notes=document.getElementById('lower_part_user_add_new_bookmark_bookmark_notes').value;
                                if(tab==''){tab='Main';}
                                if(category==''){category='personal';}
                                if(bookmark_headline=='' || bookmark_url==''){
                                    document.getElementById('lower_part_user_loginBtn_add_new_bookmark').
                                     innerHTML="Add <i style='margin-left:12px;margin-right:30px;color:tomato;' class='fa fa-cloud-arrow-up'></i> Headline and URL Required ";
                                     document.getElementById("lower_part_user_loginBtn_add_new_bookmark").style.cssText+='color:tomato;';
                                }
                                if(bookmark_meta==''){bookmark_meta='no info';}
                                if(bookmark_notes==''){bookmark_notes='no info';}
                if(bookmark_headline!='' && bookmark_url!=''){
                var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open("POST","https://tihnun.net/bookmark/v2/insert_data.php",true);
                    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlHttp.onreadystatechange = function() {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            document.getElementById("lower_part_user_loginBtn_add_new_bookmark")
                            .innerHTML="Add <i style='margin-left:12px;margin-right:30px;color:	RGB(25, 135, 84);' class='fa fa-cloud-arrow-up'></i>"+xmlHttp.responseText;
                            document.getElementById("lower_part_user_loginBtn_add_new_bookmark").style.cssText+='color:	RGB(25, 135, 84);';
                        }
                    }
                                xmlHttp.send(
                                "user_name="+user_name+
                                "&tab="+tab+
                                "&category="+category+
                                "&bookmark_headline="+bookmark_headline+
                                "&bookmark_url="+bookmark_url+
                                "&bookmark_meta="+bookmark_meta+
                                "&bookmark_notes="+bookmark_notes
                                );
                }
            }
        }
        function deleteBookmarkbyId(rowIdForDelete,bookmarkHeadline){
            var deleteQuestion = confirm("Are you sure you want to delete ['"+bookmarkHeadline+"']?");
            if(deleteQuestion){
                var affected_div= 'categoryContainer_headline_bookmarks';
                var user_name=document.getElementById('current_user_name').value;
                var idForDelete= rowIdForDelete;  
                        var xmlHttp = new XMLHttpRequest();
                        xmlHttp.open("POST","https://tihnun.net/bookmark/v2/retrieve_and_update_data.php",true);
                        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xmlHttp.onreadystatechange = function() {
                            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                                //document.getElementById(affected_div).innerHTML=xmlHttp.responseText;
                                display_my_bookmarks_function("lower_part_my_bookmarks_inner");
                            }
                        }
                                    xmlHttp.send(
                                    "user_name="+user_name+
                                    "&idForDelete="+idForDelete);
            }
        }
        function updateBookmarkbyId(rowIdForUpdate){
        const windowFeatures = "left=500,top=100,width=1005,height=900";
           window.open("update_bookmark.php?idForUpdate="+rowIdForUpdate,'_blank',windowFeatures);
            }
    </script>
</body>
</html>