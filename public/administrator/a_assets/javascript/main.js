$(document).ready(function () {

    /* for lang */
    $(document).on("change",".onoffswitch-checkbox",function() {
        if($(this).prop("checked")){
            $('.forrus').css('display','block');
            $('.foreng').css('display','none');
        }else{
            $('.forrus').css('display','none');
            $('.foreng').css('display','block');
        }

    });
    /* for lang end */

    /* cookie notification */
    var cok = getCookie('not');
    if(cok == 'up'){
        $('#update_not').css('display','block');
        $('#save_not').css('display','none');
        $('.save_done').css('top','0');
        deleteCookie('not');
        setTimeout(function(){
            $('.save_done').css('top','-120px');
        },2000)
    }
    
    if(cok == 'save'){
        $('#save_not').css('display','block');
        $('#update_not').css('display','none');
        $('.save_done').css('top','0');
        deleteCookie('not');
        setTimeout(function(){
            $('.save_done').css('top','-120px');
        },2000)
    }
    /* cookie notification */
    
    $('.dropdown').click(function (e) {
        $('.dropdown').removeClass('open');
        $(this).toggleClass('open');
        e.stopPropagation();
    });

    $(document).click(function () {
        $('.dropdown').removeClass('open');
        setAutoheightZero();
    });
    $('.open_sub_menu').click(function () {
        $(this).parent('li').next('ul.main_sub_menu').slideToggle();
        return false;
    });
    $('._click_next').click(function () {
        $('.open_sub_menu').trigger('click');
    })


    $('#table_div table').DataTable({
        "iDisplayLength": 25,
        "lengthMenu": [10, 25, 50, 75, 100, 200],
    });

    $('.setsize').click(function () {
        elementChild = $(this).children('i');
        elementChild.toggleClass('fa-minus');
        elementChild.toggleClass('fa-plus');
        element = $(this).parent('div').parent('div').next('div.box_edit');
        element.slideToggle();
    })
    
    $( "._foto_block" ).click(function() {
      $(this).children(".img_file" )[0].click();
    });


    function renderImage(file,x){
        var reader = new FileReader();
        reader.onload = function(event){
                the_url = event.target.result;
                $(x).prev('img').css('display','block');
                $(x).prev('img').attr('src',the_url);
        }
        reader.readAsDataURL(file);
    }

    $( ".img_file" ).change(function() {
        $(this).parent('div.foto_block').removeClass('forempty');
        $(this).parent('div.foto_block').addClass('forfull');
        renderImage(this.files[0],this)
    }); 
    
    $(".action_delete").click(function(){
       ansyUrl = base+"/asynchronous/delete/";
       var sendParam = {};
       sendParam.id = $(this).data('id');
       sendParam.table = $(this).data('table');
       sendParam.path = $(this).data('path');
       sendParam.img = $(this).data('img');
       sendParam.seo = $(this).data('seo');
       if($(this).data('cross-table') != ""){
           sendParam.crossTable = $(this).data('cross-table');
           sendParam.crossTableFild = $(this).data('cross-table-fild');
           sendParam.crossPath = $(this).data('cross-path');
       }
       
       sendPostAjax(ansyUrl,sendParam,function(response){
           if(!response.error){
               $("#m_"+response.id+"").fadeOut();
           }else{
               alert("You have some error place refresh page and try again!!!");
           }
       });
       
//       var x = sendPostAjax(ansyUrl,sendParam);
//       console.log(x);
    });

})
function autoHeightAnimate(element, time) {
    if (element.is(':animated')) {
        return false;
    }
    var curHeight = element.height(),
    autoHeight = element.css('height', 'auto').height();
    element.height(curHeight);
    element.stop().animate({height: autoHeight}, parseInt(time));
}
function setAutoheightZero() {
    time = 300;
    element = $('ul.select_options');
    if (element.is(':animated')) {
        return false;
    }
    element.stop().animate({height: 0}, parseInt(time));
}
function sendPostAjax(url,params,callback){
    $.ajax({
        type: "POST",
        url: url,
        data: {params: params},
        dataType: "json",
        success: function (result) {
           callback(result);
        },
    });
   
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

function setCook(name,value){
    document.cookie = name + "=" +value;
}