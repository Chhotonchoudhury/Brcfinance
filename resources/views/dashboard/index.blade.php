@extends('layouts/app')
@section('title') Dashboard @endsection
@section('content')
<!-- Row start -->
<div class="row gutters">
    <!-- Total Branches -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-building"></i> <!-- Branch Icon -->
            </div>
            <div class="sale-details">
                <h2>{{ $totalBranches }}</h2>
                <p>Total Branches</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine1"></div>
            </div>
        </div>
    </div>

    <!-- Total Members -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-users"></i> <!-- Members Icon -->
            </div>
            <div class="sale-details">
                <h2>{{ $totalMembers }}</h2>
                <p>Total Members</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine2"></div>
            </div>
        </div>
    </div>

    <!-- Total Savings Accounts -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-piggy-bank"></i> <!-- Savings Account Icon -->
            </div>
            <div class="sale-details">
                <h2>{{ $totalSavingsAccounts }}</h2>
                <p>Savings Accounts</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine3"></div>
            </div>
        </div>
    </div>

    <!-- Total RD Accounts -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-hand-holding-usd"></i> <!-- RD Account Icon -->
            </div>
            <div class="sale-details">
                <h2>{{ $totalRDAccounts }}</h2>
                <p>Recurring Deposit Accounts</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine4"></div>
            </div>
        </div>
    </div>

    <!-- Total FD Accounts -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-coins"></i> <!-- FD Account Icon -->
            </div>
            <div class="sale-details">
                <h2>{{ $totalFDAccounts }}</h2>
                <p>Fixed Deposit Accounts</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine5"></div>
            </div>
        </div>
    </div>

    <!-- Total Loan Against Deposit Accounts -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-handshake"></i> <!-- Loan Against Deposit Icon -->
            </div>
            <div class="sale-details">
                <h2>{{ $totalLoanAgainstDepositaccounts }}</h2>
                <p>Loan Against Deposit</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine6"></div>
            </div>
        </div>
    </div>

    <!-- Total Employees -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-user-tie"></i> <!-- Employees Icon -->
            </div>
            <div class="sale-details">
                <h2>{{ $totalEmployees }}</h2>
                <p>Total Employees</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine7"></div>
            </div>
        </div>
    </div>

    <!-- Total Agents -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-user-secret"></i> <!-- Agents Icon -->
            </div>
            <div class="sale-details">
                <h2>{{ $totalAgents }}</h2>
                <p>Total Agents</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine8"></div>
            </div>
        </div>
    </div>
</div>

<!-- Row end -->



<!-- Row start -->
{{-- <div class="row gutters">
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
</div> --}}
<!-- Row end -->
@endsection