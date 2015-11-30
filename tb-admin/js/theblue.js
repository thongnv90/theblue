function confirmPassword()
{
    var password = $('#Members_pr_member_password').val();
    var confirm_password = $('#pr_member_password_confirm').val();
    if(confirm_password==""){
        $('#pr_member_password_confirm_error').html("Xác nhận mật khẩu không được để trống.");
        return false;
    }
    if(password != confirm_password){
        $('#pr_member_password_confirm_error').html("Xác nhận mật khẩu không đúng.");
        return false;
    }
    return true;
}

function checkSelectAll() {
    var selectAll = $("#selectall").is(':checked');
    // Check All or Un Check All
        $('.case').attr('checked',selectAll);
        if($(".case").length==$(".case:checked").length){
            $("#selectall").attr("checked","checked");
        }else{
            $("#selectall").removeAttr("checked");
        }
    // END

};
function checkSelectCase() {
        if($(".case").length==$(".case:checked").length){
            $("#selectall").attr("checked","checked");
        }else{
            $("#selectall").removeAttr("checked");
        }
};

function getIDSelectInput(){
    var IDinput = "";
    var checkbox = document.getElementsByName('case');
    for(var i=0; i< checkbox.length; i++) {
        if(checkbox[i].checked)
        {
            IDinput += '&id[]='+checkbox[i].value;
        }
    }
    return IDinput;
}

function goBack() {
    window.history.back();
}

function goNext() {
    window.history.go(1);
}

function reload(){
    location.reload(); 
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}


