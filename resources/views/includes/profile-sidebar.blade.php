<div class="col-md-3">
                  <div class="card pb-3">
                    <div class="card-body p-0">
                      <div class="profile-pic text-center p-2">
                        @if(Auth::user()->profileimage)
                          <img src="{{ url('public/images') }}/{{ Auth::user()->profileimage }}" class="img-profile" alt="...">
                          @else
                          <img src="https://cdn1.vectorstock.com/i/1000x1000/26/40/profile-placeholder-image-gray-silhouette-vector-22122640.jpg" class="img-profile" alt="...">
                          @endif
                      </div>

                      <div class="row user-info">
                        <div class="col-md-12 text-center">
                          <h3>Lucky Parker</h3>
                          <p>@lucky2098</p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 text-center">

                          <ul class="nav nav-tabs mt-3 d-flex flex-row" style="width:100%">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="{{ url('profile/settings') }}">
                                <img src="{{ asset('public/front/media/user-avatar.svg') }}" alt="Personal Info"> Personal Information
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="{{ url('profile/changepassword') }}">
                                <img src="{{ asset('public/front/media/change-password.svg') }}" alt="Change Password"> Change Password
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="{{ url('profile/plans') }}">
                                <img src="{{ asset('public/front/media/subscription-plan.svg') }}" alt="Subscription Plans"> Subscription Plans
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tickets">
                                <img src="{{ asset('public/front/media/ticket.svg') }}" alt="Tickets"> Tickets
                              </a>
                            </li>
                          </ul>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>