<!-- overlay -->
    <div id="sidebar-overlay" class="overlay w-100 vh-100 position-fixed d-none"></div>

    <!-- sidebar -->
    <div class="col-md-3 col-lg-2 px-0 position-fixed shadow-sm sidebar" id="sidebar">
      <h1 class="bi bi-bootstrap text-primary d-flex justify-content-center">
        <img class="d-flex mt-2 justify-content-center" src="{{ asset('public/front/media/logo.png') }}"
                    style="width: 105px;" alt="logo">
      </h1>
      <div class="list-group rounded-0">
        <small style="padding:10px 25px; opacity: 0.5;">Menu</small>
        <a href="{{ url('dashboard/') }}" class="list-group-item list-group-item-action active border-0 d-flex align-items-center">
          <span class="bi bi-border-all"></span>
          <span class="ml-2"> <img src="{{ asset('public/front/media/home-icon.svg') }}" class="me-2" alt="Home"> Home</span>
        </a>
        <a href="{{ url('profile/frequencies') }}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-box"></span>
          <span class="ml-2"><img src="{{ asset('public/front/media/frequencies-list-icon.svg') }}" class="me-2" alt="Home"> Frequencies List</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-box"></span>
          <span class="ml-2"><img src="{{ asset('public/front/media/create-frequency-icon.svg') }}" class="me-2" alt="Home"> Create Frequency</span>
        </a>
        <a href="{{ url('profile') }}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-box"></span>
          <span class="ml-2"><img src="{{ asset('public/front/media/settings-icon.svg') }}" class="me-2" alt="Home"> Settings</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action border-0 align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        	<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
			    {{ csrf_field() }}
			</form>
          <span class="bi bi-box"></span>
          <span class="ml-2"><img src="{{ asset('public/front/media/logout.svg') }}" class="me-2" alt="Home"> Logout</span>
        </a>

        <a href="#" class=" border-0 align-items-center">
          <hr>
        </a>
        <small style="padding:10px 25px; opacity: 0.5;">Other Links</small>
        @foreach(DB::table('dynamicpages')->where('visible_status' , 'Published')->get() as $r)
			<a href="{{ url('page') }}/{{ $r->slug }}" class="list-group-item list-group-item-action border-0 align-items-center">
	          <span class="ml-2">{{ $r->name }}</span>
	        </a>
		@endforeach
        
      </div>
    </div>