<div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-sm-6 col-xl-4">
                                <div class="card  shadow-none m-0">
                                    <div class="card-body text-center">
                                        <i class="mdi mdi-account-cash text-muted" style="font-size: 24px;"></i>
                                        <h3><span>$ {{ $data->sum('amount') }}</span></h3>
                                        <p class="text-muted font-15 mb-0">Total Earnings</p>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                                <div class="card  shadow-none m-0 border-left">
                                    <div class="card-body text-center">
                                        <i class="mdi mdi-debug-step-out text-muted" style="font-size: 24px;"></i>
                                        <h3><span>$ {{ $data->sum('refunded_amount') }}</span></h3>
                                        <p class="text-muted font-15 mb-0">Refunded Ammount</p>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $data->count() }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Order</p>
                                </div>
                            </div>
                        </div>

                        

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->
    </div>