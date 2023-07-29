@extends('layouts.vendor-app')
@section('title')
<title>My Profile</title>
<meta name="DC.Title" content="Dashboard">
<meta name="rating" content="general">
<meta name="description" content="Dashboard">
@section('content')
<!--Dashboard breadcrumb starts-->
<div class="dash-breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="dash-breadcrumb-content">
                    <div class="dash-breadcrumb-left">
                        <div class="breadcrumb-menu text-right sm-left">
                            <ul>
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#">Dashboard</a></li>
                                <li>My Profile</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard breadcrumb ends-->
<!--Dashboard content starts-->
<div class="dash-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="db-add-list-wrap">
                    <div class="act-title">
                        <h5><i class="ion-ios-location"></i> Location/Contacts</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select City</label>
                                    <div class="nice-select filter-input" tabindex="0"><span class="current">Select City</span>
                                        <ul class="list">
                                            <li class="option selected focus">New York</li>
                                            <li class="option">Chicago</li>
                                            <li class="option">Las Vegas</li>
                                            <li class="option">Los Angeles</li>
                                            <li class="option">Austin</li>
                                            <li class="option">Downturn</li>
                                            <li class="option">DownturnSan Diago</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control filter-input" placeholder="ex. 250, Fifth Avenue...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" class="form-control filter-input" placeholder="ex. New York">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" class="form-control filter-input" placeholder="ex. 5858">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Longitude (Drag marker on the map)</label>
                                    <input type="text" class="form-control filter-input" placeholder="Map Longitude">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Latitude (Drag marker on the map) </label>
                                    <input type="text" class="form-control filter-input" placeholder="Map Latitude">
                                </div>
                            </div>
                            <div class="col-md-12 no-padding">
                                <div id="map"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mar-top-15">
                                    <label>Website </label>
                                    <input type="text" class="form-control filter-input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mar-top-15">
                                    <label>Phone </label>
                                    <input type="text" class="form-control filter-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="db-add-list-wrap">
                    <div class="act-title">
                        <h5>Stay information</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Describe here</label>
                                    <textarea class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="db-add-list-wrap">
                    <div class="act-title">
                        <h5>Things to know</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Cancellation policy</label>
                                    <textarea class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Special Note</label>
                                    <textarea class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Check-in time</h4><hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input type="time" class="form-control" name="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input type="time" class="form-control" name="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4>Check-out time</h4><hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input type="time" class="form-control" name="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input type="time" class="form-control" name="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                        
                    </div>
                </div>


                <!-- Opening Hours -->


                <div class="db-add-list-wrap">
                    <div class="act-title">
                        <h5><i class="ion-clock"></i> Opening/Business Hours</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="row mar-bot-30">
                            <div class="col-md-2">
                                <label class="fix_spacing">Monday</label>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Opening Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Closing Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row mar-bot-30">
                            <div class="col-md-2">
                                <label class="fix_spacing">Tuesday</label>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Opening Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Closing Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="row mar-bot-30">
                            <div class="col-md-2">
                                <label class="fix_spacing">Wednesday</label>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Opening Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Closing Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="row mar-bot-30">
                            <div class="col-md-2">
                                <label class="fix_spacing">Thursday</label>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Opening Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Closing Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="row mar-bot-30">
                            <div class="col-md-2">
                                <label class="fix_spacing">Friday</label>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Opening Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Closing Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="row mar-bot-30">
                            <div class="col-md-2">
                                <label class="fix_spacing">Saturday</label>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Opening Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Closing Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="row mar-bot-30">
                            <div class="col-md-2">
                                <label class="fix_spacing">Sunday</label>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Opening Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="nice-select filter-input" tabindex="0"><span class="current">Closing Time</span>
                                    <ul class="list">
                                        <li class="option selected focus">7.00 am</li>
                                        <li class="option">8.00 am</li>
                                        <li class="option">9.00 am</li>
                                        <li class="option">10.00 am</li>
                                        <li class="option">11.00 am</li>
                                        <li class="option">12.00 am</li>
                                        <li class="option">1.00 pm</li>
                                        <li class="option">2.00 pm</li>
                                        <li class="option">3.00 pm</li>
                                        <li class="option">4.00 pm</li>
                                        <li class="option">5.00 pm</li>
                                        <li class="option">6.00 pm</li>
                                        <li class="option">7.00 pm</li>
                                        <li class="option">8.00 pm</li>
                                        <li class="option">9.00 pm</li>
                                        <li class="option">10.00 pm</li>
                                        <li class="option">11.00 pm</li>
                                        <li class="option">12.00 pm</li>
                                        <li class="option">00.00 am</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="db-add-list-wrap">
                    <div class="act-title">
                        <h5>Location</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    use Map here to pickup
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="db-add-list-wrap">
                    <div class="act-title">
                        <h5>Bank Account Detail</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account Title</label>
                                    <input type="text" class="form-control filter-input" placeholder="ex. 250, Fifth Avenue...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" class="form-control filter-input" placeholder="ex. 250, Fifth Avenue...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" class="form-control filter-input" placeholder="ex. 250, Fifth Avenue...">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IBAN</label>
                                    <input type="text" class="form-control filter-input" placeholder="ex. 250, Fifth Avenue...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-12 text-right">
                        <button class="btn v8" type="submit">Save Now</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--Dashboard content ends-->
@endsection
