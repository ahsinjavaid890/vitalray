<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\groupmembers;
use App\Models\groupmessages;
use App\Models\groups;
use App\Models\activecatusers;


use Auth;
use DB;
use App\Models\StoreSetting;
class ChatController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }
    public function index(){
        $currentUser=Auth::user();
        $chatUsers=DB::SELECT('WITH ranked_messages AS (
            SELECT m.*,users.name AS username,ROW_NUMBER() OVER (PARTITION BY sendBy ORDER BY id DESC) AS rn
         FROM chat AS m JOIN users ON users.id = m.sendBy
          )
          SELECT * FROM ranked_messages WHERE SendTo = '.$currentUser->id.' GROUP BY sendBy ORDER BY id DESC;');
        foreach($chatUsers as $user){
            $user->unreadMessages=chat::where('sendBy',$user->sendBy)->where('sendTo',$currentUser->id)->where('read',0)->count();
            $user->MessageDate= date("M j, Y, h:m a", strtotime($user->created_at));
        }
        return ['chatUsers'=>$chatUsers,'currentUser'=>$currentUser];
    }
    public function indexSendby(){
        $currentUser=Auth::user();
        $chatUsers=DB::SELECT('WITH ranked_messages AS (
            SELECT m.*,users.name AS username,store_settings.shop_name,store_settings.shop_logo,ROW_NUMBER() OVER (PARTITION BY sendBy ORDER BY id DESC) AS rn
         FROM chat AS m JOIN users ON users.id = m.sendBy  JOIN store_settings ON store_settings.user_id = m.sendTo 
          )
          SELECT * FROM ranked_messages WHERE SendBy = '.$currentUser->id.' GROUP BY sendTo ORDER BY id DESC;');
        foreach($chatUsers as $user){
            $user->unreadMessages=chat::where('sendBy',$user->sendBy)->where('sendTo',$currentUser->id)->where('read',0)->count();
            $user->MessageDate= date("M j, Y, h:m a", strtotime($user->created_at));
        }
        return ['chatUsers'=>$chatUsers,'currentUser'=>$currentUser];
    }
    public function closchat($id)
    {
        activecatusers::where('myid' , Auth::user()->id)->where('user_id' , $id)->where('status' , 'active')->delete();
    }
    public function getChatByUserId($id){
        $currentUser=Auth::user();
        $ids=[$id,$currentUser->id];
        $chat=Chat::select('chat.id','chat.sendTo','users.name as username','chat.message','chat.image','chat.created_at','chat.sendBy')->join('users','users.id','=','chat.sendTo')->whereIn('sendTo',$ids)->whereIn('sendBy',$ids)->get();

        $check = activecatusers::where('myid' , Auth::user()->id)->where('user_id' , $id)->where('status' , 'active')->get();

        if($check->count() > 0)
        {

        }else{
            $test = new activecatusers();
            $test->myid = Auth::user()->id;
            $test->user_id = $id;
            $test->status = 'active';
            $test->save();
            
        }
        Chat::where('sendBy',$id)->update(['read'=>1]);
            $data = user::find($id);
            echo '<div class="chatbox newchatbox'.$id.'">
                    <div class="chatbox-top">
                      <div class="chatbox-avatar">
                        <a target="_blank" href="'.url('profile').'/'.$data->username.'">';
                        if($data->profileimage)
                        {
                            echo '<img  src="'.url('public/images').'/'.$data->profileimage.'" alt="'.$data->name.'">';
                        }

                        elseif($data->profileimage_social)
                        {
                            echo '<img  src="'.$data->profileimage_social.'" alt="'.$data->name.'">';
                            
                        }else{
                            echo '<img  src="'.asset('public/front/media/profileavatar.png').'" alt="'.$data->first_name.'">';
                        }
                        echo '</a>
                      </div>
                      <div class="chat-partner-name">';
                      if($data->online == 1)
                      {
                        echo '<span class="status online"></span>';
                      }

                        


                        echo '<a target="_blank" href="'.url('profile').'/'.$data->username.'">'.$data->name.'</a>
                      </div>
                      <div class="chatbox-icons">
                        <a onclick="minimizechat('.$id.')" href="javascript:void(0);"><i class="fa fa-minus"></i></a>
                        <a onclick="closchat('.$id.')" href="javascript:void(0);"><i class="fa fa-close"></i></a>       
                      </div>      
                    </div>
                    
                    <div class="chat-messages messages'.$id.'">
                         
                    </div>
                    <div style="width: 80px;height: 80px;display: none;" class="image-show'.$id.'">
                        <img id="blah'.$id.'" src="http://127.0.0.1:8000/chat/images/1645931771.jpg">
                    </div>
                    <div style="display:none;" class="emogiebox emogiesbox'.$id.'">
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogie(1,'.$id.')" class="emogie-list">😂</div>
                            <div onclick="addemogie(2,'.$id.')" class="emogie-list">😱</div>
                            <div onclick="addemogie(3,'.$id.')" class="emogie-list">👌</div>
                            <div onclick="addemogie(4,'.$id.')" class="emogie-list">😡</div>
                            <div onclick="addemogie(5,'.$id.')" class="emogie-list">😕</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogie(6,'.$id.')" class="emogie-list">🙊</div>
                            <div onclick="addemogie(7,'.$id.')" class="emogie-list">😭</div>
                            <div onclick="addemogie(8,'.$id.')" class="emogie-list">😋</div>
                            <div onclick="addemogie(9,'.$id.')" class="emogie-list">😐</div>
                            <div onclick="addemogie(10,'.$id.')" class="emogie-list">😝</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogie(11,'.$id.')" class="emogie-list">😀</div>
                            <div onclick="addemogie(12,'.$id.')" class="emogie-list">😌</div>
                            <div onclick="addemogie(13,'.$id.')" class="emogie-list">😚</div>
                            <div onclick="addemogie(14,'.$id.')" class="emogie-list">😅</div>
                            <div onclick="addemogie(15,'.$id.')" class="emogie-list">😞</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogie(16,'.$id.')" class="emogie-list">😢</div>
                            <div onclick="addemogie(17,'.$id.')" class="emogie-list">😃</div>
                            <div onclick="addemogie(18,'.$id.')" class="emogie-list">😉</div>
                            <div onclick="addemogie(19,'.$id.')" class="emogie-list">🙈</div>
                            <div onclick="addemogie(20,'.$id.')" class="emogie-list">😜</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogie(21,'.$id.')" class="emogie-list">😍</div>
                            <div onclick="addemogie(22,'.$id.')" class="emogie-list">😊</div>
                            <div onclick="addemogie(23,'.$id.')" class="emogie-list">😁</div>
                            <div onclick="addemogie(24,'.$id.')" class="emogie-list">👍</div>
                            <div onclick="addemogie(25,'.$id.')" class="emogie-list">😔</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogie(26,'.$id.')" class="emogie-list">👌</div>
                            <div onclick="addemogie(27,'.$id.')" class="emogie-list">😱</div>
                            <div onclick="addemogie(28,'.$id.')" class="emogie-list">😂</div>
                            <div onclick="addemogie(29,'.$id.')" class="emogie-list">🐶</div>
                            <div onclick="addemogie(30,'.$id.')" class="emogie-list">🐺</div>
                        </div>
                        <div class="emoji-items-wrap1">
                            <div onclick="addemogie(31,'.$id.')" class="emogie-list">🐱</div>
                            <div onclick="addemogie(32,'.$id.')" class="emogie-list">🐭</div>
                            <div onclick="addemogie(33,'.$id.')" class="emogie-list">🐹</div>
                            <div onclick="addemogie(34,'.$id.')" class="emogie-list">🐰</div>
                            <div onclick="addemogie(35,'.$id.')" class="emogie-list">🐸</div>
                        </div>
                        
                    </div>
                    <form enctype="multipart/form-data" id="submitformchat'.$id.'" onsubmit="event.preventDefault();" class="needs-validation"  action="'.url('details/save/Chat').'" method="POST">';
                    echo csrf_field();

                    echo '<div class="chat-input-holder">
                      <input onkeypress="return enterKeyPressed(event , '.$id.')" autocomplete="off" type="text" id="messagevalue'.$id.'" name="inputMessage" class="form-control" placeholder="Write your text here.....">
                      <i onclick="submitform('.$id.')" style="color: #fa6541;position: absolute;font-size: 30px;right: 10px;margin-top: 5px;" class="icofont-location-arrow"></i>
                      
                    </div>
                    <input onchange="readURL(this , '.$id.');" type="file" id="imgupload'.$id.'" accept="image/*"/ style="display: none;" name="image">
                    <input type="hidden" value="'.Auth::user()->id.'" name="sendBy">
                    <input type="hidden" id="sendTo" value="'.$id.'" name="sendTo">
                    <div class="attachment-panel">
                    <a onclick="test('.$id.')"><i class="icofont-slightly-smile"></i></a>
                      <a onclick="openImgUpload('.$id.')" class="fa fa-image"></a>
                    </div>
                    </form>
                </div>';
    }
    public function saveMessage(Request $request){
        if($request->inputMessage)
        {
            $obj=new chat;
            $obj->sendBy  =$request->sendBy;
            $obj->sendTo  =$request->sendTo;
            $obj->message = base64_encode($request->inputMessage);
            $obj->read = 0;
            $obj->save();
        }
        
        if($request->hasFile('image')) {
            $image       = $request->file('image');
            $input = time().'.'.$image->extension();
            $image->move('chat/images', $input);
            $obj=new chat;
            $obj->sendBy  =$request->sendBy;
            $obj->sendTo  =$request->sendTo;
            $obj->message = base64_encode($request->inputMessage);
            $obj->image='chat/images/'.$input;
            $obj->read = 0;
            $obj->save();
        }
        
    }

    public function deletemessage($id)
    {
        Chat::where('id',$id)->delete();
    }

    public function messagesfunction($id)
    {
        $currentUser=Auth::user();
        $ids=[$id,$currentUser->id];
        $chat=Chat::select('chat.id','chat.sendTo','users.name as username','chat.message','chat.image','chat.created_at','chat.sendBy')->join('users','users.id','=','chat.sendTo')->whereIn('sendTo',$ids)->whereIn('sendBy',$ids)->orderby('id' , 'asc')->get();
        if(DB::table('activecatusers')->where('myid' , Auth::user()->id)->where('user_id' , $id)->count() > 0)
        {
            Chat::where('sendBy',$id)->update(['read'=>1]);
        }
        $data = user::find($id);
        foreach ($chat as $r) {
            if($currentUser->id == $r->sendTo)
            {
              $user = user::find($r->sendBy);
              echo '<div class="message-box-holder">
                    <div class="message-sender">
                      <a href="#">'.$user->name.'</a>
                     </div>
                    <div class="message-box message-partner">';

                        if($r->image)
                        {
                            echo '<div style="height:200px;width:200px;" class="chat-image"><img style="max-width: 100%;max-height: 100%;" src="'.asset('').''.$r->image.'" ></div>
                            <p>'.base64_decode($r->message).'</p>

                            ';
                        }else{
                            echo base64_decode($r->message);
                        }
                      
                    echo '</div>
                  </div>';

            }else{
              $user = Auth::user();
              echo '<div class="message-box-holder">

                    <div style="display:flex;"> 

                   
                    <div style="background-color:white;padding:0px;" id="editdots75" class="cmnt_text">
                    
                    <div class="commentedit">
                        <div class="dropdown dropdown-admin">
                        <button class="dropdown-toggle comment-dropdown" type="button" data-toggle="dropdown" aria-expanded="false">
                            ...
                        </button>
                        <div class="dropdown-menu comment-dropdown-menue dropdown-menu-right">
                            <ul class="admin-options">
                                <li><a onclick="deletemessage('.$r->id.' , '.$id.')" href="javascript:void(0)"><i class="icofont-ui-delete"></i>Delete</a></li></ul>
                        </div>
                      
                    </div>


                    </div>                 
                </div>
                         <div class="message-box">';

                        if($r->image)
                        {
                            echo '<div style="height:200px;width:200px;" class="chat-image"><img style="max-width: 100%;max-height: 100%;" src="'.asset('').''.$r->image.'" ></div>
                            <p>'.base64_decode($r->message).'</p>

                            ';
                        }else{
                            echo base64_decode($r->message);
                        }
                      
                    echo '

                    </div>

                    </div>
                  </div>';
            }
        }        
    }
    public function checkmessage()
    {
        $id = Auth::user()->id;
        $count =  Chat::where('sendTo' , $id)->where('read' , 0)->count();
        $chatUsers = Chat::where('sendTo' , $id)->where('read' , 0)->groupby('sendBy')->get();
        return response()->json(['count' => $count,'chatUsers' => $chatUsers]);
    }
    public function getChatUserById($id){
         $chat=StoreSetting::Select('shop_name','shop_logo','user_id as sendTo','users.name AS username')->join('users','users.id','=','store_settings.user_id')->Where('user_id',$id)->first();
         $chat->sendBy=(int)$id;

        return ['chat'=>$chat];
    }

    

    public function checkchatroommessage()
    {
        $id = Auth::user()->id;
        $count =  Chat::where('sendTo' , $id)->where('read' , 0)->count();
        echo $count;
    }

    public function getchatroommessages($username)
    {
        $id = user::where('username' , $username)->get()->first()->id;
        $currentUser=Auth::user();
        $ids=[$id,$currentUser->id];
        $chat=Chat::select('chat.id','chat.sendTo','users.name as username','chat.message','chat.image','chat.created_at','chat.sendBy')->join('users','users.id','=','chat.sendTo')->whereIn('sendTo',$ids)->whereIn('sendBy',$ids)->get();
        Chat::where('sendBy',$id)->update(['read'=>1]);
        foreach($chat as $r)
        {
             if($currentUser->id == $r->sendTo)
             {
              $user = user::find($r->sendBy);
              echo '<div class="d-flex justify-content-start mb-4">
                <div class="img_cont_msg">';
                    if($user->profileimage)
                    {
                        echo '<img class="rounded-circle user_img_msg" src="'.url('public/images').'/'.$user->profileimage.'" alt="'.$user->name.'">';
                    }

                    elseif($user->profileimage_social)
                    {
                        echo '<img class="rounded-circle user_img_msg" src="'.$user->profileimage_social.'" alt="'.$user->first_name.'">';
                        
                    }else{
                        echo '<img class="rounded-circle user_img_msg" src="'.asset('public/front/media/profileavatar.png').'" alt="'.$user->name.'">';
                    }
                echo '</div>
                <div class="msg_cotainer">

                <p style="margin:0px;">'.$user->name.'</p><hr>';

                    if($r->image)
                    {
                        echo '<div class="meessage_image"><img style="max-width: 100%;max-height: 100%;" src="'.asset('').''.$r->image.'"></div>
                        <p>'.base64_decode($r->message).'</p>';
                    }else{
                        echo base64_decode($r->message);
                    }
                    
                    echo '<span class="msg_time">'.$r->created_at->diffForHumans().'</span>
                </div>
            </div>';

             }else{
              
              $user = Auth::user();
              echo '<div class="d-flex justify-content-end mb-4">
                <div class="msg_cotainer_send">
                <p style="margin:0px;">'.$user->name.'</p><hr>';

                    if($r->image)
                    {
                        echo '<div class="meessage_image"><img style="max-width: 100%;max-height: 100%;" src="'.asset('').''.$r->image.'"></div>
                        <p>'.base64_decode($r->message).'</p>';
                    }else{
                        echo base64_decode($r->message);
                    }
                    
                    echo '<span class="msg_time_send">'.$r->created_at->diffForHumans().'</span>
                </div>
                <div class="img_cont_msg">';
                    if($user->profileimage)
                    {
                        echo '<img class="rounded-circle user_img_msg" src="'.url('public/images').'/'.$user->profileimage.'" alt="'.$user->name.'">';
                    }

                    elseif($user->profileimage_social)
                    {
                        echo '<img class="rounded-circle user_img_msg" src="'.$user->profileimage_social.'" alt="'.$user->name.'">';
                        
                    }else{
                        echo '<img class="rounded-circle user_img_msg" src="'.asset('public/front/media/profileavatar.png').'" alt="'.$user->name.'">';
                    }
                echo '</div>
            </div>';
             }
            
        }
    }


    public function savechatroomMessage(Request $request)
    {
        $obj=new chat;
        $obj->sendBy  =$request->sendBy;
        $obj->sendTo  =$request->sendTo;
        $obj->message = base64_encode($request->message);
        $obj->read = 0;
        if($request->hasFile('file')) {
            $image       = $request->file('file');
            $input = time().'.'.$image->extension();
            $image->move('chat/images', $input);
            $obj->image='chat/images/'.$input;
        }
        $obj->save();
        $currentUser=Auth::user();
        $ids=[$request->sendTo,$currentUser->id];

        $username = user::where('id' , $request->sendTo)->get()->first()->username;


        $this->getchatroommessages($username);
    }



    public function getMessageById($id){
        $chat=Chat::select('users.name as username','chat.message','chat.image','chat.created_at','chat.sendBy')->join('users','users.id','=','chat.sendBy')->where('chat.id',$id)->first();
        $chat->MessageDate= date("M j, Y, h:m a", strtotime($chat->created_at));
        return ['message'=>$chat];
    }
    public function messageread($id){
        Chat::where('id',$id)->update(['read'=>1]);
       return ['message'=>'success'];
    }
}
