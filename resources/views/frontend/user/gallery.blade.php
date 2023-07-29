@extends('frontend.layouts.front-app')
@section('meta-tags')
<title>Gallery | {{ $data->name }}</title>
@endsection

@section('content')
@include('admin.alerts')
<style type="text/css">
    .user-group-photo a {
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 10px;
        margin-right: 10px;
    }
    .user-group-photo a img {
        width: 100%;
        height: 250px;
        object-fit: contain;
        background-size: contain;
        -webkit-animation-name: opacity;
        animation-name: opacity;
        -webkit-animation-duration: .3s;
        animation-duration: .3s;
    }
    .user-group-photo {
        border-radius: 10px;
        height: 300px;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        margin-top: 15px;
        margin-bottom: 15px;
        border: 1px solid #e8636f;
    }
</style>
<div class="container">
    <!-- Banner Area Start -->
    @include('frontend.user.profileheader')
    <div class="block-box user-top-header">
        @if($data->id == Auth::user()->id)
        <ul class="menu-list">
            <li ><a href="{{ url('profile') }}">Timeline</a></li>
            <li ><a href="{{ url('profile/details/about') }}">About</a></li>
            <li  class="active"><a href="{{ url('profile/details/gallery') }}">Photos</a></li>
            <li><a href="{{ url('profile/details/loveplaces') }}">Love Places</a></li>

            <li><a href="{{ url('profile/settings/general') }}">Settings</a></li>
        </ul>
        @else
        <ul class="menu-list">
            <li><a href="{{ url('profile') }}/{{ $data->username }}">Timeline</a></li>
            <li  class="active"><a href="{{ url('profile/details/gallery') }}/{{ $data->username }}">Photos</a></li>
            <li><a href="{{ url('profile/details/loveplaces') }}/{{ $data->username }}">Love Places</a></li>
            <li><a href="{{ url('profile/details/about') }}/{{ $data->username }}">About </a></li>
        </ul>
        @endif
    </div>
    @if(Auth::user()->id == $data->id)
    <div class="row">

        @if(Auth::user()->uploaded_photos >= DB::table('subscriptionplans')->where('id' , Auth::user()->selectplan)->first()->images_allowed)
        <div class="col-md-12">
            <div class="alert alert-danger">You Have Corsed the Limit of images Upload for Your Selected Plan. For Upgrade your Plan Visit This Link <a href="{{ url('profile/settings/subscribe') }}">Click Here</a></div>
        </div>
        

        @else
        <div class="col-md-12 text-right">
            <button data-toggle="modal" data-target="#addnewphoto" class="btn btn-primary">Add Photo</button>
        </div>
        @endif
    </div>
    <!-- Modal -->
    <div id="addnewphoto" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form enctype="multipart/form-data" id="regForm" method="POST" action="{{ url('profile/addgalleryphoto') }}">
                 @csrf
                  <label>Add New Gallary Photo</label>
                  <div class="drop-zone">
                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                    <input accept="image/png, image/jpg, image/jpeg" type="file" name="profileimage" class="drop-zone__input">
                  </div>
                  @if($errors->has('profileimage'))
                    <div style="color: red">{{ $errors->first('profileimage') }}</div>
                @endif
                    <div style="margin-top: 20px;" class="row">
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div> 
                </form>
            </div>
            

        </div>

      </div>
    </div>
    @endif
    <div class="row gutters-20 zoom-gallery">
        @foreach($galery as $r)
        <div class="col-lg-3 col-md-4 col-6">
            <div class="user-group-photo">
                @if(Auth::user()->id == $data->id)
                <div style="background-color: #e8636f;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                <div class="row">
                    <div class="col-md-2 text-left"> 
                        <a style="color:black" class="icofont-trash" href="{{ url('profile/gallery/delete') }}/{{$r->id}}"></a>
                    </div>
                    <div class="col-md-9 text-right">
                        @if($r->type == 'profileimage')
                        <span style="color:black">Profile Image</span>
                        @endif
                        @if($r->type == 'cover')
                        <span style="color:black">Cover Image</span>
                        @endif
                        @if($r->type == 'gallary')
                        <span style="color:black">Gallary Image</span>
                        @endif
                    </div>
                </div>
                </div>
                @endif
                <a href="{{ asset('public/images') }}/{{ $r->images }}" class="popup-zoom">
                    <img class="img-thumbnail" src="{{ asset('public/images') }}/{{ $r->images }}" alt="Gallery">
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script type="text/javascript">
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");
        dropZoneElement.addEventListener("click", (e) => {
            inputElement.click();
        });

      inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
          updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
      });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

  thumbnailElement.dataset.label = file.name;

  // Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    };
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
}

</script>
@endsection