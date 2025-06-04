@extends('layouts/app')
@section('title') Dashboard @endsection
@section('content')
<!-- Row start -->
<div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="icon-shopping-bag1"></i>
            </div>
            <div class="sale-details">
                <h2>25</h2>
                <p>Products</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine1"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="icon-shopping-bag1"></i>
            </div>
            <div class="sale-details">
                <h2>32</h2>
                <p>Orders</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine2"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="icon-check-circle"></i>
            </div>
            <div class="sale-details">
                <h2>19</h2>
                <p>Customers</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine3"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="icon-check-circle"></i>
            </div>
            <div class="sale-details">
                <h2>19</h2>
                <p>Customers</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine3"></div>
            </div>
        </div>
    </div>

</div>
<!-- Row end -->



<!-- Row start -->
<div class="row gutters">
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">

        <!-- Row start -->
        <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="stats-tile">
                    <div class="sale-icon">
                        <i class="icon-shopping-bag1"></i>
                    </div>
                    <div class="sale-details">
                        <h2>15M</h2>
                        <p>Orders</p>
                        <h5><span class="high"><i class="icon-trending-up"></i> 7.5%</span> since last week</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="stats-tile">
                    <div class="sale-icon">
                        <i class="icon-package"></i>
                    </div>
                    <div class="sale-details">
                        <h2>32M</h2>
                        <p>Revenue</p>
                        <h5><span class="low"><i class="icon-trending-down"></i> 5.7%</span> since last week</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Revenue</div>
                        <div class="graph-day-selection" role="group">
                            <button type="button" class="btn active">Today</button>
                            <button type="button" class="btn">Weekly</button>
                            <button type="button" class="btn">Monthly</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="revenue"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->
    </div>
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">

        <!-- Row start -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tickets</div>
                    </div>
                    <div class="card-body">
                        <div id="tickets"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Earnings</div>
                    </div>
                    <div class="card-body">

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="weekly-earnings">
                                    <div id="weeklyEarnings"></div>
                                    <p>Weekly Earnings</p>
                                    <h5>$1,590</h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="weekly-earnings">
                                    <div id="monthlyEarnings"></div>
                                    <p>Monthly Earnings</p>
                                    <h5>$4,750</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
</div>
<!-- Row end -->
@endsection