/**
 * Created by Admin on 23.02.2017.
 */
function requestPost(url,body,callback){
    var oAjaxReq = new XMLHttpRequest();
    oAjaxReq.open("post", url, true);
    oAjaxReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    oAjaxReq.send(body);
    oAjaxReq.onreadystatechange = callback;
}

function requestPut(url,body,callback){
    var oAjaxReq = new XMLHttpRequest();
    oAjaxReq.open("put", url, true);
    oAjaxReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    oAjaxReq.send(body);
    oAjaxReq.onreadystatechange = callback;
}
