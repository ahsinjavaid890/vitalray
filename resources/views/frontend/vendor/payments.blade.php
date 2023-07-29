@extends('layouts.vendor-app')
@section('title')
<title>Payments</title>
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
                                <li>Dashboard</li>
                                <li>Payments</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard breadcrumb ends-->

<div class="dash-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="invoice-panel">
                                <div class="act-title">
                                    <h5><i class="ion-ios-printer-outline"></i> Payments</h5>
                                    <div class="row mt-5">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="lable-control">Status</label>
                                                <select class="form-control">
                                                    <option>Pending</option>
                                                    <option>Cleared</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="lable-control">Filter by date</label>
                                                <select class="form-control">
                                                    <option>This Week</option>
                                                    <option>This Month</option>
                                                    <option>This Year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-body">
                                    
                                    <div class="table-responsive">
                                        <table class="invoice-table">
                                            <thead>
                                                <tr class="invoice-headings">
                                                    <th>Booking Number</th>
                                                    <th>Date</th>
                                                    <th>Total Amount</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        #103 </td>
                                                    <td>
                                                        <time datetime="2019-04-26T01:06:30+00:00">Mar 21,2019 to Mar 25,2019</time>
                                                    </td>

                                                    <td>
                                                        <span class="amount">$30.00</span> </td>
                                                    <td>
                                                        <span class="amount text-warning">Clearing on (12 Jun 2021)</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        #103 </td>
                                                    <td>
                                                        <time datetime="2019-04-26T01:06:30+00:00">Mar 21,2019 to Mar 25,2019</time>
                                                    </td>

                                                    <td>
                                                        <span class="amount">$30.00</span> </td>
                                                    <td>
                                                        <span class="amount text-success">Transferd</span>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

@endsection
