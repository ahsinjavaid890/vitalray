function searchheaderpeoples(id) {
    if(id == '')
    {
        $('#myInputautocomplete-list').hide();
    }else{
        $('#myInputautocomplete-list').show();
        $.ajax({
            type: "GET",
            url: app_url()+'/searchheaderpeoples/'+id,
            success: function(resp) {
                $('#myInputautocomplete-list').html(resp);
            }
        });
    }
}
function app_url()
{
	return $('#app_url').val();
}
$( document ).ready(function() {
    $('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });
});
function sendrequest(id)
{
	$.ajax({
        type: "GET",
        url: app_url()+'/profile/sendlove/'+id,
        success: function(resp) {
        $('.send-love-button').html('<button onclick="sendrequest('+id+')" class="btn btn-primary"><i class="icofont-heart"></i> Sended</button>')
        }
    });
}
function getallnotifications()
{
    $.ajax({
        type: "GET",
        url: app_url()+'/profile/details/allnotifications',
        success: function(resp) {
            
            $('#allnotifications').html(resp);

        }
    });
}

function getfriendrequest()
{
	$.ajax({
        type: "GET",
        url: app_url()+'/profile/details/getfriendrequest',
        success: function(resp) {
    		
        	$('#friendrequests').html(resp);

        }
    });
}

function searccountries(id)
{
    $('.widget-author').addClass('blurfilter');

    if(!$('#searchcountry').val())
    {
        $.ajax({
            type: "GET",
            url: app_url()+'/profile/searchcountries/all',
            success: function(resp) {
                $('#countries').html(resp);
            }
        });
    }else
    {
        $.ajax({
            type: "GET",
            url: app_url()+'/profile/searchcountries/'+id,
            success: function(resp) {
                $('#countries').html(resp);
            }
        });
    }
    
}
function starpick(id)
{
    $('#rattings').val(id);
    if(id == 1)
    {
        $('#star1').css('color' , '#f7b035');
        $('#star2').css('color' , 'unset');
        $('#star3').css('color' , 'unset');
        $('#star4').css('color' , 'unset');
        $('#star5').css('color' , 'unset');

    }
    if(id == 2)
    {
        $('#star1').css('color' , '#f7b035');
        $('#star2').css('color' , '#f7b035');
        $('#star3').css('color' , 'unset');
        $('#star4').css('color' , 'unset');
        $('#star5').css('color' , 'unset');
    }
    if(id == 3)
    {
        $('#star1').css('color' , '#f7b035');
        $('#star2').css('color' , '#f7b035');
        $('#star3').css('color' , '#f7b035');
        $('#star4').css('color' , 'unset');
        $('#star5').css('color' , 'unset');
    }
    if(id == 4)
    {
        $('#star1').css('color' , '#f7b035');
        $('#star2').css('color' , '#f7b035');
        $('#star3').css('color' , '#f7b035');
        $('#star4').css('color' , '#f7b035');
        $('#star5').css('color' , 'unset');
    }
    if(id == 5)
    {
        $('#star1').css('color' , '#f7b035');
        $('#star2').css('color' , '#f7b035');
        $('#star3').css('color' , '#f7b035');
        $('#star4').css('color' , '#f7b035');
        $('#star5').css('color' , '#f7b035');
    }
}