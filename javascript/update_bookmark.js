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