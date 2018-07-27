/**
 * Created by Admin on 23.02.2017.
 */
$(document).ready(function(){
    console.log(getCookie('lezu'))
    $('.flag_a_img').click(function(){
        var lang = $(this).data('lang');
        var cook = "lezu="+lang+""
        setCookie(cook,20,function () {
           // conosole.log()
            window.location.href =  window.location.href;
        })
    })

    $('.pagination_item_z').click(function(){
        var val = $(this).data('num');
        var cook = "num="+val+"";
        setCookie(cook,20,function () {
            window.location.href =  window.location.href;
        })
    })

})
function subForm(x){
        var text=$('#user_mail').val();
        var url = base +"/registration/ajax/";
        var body = "text="+text+"";
        requestPost(url,body,function(){
            if(this.readyState == 4) {
                var result = JSON.parse(this.responseText);
                if (result.error) {
                    x.submit();
                }else{
                    console.log(result);
                }
            }
        })
    return false;
}


function subForgot(){
    var text=$('#mail_token').val();
    var url = base +"/registration/forgotpass/107/";
    var body = "mail_token="+text+"";
    requestPost(url,body,function(){
        if(this.readyState == 4) {
            var result = JSON.parse(this.responseText);
            if (result.error) {
                setTimeout(function(){
                    window.location.href = base;
                },4000);
            }else{
                console.log(result);
            }
        }
    })
    return false;
}

function setCookie(cname, exdays,callback) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname+";" + expires + ";path=/";
    callback();
}
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
function deleteCookie(name) {
    document.cookie = name + "=" + "; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
}