function statuschange(id)
{
    var mainurl = $('#mainurl').val();
    $.ajax({
      type: "GET",
      url: mainurl+"/admin/statuschange/"+id,
      success: function(resp) {                
        
      }
  });
}
function checkslug()
{
	var slug = $('#slug').val();
	var convertedslug = $('#slug').val(convertToSlug(slug)); 
    var mainurl = $('#mainurl').val();
    $.ajax({
        type: "GET",
        url: mainurl+"/checkslug/"+slug,
        success: function(resp) {
            if(resp == 1)
            {
            	$('#slugerror').html('Slug already in use');
            	$('#submitbutton').prop("disabled", true);
            }else{
            	$('#slugerror').html('');
            	$('#submitbutton').prop("disabled", false);
            }
        }
    });
}
function checkdiscountprice(id)
{

    var saleprice = $('#sale_price').val();
    var discount_price = parseInt(id);
    if(discount_price  >= saleprice)
    {
        $('#discount-error').html('Discount Price is Less then Sale Price');
        $('#submit-button').attr("disabled", true);
        
    }else{
        
        $('#discount-error').html('')
        $('#submit-button').attr("disabled", false);
    }
}

function saleprice(id)
{
    $("#discount_price").attr("readonly", false); 
}

function getstate(id)
{
    var mainurl = $('#mainurl').val();
    $.ajax({
        type: "GET",
        url: mainurl+"/ecommerece/getstate/"+id,
        success: function(resp) {
            $('#states').html(resp);
        }
    });
}
function getcity(id)
{
    var mainurl = $('#mainurl').val();
    $.ajax({
        type: "GET",
        url: mainurl+"/ecommerece/getcity/"+id,
        success: function(resp) {
            $('#cities').html(resp);
        }
    });
}

function checkordernumberofbanner(number , bannertype)
{
    $.ajax({
        type: "GET",
        url: mainurl+"/checkordernumberofbanner/"+number+"/"+bannertype,
        success: function(resp) {
            if(resp == 1)
            {
                $('#ordernumbererror').html('This Order Number already Use');
                $('#submitbutton').prop("disabled", true);
            }else{
                $('#ordernumbererror').html('');
                $('#submitbutton').prop("disabled", false);
            }
        }
    });
}



function createslug(Text)
{
    $('#slug').val(convertToSlug(Text));    
}

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}

function iconssame(){
    if($('#icons-same').is(":checked"))
    {
        $('#icon_label').html('Icon');
        $('#mobile_icon_div').hide();
    }else{
        $('#icon_label').html('Website Icon');
        $('#mobile_icon_div').show();
    }
}


$(document).ready(function() {
  $(".allow-numeric").bind("keypress", function (e) {
      var keyCode = e.which ? e.which : e.keyCode
           
      if (!(keyCode >= 48 && keyCode <= 57)) {
        return false;
      }
  });
});