function chat_starts_with(id)
{
    $.ajax({
        type: "GET",
        url: app_url()+'/profile/chat_starts_with/'+id,
        success: function(resp) {
        
        }
    });
}

function closchat(id)
{
     $.ajax({
        type: "GET",
        url: app_url()+'/profile/details/closchat/'+id,
        success: function(resp) {
            $('.newchatbox'+id).hide();
        }
    });
}

function minimizechat(id)
{
    $('.messages'+id).closest('.chatbox').toggleClass('chatbox-min');
}



function getchatmessages(id)
{
    $.ajax({
        type: "GET",
        url: app_url()+'/profile/getchatmessagesbyid/'+id,
        success: function(resp) {
            $('.messages'+id).html(resp);
            $('.messages'+id).scrollTop($('.messages'+id).get(0).scrollHeight);
        }
    });
}

function showchatpopup(id , name)
{
    var tst = 'newchatbox'+id;
    if($('.chatbox').hasClass(tst))
    {
        
    }else{
        $.ajax({
            type: "GET",
            url: app_url()+'/profile/showchatpopup/'+id,
            success: function(resp) {
                $('.chatbox-holder').append(resp);
                getchatmessages(id);
            }
        });
    }    
}



function submitchat()
{
    $('#submitchatform').submit();
}
function enterKeyPressed(event , id) {
  if (event.keyCode == 13) {
     submitform(id)
  } 
} 

function submitform(id)
{
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = new FormData(document.getElementById('submitformchat'+id));
    $.ajax({
        type:"POST",
        url:$('#submitformchat'+id).attr('action'),
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data){
            $('#messagevalue'+id).val('');
            $('.image-show'+id).hide();
            $('#imgupload'+id).val('')
            getchatmessages(id)
        },
        error: function(data){
            $('#messagevalue'+id).val('');
            $('.image-show'+id).hide();
            $('#imgupload'+id).val('')
            getchatmessages(id)
        }
    })
}
