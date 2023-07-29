@extends('layouts.vendor-app')
@section('title')
<title>Add Listing</title>
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
                                <li>Add Listing</li>
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
                        <h5><i class="ion-ios-information"></i> General Information</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Listing Title</label>
                                    <input type="text" class="form-control filter-input" placeholder="Hotel Ocean paradise">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Room Type</label>
                                    <select class="form-control">
                                        <option>Single Room </option>
                                        <option>Double Room</option>
                                        <option>Deluxe Double Room</option>
                                        <option>Twin Room</option>
                                        <option>Twin Deluxe</option>
                                        <option>Suite</option>
                                        <option>Villa</option>
                                        <option>One Bedroom Villa</option>
                                        <option>Two-Bedroom Villa</option>
                                        <option>Junior</option>
                                        <option>Junior Suite</option>
                                        <option>Twin Room with Balcony</option>
                                        <option>Double Room with Balcony</option>
                                        <option>Twin Room with Pool View</option>
                                        <option>Twin Room with Garden View</option>
                                        <option>Twin Room with Beach View</option>
                                        <option>Twin Room with City View</option>
                                        <option>Double Room with Beach View</option>
                                        <option>Double Room with Pool View</option>
                                        <option>Double Room with City View</option>
                                        <option>Double Room with Garden View</option>
                                        <option>Tripe Room</option>
                                        <option>Triple Room with Beach View</option>
                                        <option>Triple Room with Pool View</option>
                                        <option>Triple Room with City View</option>
                                        <option>Triple Room with Garden View</option>
                                        <option>Executive Room</option>
                                        <option>Beach Villa with Private Pool</option>
                                        <option>Deluxe Beach Villa with Private Pool</option>
                                        <option>Family Room</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keywords</label>
                                    <input type="text" class="form-control filter-input" placeholder="Keywords should be separated by commas">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control filter-input" placeholder="Address of your hotel">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form>
                                    <div class="form-group">
                                        <label for="list_info">Description</label>
                                        <textarea class="form-control" id="list_info" rows="4" placeholder="Enter your text here"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="db-add-list-wrap">
                    <div class="act-title">
                        <h5><i class="ion-image"></i> Gallery</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="form-group">
                            <form class="photo-upload">
                                <div class="form-group">
                                    <div class="add-listing__input-file-box">
                                        <input class="add-listing__input-file" type="file" name="file" id="file">
                                        <div class="add-listing__input-file-wrap">
                                            <i class="ion-ios-cloud-upload"></i>
                                            <p>Click here to upload your images</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="add-btn">
                            <a href="#" class="btn v8 mar-top-20">Add Images</a>
                        </div>
                    </div>

                </div>
                <div class="db-add-list-wrap">
                    <div class="act-title">
                        <h5>Amenities</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">A:</h3></label>
                                    <div class="filter-checkbox">
                                        <input id="check-a" type="checkbox" name="check">
                                        <label for="check-a">Air conditioning</label>
                                        
                                        <input id="check-b" type="checkbox" name="check">
                                        <label for="check-b">Airport shuttle</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">B:</h3></label>
                                    <div class="filter-checkbox">
                                        <input id="bar" type="checkbox" name="check">
                                        <label for="bar">Bar</label>
                                        
                                        <input id="pool-bar" type="checkbox" name="check">
                                        <label for="pool-bar">Pool Bar</label>

                                        <input id="beach-bar" type="checkbox" name="check">
                                        <label for="beach-bar">Beach Bar</label>

                                        <input id="breakfast-included" type="checkbox" name="check">
                                        <label for="breakfast-included">Breakfast Included</label>

                                        <input id="breakfast-extra-cost" type="checkbox" name="check">
                                        <label for="breakfast-extra-cost">Breakfast extra cost</label>

                                        <input id="bidet" type="checkbox" name="check">
                                        <label for="bidet">Bidet</label>

                                        <input id="bath-or-shower" type="checkbox" name="check">
                                        <label for="bath-or-shower">Bath or Shower</label>

                                        <input id="Bath-Board-Games-Puzzles" type="checkbox" name="check">
                                        <label for="Bath-Board-Games-Puzzles">Bath, Board Games/Puzzles</label>

                                        <input id="business-centre" type="checkbox" name="check">
                                        <label for="business-centre">Business Centre</label>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">C:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Coffee/Teamaker in all rooms" type="checkbox" name="check">
                                        <label for="Coffee/Teamaker in all rooms">Coffee/Teamaker in all rooms</label>

                                        <input id="Clothes Rack" type="checkbox" name="check">
                                        <label for="Clothes Rack">Clothes Rack</label>

                                        <input id="Carpeted" type="checkbox" name="check">
                                        <label for="Carpeted">Carpeted</label>

                                        <input id="City View" type="checkbox" name="check">
                                        <label for="City View">City View</label>

                                        <input id="Children’s highchair" type="checkbox" name="check">
                                        <label for="Children’s highchair">Children’s highchair</label>

                                        <input id="Changing Room" type="checkbox" name="check">
                                        <label for="Changing Room">Changing Room</label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">D:</h3></label>

                                    <div class="filter-checkbox">
                                        <input id="Dental kit" type="checkbox" name="check">
                                        <label for="Dental kit">Dental kit</label>

                                        <input id="Desk" type="checkbox" name="check">
                                        <label for="Desk">Desk</label>

                                        <input id="Drying Rack for Clothes" type="checkbox" name="check">
                                        <label for="Drying Rack for Clothes">Drying Rack for Clothes</label>

                                        <input id="Disabled Friendly" type="checkbox" name="check">
                                        <label for="Disabled Friendly">Disabled Friendly</label>

                                        <input id="Disabled Ramps" type="checkbox" name="check">
                                        <label for="Disabled Ramps">Disabled Ramps</label>

                                        <input id="Disabled Parking Space" type="checkbox" name="check">
                                        <label for="Disabled Parking Space">Disabled Parking Space</label>

                                        <input id="Dishwasher" type="checkbox" name="check">
                                        <label for="Dishwasher">Dishwasher</label>

                                        <input id="Dry machine" type="checkbox" name="check">
                                        <label for="Dry machine">Dry machine</label>

                                        <input id="DVD Player" type="checkbox" name="check">
                                        <label for="DVD Player">DVD Player</label>

                                        <input id="Dressing Room" type="checkbox" name="check">
                                        <label for="Dressing Room">Dressing Room</label>

                                        <input id="Dog-sledding" type="checkbox" name="check">
                                        <label for="Dog-sledding">Dog-sledding</label>
                                        

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">E:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Ensuite Bathroom" type="checkbox" name="check">
                                        <label for="Ensuite Bathroom">Ensuite Bathroom</label>

                                        <input id="Entire unit located on the ground floor" type="checkbox" name="check">
                                        <label for="Entire unit located on the ground floor">Entire unit located on the ground floor</label>

                                        <input id="Extra long beds (> 2 metres)" type="checkbox" name="check">
                                        <label for="Extra long beds (> 2 metres)">Extra long beds (> 2 metres)</label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">F:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Fan" type="checkbox" name="check">
                                        <label for="Fan">Fan</label>

                                        <input id="Fold-up Bed" type="checkbox" name="check">
                                        <label for="Fold-up Bed">Fold-up Bed</label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">H:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Gym" type="checkbox" name="check">
                                        <label for="Gym">Gym</label>

                                        <input id="Garden" type="checkbox" name="check">
                                        <label for="Garden">Garden</label>

                                        <input id="Garden View" type="checkbox" name="check">
                                        <label for="Garden View">Garden View</label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">H:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Hairdryer" type="checkbox" name="check">
                                         <label for="Hairdryer">Hairdryer</label>

                                         <input id="Hand Sanitiser" type="checkbox" name="check">
                                         <label for="Hand Sanitiser">Hand Sanitiser</label>

                                         <input id="Heated Outdoor Pool" type="checkbox" name="check">
                                         <label for="Heated Outdoor Pool">Heated Outdoor Pool</label>

                                         <input id="Heated Indoor Pool" type="checkbox" name="check">
                                         <label for="Heated Indoor Pool">Heated Indoor Pool</label>

                                         <input id="Heating" type="checkbox" name="check">
                                         <label for="Heating">Heating</label>

                                         <input id="Hardwood or parquet floors" type="checkbox" name="check">
                                         <label for="Hardwood or parquet floors">Hardwood or parquet floors</label>

                                         <input id="Hot Tube" type="checkbox" name="check">
                                         <label for="Hot Tube">Hot Tube</label>

                                         <input id="Horse-drawn sleds" type="checkbox" name="check">
                                         <label for="Horse-drawn sleds">Horse-drawn sleds</label>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">I:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Iron" type="checkbox" name="check">
                                        <label for="Iron">Iron</label>

                                        <input id="Iron board" type="checkbox" name="check">
                                        <label for="Iron board">Iron board</label>

                                        <input id="iPod dock" type="checkbox" name="check">
                                        <label for="iPod dock">iPod dock</label>

                                        <input id="Indoor Pool" type="checkbox" name="check">
                                        <label for="Indoor Pool">Indoor Pool</label>

                                        <input id="Inner Courtyard View" type="checkbox" name="check">
                                        <label for="Inner Courtyard View">Inner Courtyard View</label>

                                        <input id="Interconnected Room(s ) Available" type="checkbox" name="check">
                                        <label for="Interconnected Room(s ) Available">Interconnected Room(s ) Available</label>

                                        <input id="Ice-skating" type="checkbox" name="check">
                                        <label for="Ice-skating">Ice-skating</label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">K:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Kettle" type="checkbox" name="check">
                                        <label for="Kettle">Kettle</label>

                                        <input id="Kitchen" type="checkbox" name="check">
                                        <label for="Kitchen">Kitchen</label>

                                        <input id="Kitchenette" type="checkbox" name="check">
                                        <label for="Kitchenette">Kitchenette</label>

                                        <input id="Kid’s Club" type="checkbox" name="check">
                                        <label for="Kid’s Club">Kid’s Club</label>

                                        <input id="Kid Friendly" type="checkbox" name="check">
                                        <label for="Kid Friendly"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">L:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id=" Luggage Room" type="checkbox" name="check">
                                        <label for=" Luggage Room"> Luggage Room</label>

                                        <input id="Laptop Safe" type="checkbox" name="check">
                                        <label for="Laptop Safe">Laptop Safe</label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">M:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Minibar" type="checkbox" name="check">
                                        <label for="Minibar">Minibar</label>

                                        <input id="Mosquito Net" type="checkbox" name="check">
                                        <label for="Mosquito Net">Mosquito Net</label>

                                        <input id="Microwave" type="checkbox" name="check">
                                        <label for="Microwave">Microwave</label>

                                        <input id="Mountain View" type="checkbox" name="check">
                                        <label for="Mountain View">Mountain View</label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">N:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Non-smoking rooms" type="checkbox" name="check">
                                        <label for="Non-smoking rooms">Non-smoking rooms</label>

                                        <input id="Nanny Service" type="checkbox" name="check">
                                        <label for="Nanny Service">Nanny Service</label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">O:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="Outdoor Pool" type="checkbox" name="check">
                                        <label for="Outdoor Pool">Outdoor Pool</label>

                                        <input id="Outdoor Furniture" type="checkbox" name="check">
                                        <label for="Outdoor Furniture">Outdoor Furniture</label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">P:</h3></label>
                                    <div class="filter-checkbox">
                                        <input id="Parking extra" type="checkbox" name="check">
                                        <label for="Parking extra">Parking extra</label>

                                        <input id="Parking included" type="checkbox" name="check">
                                        <label for="Parking included">Parking included</label>

                                        <input id="Paper Roll" type="checkbox" name="check">
                                        <label for="Paper Roll">Paper Roll</label>

                                        <input id="Private Entrance" type="checkbox" name="check">
                                        <label for="Private Entrance">Private Entrance</label>

                                        <input id="Private Suite" type="checkbox" name="check">
                                        <label for="Private Suite">Private Suite</label>

                                        <input id="Private Apartment in Building" type="checkbox" name="check">
                                        <label for="Private Apartment in Building">Private Apartment in Building</label>


                                        <input id="Private Beach Area" type="checkbox" name="check">
                                        <label for="Private Beach Area">Private Beach Area</label>

                                        <input id="Pet Friendly" type="checkbox" name="check">
                                        <label for="Pet Friendly">Pet Friendly</label>


                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">R:</h3></label>
                                    <div class="filter-checkbox">
                                        <input id="Restaurant" type="checkbox" name="check">
                                        <label for="Restaurant">Restaurant</label>

                                        <input id="Room Service" type="checkbox" name="check">
                                        <label for="Room Service">Room Service</label>

                                        <input id="Radio " type="checkbox" name="check">
                                        <label for="Radio ">Radio </label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">S:</h3></label>
                                    <div class="filter-checkbox">
                                        <input id="Seating Area" type="checkbox" name="check">
                                        <label for="Seating Area">Seating Area</label>

                                        <input id="Shower" type="checkbox" name="check">
                                        <label for="Shower">Shower</label>

                                        <input id="Satellite Channel" type="checkbox" name="check">
                                        <label for="Satellite Channel">Satellite Channel</label>

                                        <input id="Sea View" type="checkbox" name="check">
                                        <label for="Sea View">Sea View</label>

                                        <input id="Sauna" type="checkbox" name="check">
                                        <label for="Sauna">Sauna</label>

                                        <input id="Steam room" type="checkbox" name="check">
                                        <label for="Steam room">Steam room</label>

                                        <input id="Sofa Bed" type="checkbox" name="check">
                                        <label for="Sofa Bed">Sofa Bed</label>

                                        <input id="Soundproofing" type="checkbox" name="check">
                                        <label for="Soundproofing">Soundproofing</label>

                                        <input id="Shared Bathroom" type="checkbox" name="check">
                                        <label for="Shared Bathroom">Shared Bathroom</label>

                                        <input id="Solarium" type="checkbox" name="check">
                                        <label for="Solarium">Solarium</label>

                                        <input id="Streaming service (like Netflix)" type="checkbox" name="check">
                                        <label for="Streaming service (like Netflix)">Streaming service (like Netflix)</label>

                                        <input id="Ski Shoes Room" type="checkbox" name="check">
                                        <label for="Ski Shoes Room">Ski Shoes Room</label>

                                        <input id="Sledding" type="checkbox" name="check">
                                        <label for="Sledding">Sledding</label>

                                        <input id="Snowmobiling" type="checkbox" name="check">
                                        <label for="Snowmobiling">Snowmobiling</label>

                                        <input id="Ski-School" type="checkbox" name="check">
                                        <label for="Ski-School">Ski-School</label>

                                        <input id="Smoking rooms" type="checkbox" name="check">
                                        <label for="Smoking rooms">Smoking rooms</label>

                                        <input id="Spa, Slippers" type="checkbox" name="check">
                                        <label for="Spa, Slippers">Spa, Slippers</label>

                                        <input id="Spa" type="checkbox" name="check">
                                        <label for="Spa">Spa</label>

                                        <input id="Slippers" type="checkbox" name="check">
                                        <label for="Slippers">Slippers</label>

                                        <input id="Safety Deposit Box (Included)" type="checkbox" name="check">
                                        <label for="Safety Deposit Box (Included)">Safety Deposit Box (Included)</label>

                                        <input id="Safety Deposit Box (Extra)" type="checkbox" name="check">
                                        <label for="Safety Deposit Box (Extra)">Safety Deposit Box (Extra)</label>

                                        <input id="Socket near the bed" type="checkbox" name="check">
                                        <label for="Socket near the bed">Socket near the bed</label>

                                        <input id="Sofa" type="checkbox" name="check">
                                        <label for="Sofa">Sofa</label>


                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">T:</h3></label>
                                    <div class="filter-checkbox">

                                        <input id="" type="checkbox" name="check">
                                        <label for="">TV</label>

                                        <input id="" type="checkbox" name="check">
                                        <label for="">Towels and Linen (Included)</label>

                                        <input id="" type="checkbox" name="check">
                                        <label for="">Towels and Linen(extra paid)</label>

                                        <input id="" type="checkbox" name="check">
                                        <label for="">Toiletries (Included)</label>

                                        <input id="" type="checkbox" name="check">
                                        <label for="">Toiletries (Extra)</label>

                                        <input id="" type="checkbox" name="check">
                                        <label for="">Telephone</label>

                                        <input id="" type="checkbox" name="check">
                                        <label for="">Terrace</label>

                                        <input id="" type="checkbox" name="check">
                                        <label for="">Tile/Marble Floor</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">U:</h3></label>
                                    <div class="filter-checkbox">
                                        <input id="" type="checkbox" name="check">
                                        <label for="">Upper Floors accessible by elevator (lift) </label>

                                        <input id="" type="checkbox" name="check">
                                        <label for="">USB Ports</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label><h3 class="mb-0">W:</h3></label>
                                    <div class="filter-checkbox">
                                        <input id="Wake-up Call" type="checkbox" name="check">
                                        <label for="Wake-up Call">Wake-up Call</label>

                                        <input id="Wi-Fi (Included)" type="checkbox" name="check">
                                        <label for="Wi-Fi (Included)">Wi-Fi (Included)</label>

                                        <input id="Wi-Fi (Extra)" type="checkbox" name="check">
                                        <label for="Wi-Fi (Extra)">Wi-Fi (Extra)</label>

                                        <input id="Wi-Fi available in all area" type="checkbox" name="check">
                                        <label for="Wi-Fi available in all area">Wi-Fi available in all area</label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="db-add-list-wrap">
                    <div class="act-title">
                        <h5><i class="ion-ios-location"></i> Rooms/Pricing</h5>
                    </div>
                    <div class="db-add-listing">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Room Title</label>
                                    <input type="text" class="form-control filter-input" placeholder="Standard family Room">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Capacity</label>
                                    <input type="text" class="form-control filter-input" placeholder="2 persons">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price / Person</label>
                                    <input type="text" class="form-control filter-input" placeholder="$180">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Child Friendly ? Price/Child</label>
                                    <input type="text" class="form-control filter-input" placeholder="Total for 1 room, 2 nights">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <form class="photo-upload">
                                        <div class="form-group">
                                            <div class="add-listing__input-file-box">
                                                <input class="add-listing__input-file" type="file" name="file" id="file">
                                                <div class="add-listing__input-file-wrap">
                                                    <i class="ion-ios-cloud-upload"></i>
                                                    <p>Click here to upload your images</p>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn v8 mar-top-15">Add Images</a>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard content ends-->
@endsection
