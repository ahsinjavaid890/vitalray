<ul>
@foreach($childs as $child)
   <li>
      <div style="margin-top: 10px;" class="row">
         <div class="col-md-10">
            {{ $child->title }}
         </div>
         <div class="col-md-2">
            <i onclick="updatemenu({{$child->id}})" class="mdi mdi-square-edit-outline btn btn-success btn-sm"></i>
         </div>
      </div>
       
        @if(count($child->childs))
            @include('admin.menu.manageChild',['childs' => $child->childs])
        @endif
   </li>
@endforeach
</ul>