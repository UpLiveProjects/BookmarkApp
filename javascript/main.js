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