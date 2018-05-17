function displayDetail(id) {

  if(document.getElementById(id).style.display == "none")

   document.getElementById(id).style.display = "block";
 else
   document.getElementById(id).style.display = "none";

}
 
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("btnOnTop").style.display = "block";
        document.getElementById("menu-top").style.display = "none";
    } else {
        document.getElementById("btnOnTop").style.display = "none";
        document.getElementById("menu-top").style.display = "block";
    }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

// show popup
function showPopup(id) {
    var popup = document.getElementById(id);
    popup.classList.add("show");
}
function hidPopup(id) {
    var popup = document.getElementById(id);
    popup.classList.remove("show");
}
 
 // riderct coupon
function getCoupon(id,url,ajxUrl) {
  var clipboard = new ClipboardJS('#coppy_'+id);
  clipboard.on('success', function(e) {
    alert("Đã Coppy Thành Công Mã: "+e.text);
    window.open(url,"_blank");
    updateClick(id,ajxUrl);
    e.clearSelection();
  });
}
function getLink(url) {
  window.open(url,"_blank");
}
function updateClick(id,url) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", url+id, true);
  xhttp.send();
}

//form login-register

function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
 

$(function() {
  var ation = $( '#frm-login' ).attr( 'action' );
  var urlHome = $('#homepage').val();
  var errmsg="";
    $('#loginSubmit').click(function(e) {
      e.preventDefault();
      $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
      });
      $.ajax({
          'url' : ation,
          'data': {
            'email' : $('#email').val(),
            'password' : $('#password').val()
          },
          'type' : 'POST',
          success: function (data) {
            
            if (data.error == true) { 

              if (data.message.email != undefined) {
                 errmsg +="<li>" + data.message.email[0] +"</li>";
              }
              if (data.message.password != undefined) {
                 errmsg +="<li>" + data.message.password[0]+"</li>";
              }
              if (data.message.errorlogin != undefined) {
                 errmsg +="<li>" +data.message.errorlogin[0]+"</li>";
              }
              shakeModal(errmsg);

            } else {
              window.location.replace(urlHome);
            }
          }
        });
    })
  });

function shakeModal(message){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html(message);
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}
//end login
// comment
function comment(url,inputId, idCmnt, couponId, newId) {
  var alertId='',errmsg='';
   if (couponId!=null) {
    alertId = couponId;
   }else{
    alertId = newId
   }
   $('#alert-danger-'+alertId).hide();
  $('#alert-success-'+alertId).hide();

  $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
      });
  $.ajax({
          'url' : url,
          'data': {
            'message' : $('#'+inputId).val(),
            'cmtId' : idCmnt,
            'couponId' : couponId,
            'newId': newId
          },
          'type' : 'POST',
          success: function (data) {
            if (data.error == true) { 
              if (data.message.message != undefined) {
                 errmsg +="<li>" + data.message.message[0] +"</li>";
              }
              if (data.message.errorlogin != undefined) {
                 errmsg +="<li>" +data.message.errorlogin[0]+"</li>";
              }
               $('#alert-danger-'+alertId).html(errmsg);
               $('#alert-danger-'+alertId).show();
               if (data.message.errorlogin != undefined) {
               setTimeout(openLoginModal(), 2000);
             }
            } else {
              var id ='#'+inputId;
              $(id).val("");
              $('#alert-success-'+alertId).html(data.message);
              $('#alert-success-'+alertId).show();
            }
          }
        });
}
