<?php $__env->startSection('content'); ?>




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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/welcome.blade.php ENDPATH**/ ?>