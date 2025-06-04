@extends('home')

@section('content')

{{-- <section class="container mt-5">
    <!-- Carousel Section -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class=""></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assetsDashboard/img/slider/sl1.jpg')}}" class="d-block w-100" alt="..."
                    style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assetsDashboard/img/slider/sl2.jpg')}}" class="d-block w-100" alt="..."
                    style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assetsDashboard/img/slider/sl3.jpeg')}}" class="d-block w-100" alt="..."
                    style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</section> --}}


<!-- Welcome Section -->
<div class="text-center mt-5 mb-5">
    <h1 class="fw-bold text-primary">Welcome to Our Platform</h1>
    <p class="text-muted fs-5">
        Empowering businesses and individuals with innovative solutions. Explore our services and see how we can
        make a difference.
    </p>
    <a href="#" class="btn btn-lg btn-primary px-4 py-2 shadow">Get Started</a>
</div>

<!-- Services Section -->
<div class="mb-5">
    <h2 class="text-secondary mb-4 text-center fw-semibold">Our Core Services</h2>
    <div class="row g-4">
        <!-- Service Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-laptop-code text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Web Development</h5>
                    <p class="text-muted">
                        Build fast, responsive, and user-friendly websites tailored to your needs.
                    </p>
                    <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-chart-pie text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Data Analytics</h5>
                    <p class="text-muted">
                        Unlock insights and drive smarter decisions with our analytics solutions.
                    </p>
                    <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-cloud text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Cloud Solutions</h5>
                    <p class="text-muted">
                        Secure and scalable cloud services for modern businesses.
                    </p>
                    <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="mb-5">
    <div class="card border-0 shadow-lg p-4">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                <h4 class="fw-bold text-primary">Get in Touch</h4>
                <p class="text-muted">We’d love to hear from you. Send us a message, and we’ll respond as soon
                    as possible.</p>
            </div>
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="3" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Welcome Section -->
{{-- <div class="text-center mt-5 mb-5">
    <h1 class="fw-bold text-primary">Welcome to Your Account Dashboard</h1>
    <p class="text-muted fs-5">
        Manage your account details, balance, and transactions efficiently with our advanced tools.
    </p>
</div>
<!-- Account Search Section -->
<div class="container mb-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-semibold text-secondary mb-4 text-center">Account Search</h5>
                    <form id="account-search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" id="search-account"
                                placeholder="Search by Account Number or Name" aria-label="Account Search"
                                aria-describedby="account-search-btn" required>
                            <button class="btn btn-outline-primary" type="submit" id="account-search-btn"><i
                                    class="fas fa-search"></i> Search</button>
                        </div>
                    </form>
                    <div id="search-results" class="mt-4 d-none">
                        <div class="alert alert-info">
                            <strong>Account Found!</strong> Please select an account to view more details.
                        </div>
                        <div id="account-list" class="list-group">
                            <!-- Dynamically populated account list will go here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Account Details Tabs Section -->
<div class="container mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="accountTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="account-details-tab" data-bs-toggle="tab"
                                href="#account-details" role="tab" aria-controls="account-details"
                                aria-selected="true">Account Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="balance-tab" data-bs-toggle="tab" href="#balance" role="tab"
                                aria-controls="balance" aria-selected="false">Balance</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="transactions-tab" data-bs-toggle="tab" href="#transactions"
                                role="tab" aria-controls="transactions" aria-selected="false">Transactions</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3" id="accountTabsContent">
                        <!-- Account Details Tab -->
                        <div class="tab-pane fade show active" id="account-details" role="tabpanel"
                            aria-labelledby="account-details-tab">
                            <h5 class="fw-bold">Account Information</h5>
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>Account Number</th>
                                        <td id="account-number">1234567890</td>
                                    </tr>
                                    <tr>
                                        <th>Account Holder Name</th>
                                        <td id="account-name">John Doe</td>
                                    </tr>
                                    <tr>
                                        <th>Account Type</th>
                                        <td id="account-type">Savings</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td id="account-status">Active</td>
                                    </tr>
                                    <tr>
                                        <th>Created On</th>
                                        <td id="account-created">2022-01-15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Balance Tab -->
                        <div class="tab-pane fade" id="balance" role="tabpanel" aria-labelledby="balance-tab">
                            <h5 class="fw-bold">Account Balance</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-semibold text-primary" id="account-balance">₹ 15,000</h4>
                                <button class="btn btn-outline-primary" id="view-transactions-btn">View
                                    Transactions</button>
                            </div>
                            <p class="mt-3 text-muted">Your available balance for transactions and withdrawals.</p>
                        </div>

                        <!-- Transactions Tab -->
                        <div class="tab-pane fade" id="transactions" role="tabpanel" aria-labelledby="transactions-tab">
                            <h5 class="fw-bold">Recent Transactions</h5>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody id="transaction-list">
                                    <tr>
                                        <td>2025-01-15</td>
                                        <td>Deposit</td>
                                        <td>+ ₹ 5,000</td>
                                        <td>₹ 15,000</td>
                                    </tr>
                                    <tr>
                                        <td>2025-01-10</td>
                                        <td>Withdrawal</td>
                                        <td>- ₹ 2,000</td>
                                        <td>₹ 10,000</td>
                                    </tr>
                                    <!-- Dynamic content will populate here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection