
$(document).on('click', '.checkoutBtn', function(e){
  e.preventDefault();
    var totalPrice=$(this).attr('totalPrice');
  var accountNumber=$(this).attr('accountNumber');

  if(totalPrice==0){
    show_PopupInfoMessage("There are no items in your cart.")
  return;
  }
  
  show_PopupConfirmMessage("You have to Transfer <b>$"+totalPrice+"</b> to our Bank Account <b><i>"+accountNumber+"</i></b> to complete your order");
 });



$(document).on('click', '.delete-from-cart', function(e){
  e.preventDefault();
  var href=$(this).attr('href');
  /*as the last is hardcodeded to be 1*/
  var url=href.substr(0, href.length-1)+' '+$('.'+$(this).attr('itemId')+'_selectedQuantity').val();
  $.ajax({
 type: 'get',
  url: url,
  success: function(data){
    if(data=='quantity_mismatch')
    {
      showErrorMessage('There are not enough items in the cart');
      return;
    }
    if(data=='not_found')
    {
      showErrorMessage('Order not found');
      return;
    }
   $(".mainBody").empty().append(data);
  },
  error: function(err){
    console.log('error occured');
    console.log('error');
  }
  });
});


$(document).on("click", ".addItemToCartBtn", function(e){
  e.preventDefault();
 var href=$(this).attr('href');
 var itemId=$(this).attr('itemId');
 var quantity=$('.'+itemId+'_selectedQuantity').val();
  /*as the last is hardcodeded to be 1*/
  var url=href.substr(0, href.length-1)+' '+quantity;
  
$.ajax({
  type: 'get',
  url: url,
  success: function(data){
    $('.'+itemId+'_selectedQuantity').val("1");
    if(data[0]=='true'){
      /* $(".itemsInCart").css('display', 'block');
       $(".itemsInCart").empty().append(data[1]);*/
      showSuccessMessage(quantity+' Item(s) added to Cart.');
    } 
    else if(data[0]=='false' && data[1]=='Unauthenticated')
      showModal('.loginPartial')
    else if(data[0]=='false'){
      showErrorMessage(data[1]);
    } 
    else
     showErrorMessage('Error Item not added to Cart.'+data[0]);
  },
  error: function(err){
     showErrorMessage('Error Item not added to Cart.');
  }
});
});


$(document).on('input', '.searchItems_Tf', function(e){
  e.preventDefault();
var key=$(this).val();
  $.ajax({
 type: 'get',
  url: window.location.origin+"/searchByKey/"+key,
  success: function(data){
   $(".mainBody").empty().append(data);
  },
  error: function(err){
    console.log('error occured');
  }
  });
});

$(document).on('click', '.payToPurchases', function(e){
  e.preventDefault();
  var url=$(this).attr('href');
  $.ajax({
 type: 'get',
  url: url,
  success: function(data){
    if(data=='empty_order'){
      showErrorMessage('No items selected for purchase.')
    }else{
         activateUrl(data);
       }
  },
  error: function(err){
    console.log('error occured');
    console.log('error');
  }
  });
});

$(document).on('submit', '.logoutBtn', function(e){
  e.preventDefault();
  var url=$(this).attr('action');
  var data=$(this).serialize();
  $.ajax({
  type:'post',
  url: url,
  data:data,
  success: function(data){
    alert(data);
    if(data=='loggedout'){
      $(".logoutBtn").css('display', 'none');
      $(".loginBtn").css('display', 'block');
      showSuccessMessage('Logged out successfully.');
      $(".loggedInUser").empty();     
      activateAjaxUrl(url); 
    }
    if(data='home'){
     showErrorMessage('Logout Failed.');
    }
    else{
   showModalErrorMessage('Login failed!');
    clearPasswordField()
    }
  },
  error: function(err){
   showModalErrorMessage('Login failed!');
    clearPasswordField()
  }
});
});

$(document).on("submit", ".loginForm", function(e){
  e.preventDefault();
var data=$(this).serialize();
var url=$(this).attr('action');
$.ajax({
  type: 'post',
  url: url,
  data:data,
  success: function(data){
    if(data[0]=='/ajaxloggedIn'){
    activateUrl(data[0]);
      /* $(".loginBtn").css('display', 'none');
       $(".logoutBtn").css('display', 'block');
      showSuccessMessage('Login successful.');
      activateAjaxUrl('ajaxloggedIn');
      $(".loggedInUser").empty().append('<span style="color: white;">Logged In: </span>'+data[1]+'</span>')
      closeModal();*/
      return;
    }
    else if(data[0]=='home'){
     activateUrl('home');
     return;
    }
    else{
        showModalErrorMessage('Login failed!');
            clearPasswordField()
        return;
      }
  },
  error: function(err){
    showModalErrorMessage('Login failed!');
       clearPasswordField()
    console.log('Login failed!');
  }
});
});
$(document).on("click", ".loginBtn", function(e){
  e.preventDefault();
var url=$(this).attr('href');
$.ajax({
  type: 'get',
  url: url,
  success: function(data){
   showModal(".loginPartial");
  },
  error: function(err){
    showErrorMessage('something went wrong');
  }
});
});

$(document).on("click", ".category-list", function(e){
  e.preventDefault();
var url=$(this).attr('href');
$.ajax({
  type: 'get',
  url: url,
  success: function(data){
    $(".featuredItems").empty().append(data);
      activateAjaxUrl(url); 
  },
  error: function(err){
    showErrorMessage('something went wrong');
  }
});
});


$(document).on("click", ".price-scale-list", function(e){
  e.preventDefault();
var url=$(this).attr('href');
$.ajax({
  type: 'get',
  url: url,
  success: function(data){
    $(".featuredItems").empty().append(data);
      activateAjaxUrl(url); 
  },
  error: function(err){
    showErrorMessage('something went wrong');
  }
});
});
/*Modal 1*/
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
$(document).on("click", ".close", function(){
  closeModal();
});
// When the user clicks on <span> (x), close the modal
/*span.onclick = function() {
    modal.style.display = "none";    
}*/

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        //modal.style.display = "none";
    }
    /*---End of modal*/
}

$(document).on("click", ".item-img", function(e){
  e.preventDefault();
   // modal.style.display = "block";
var url=$(this).attr('href');
$.ajax({
  type: 'get',
  url: url,
  success: function(data){
    $(".mainBody").empty().append(data);
    $(".nav_path").html("Home> Shop> <?php echo 'hshsfhsh'?>");
      activateAjaxUrl(url); 
  },
  error: function(err){
    showErrorMessage('something went wrong');
  }
});
})

function showModal(className){
    modal.style.display = "block";
    $("#modal_contentBody").empty().append($(className).html());
}
function closeModal(){
  $(".modalDisposerBtn").css("display", "none");
  $(".modalText").css("color", "");

    modal.style.display = "none";
}

function activateUrl(url){
      url="/"+url;
      window.history.pushState("Url ", "push state", window.location.origin+url);
      location.reload();
}

function activateAjaxUrl(url){
      window.history.pushState("Url ", "push state", url);
}

function reloadFullUrl(url){
      window.history.pushState("Url ", "push state", url);
      location.reload();
}



/*-----------FROM LEGACY SCRIPT*/

/*--------------------------------MESSAGES--------------------------------*/
function showSuccessMessage(message){
  $("#message-success-displayer").css("display", "block");
  $("#message-success").empty().append(message);
  setTimeout(function(){
        $("#message-success").empty();
  $("#message-success-displayer").css("display", "none");

        return;
      }, 5000);
}
function showErrorMessage(message){
  $("#message-error-displayer").css("display", "block");
  $("#message-error").empty().append(message);
  setTimeout(function(){
        $("#message-error").empty();
  $("#message-error-displayer").css("display", "none");

        return;
      }, 5000);
}
function showModalErrorMessage(message){
  $(".modalMessage").css("display", "block");
  $(".modalMessage").text(message);
  setTimeout(function(){
        $(".modalMessage").empty();
  $(".modalMessage").css("display", "none");

        return;
      }, 5000);
}

function show_PopupInfoMessage(message){
    modal.style.display = "block";
  $(".modalMessage").css("display", "block");
  $(".modalText").html(message);
  setTimeout(function(){
        $(".modalMessage").empty();
  $(".modalMessage").css("display", "none");
    closeModal();
        return;
      }, 5000);
}

function show_PopupConfirmMessage(message){
  $(".modalDisposerBtn").css("display", "block");
    modal.style.display = "block";
  $(".modalMessage").css("display", "block");
  $(".modalText").html(message);
}

function show_PopupErrorMessage(message){
    modal.style.display = "block";
  $(".modalMessage").css("display", "block");
  $(".modalText").html(message);
  $(".modalText").css("color", "orange");

  setTimeout(function(){
        $(".modalMessage").empty();
  $(".modalMessage").css("display", "none");
    closeModal();
        return;
      }, 5000);
}

$(document).on("click", ".modalDisposerBtn", function(e){
  e.preventDefault();
  closeModal();
  if($(this).attr('confirmed')=='true')
  {
    var url=$(".checkoutBtn").attr('href');
    $.ajax({
      type: 'get',
      url: url,
      success: function(data){
        activateUrl(data);
      },
      error: function(err){
        show_PopupErrorMessage("Order failed!");
      }
    });
  }
  else{
    show_PopupErrorMessage("Check out Canceled!<br> Your order is not Complete. Please try again.");
  }
});

function showValidationErrorMessage(message){
  $("#validation-error-message-displayer").css("display", "block");
  $("#validation-error-message").empty().append(message);
  setTimeout(function(){
        $("#validation-error-message").empty();
  $("#validation-error-message-displayer").css("display", "none");

        return;
      }, 5000);
}


function setSystemElementsIfNotExisted(){
$.ajax({
type: 'get',
url: window.location.origin+'/setSystemElementsIfNotExisted',
success: function(configured){
if(configured=="true")
showSuccessMessage("System Elements Configured successfully.");
},
error: function(err){
showErrorMessage("Warning!System Elements Configurations Missed");
}
});
}

/*--COUNTERS--*/
setInterval(function(){
$.ajax({
  type:'get',
  url: window.location.origin+'/getLiveCount',
  success: function(dataMap){
        if(dataMap.cartItemsCount>0){
        $(".cartItemsCount").text(dataMap.cartItemsCount);
        }else{
        $(".cartItemsCount").text("");
        }
        /*values*/
  },
  error: function(err){
    console.log('error occured');
  }
});
}, 1000);


/*
function isNumber(x){
    var regex=/^[+-]?([0-9]*[.])?[0-9]+$/;
    if (!x.match(regex))
    {
        return false;
    }
    else
    return true;
}

function isDouble(x){
    var regex=/^[0-9]+$/;
    if (!x.match(regex))
    {
        return false;
    }
    else
    return true;
}*/

$(document).on('submit', '.customerRegistrationForm', function(e){
     if($(".bankNumber").val().length<10|| $(".bankNumber").val().length>14){
        $(".bankNumber").css('background', "lightgray");
        alert("Account Number must be a number with 10-14 digits")
        e.preventDefault();
      }
});

$(document).on('input', '.number', function(e){
        var num=$(this).val().replace(/[^\d\.]/g, '');
        $(this).val(num);
});

$(document).on('input', '.double', function(e){
     var str=$(this).val();
     var num="";
        for(var i=0; i<str.length; i++){
          if(isDouble(str[i]))
            num+=""+i;
          /*else
            alert("not number");*/
        }
        $(this).val(num);
});

/*--END OF COUNTERS--*/


/*-------Back functionality*/
/*$(document).ready(function($) {

  if (window.history.pushState) {

   // window.history.pushState('forward', null, './#forward');

    $(window).on('popstate', function() {
      location.reload();
     alert('Back button was pressed.');
    });

  }
});*/
/*-------end of back------*/

window.onpopstate = function() {
     var referrer =  document.referrer;
   reloadFullUrl(referrer);
}; history.pushState({}, '');
/*------------------------------------------------------*/

function clearPasswordField(){
  $("#password").val("")
}













