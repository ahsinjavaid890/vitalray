@extends('auth.authlayout')
@section('title')
<title>Sign Up | Step 4</title>
@endsection
@section('content')

<!-- <div id="preloader"></div> -->
    <div id="wrapper" class="wrapper overflow-hidden">
        <div class="login-page-wrap">
    <div class="content-wrap">
        <div style="width:600px;" class="login-content">
            <div class="item-logo">
                <a href="{{ url('') }}"><img src="{{ asset('public/images/') }}/{{ Cmf::get_store_value('footer_logo') }}" alt="logo" width="220px"></a>
            </div>
            <div class="login-form-wrap">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ url('signin') }}"><i class="icofont-users-alt-4"></i> Sign In </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active"  href="{{ url('signup') }}"><i class="icofont-download"></i> Registration</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <h3 class="item-title">Profile pictures</h3>
                    <h5>Step 4 Out of 6 Steps</h5>
                    <form enctype="multipart/form-data" id="regForm" method="POST" action="{{ route('user.registerfour') }}">
                     @csrf
                      <label>Profile Image</label>
                      <div class="drop-zone">
                        @if(Cmf::get_uservalue('profileimage'))
                        <span class="drop-zone__prompt">For Change Profile Pic Drop file here or click to upload</span>
                        @else
                        <span class="drop-zone__prompt">Drop file here or click to upload</span>
                        @endif
                        <input accept="image/png, image/jpg, image/jpeg" type="file" name="profileimage" class="drop-zone__input">
                        @if(Cmf::get_uservalue('profileimage')) 
                            <div class="drop-zone__thumb" style="background-image: url('{{ url('') }}/public/images/{{ Cmf::get_uservalue('profileimage') }} ');"></div>
                        @endif 
                      </div>
                      @if($errors->has('profileimage'))
                        <div style="color: red">{{ $errors->first('profileimage') }}</div>
                    @endif
                        <div style="color: red;display: none;" id="imagevalidationerror">Please Select Image Less then 1MB For Compress Use this <a href="https://compressjpeg.com/" target="_blank">Compress Image</a></div>
                        <div style="margin-top: 20px;" class="row">
                            <div class="col-lg-6 text-left">
                                <a  href="{{ route('user.stepthree') }}" class="btn btn-primary">Back</a>
                            </div>
                            <div class="col-lg-6 text-right">
                                <button id="nextbutton" type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
        <div class="map-line">
            <img src="{{ asset('public/front/media/banner/map_line2.png') }}" alt="map">
            <ul class="map-marker">
                <li><img src="{{ asset('public/front/media/banner/marker_1.png') }}" alt="marker"></li>
                <li><img src="{{ asset('public/front/media/banner/marker_2.png') }}" alt="marker"></li>
                <li><img src="{{ asset('public/front/media/banner/marker_3.png') }}" alt="marker"></li>
                <li><img src="{{ asset('public/front/media/banner/marker_4.png') }}" alt="marker"></li>
            </ul>
        </div>
    </div>
</div>

    </div>
<style type="text/css">


</style>
<script type="text/javascript">

    $('.drop-zone__input').bind('change', function() {
        var a=(this.files[0].size);
        if(a > 1000000) {
            $('#imagevalidationerror').show();
            $('#nextbutton').prop('disabled', true);
        }else{
            $('#imagevalidationerror').hide();
            $('#nextbutton').prop('disabled', false);
        }
    });



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