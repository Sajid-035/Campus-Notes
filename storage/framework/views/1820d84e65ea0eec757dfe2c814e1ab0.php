

<?php $__env->startSection('title', 'Website Analytics'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/all.min.css')); ?>">
<style>
    .card-statistic-1 .card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
    }
    .chart-container {
        height: 300px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Website Analytics (Demo Data)</h1>
        </div>

        
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header"><h4>Total News</h4></div>
                        <div class="card-body">120</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header"><h4>Today Visitors</h4></div>
                        <div class="card-body">345</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header"><h4>Yesterday Visitors</h4></div>
                        <div class="card-body">289</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header"><h4>This Month Visitors</h4></div>
                        <div class="card-body">7,892</div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><h4>Total Page Views</h4></div>
                    <div class="card-body">
                        <canvas id="pageViewsChart" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><h4>Top Viewed News</h4></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Breaking News 1
                                <span class="badge badge-primary badge-pill">450</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Popular Article 2
                                <span class="badge badge-primary badge-pill">389</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                News Highlight 3
                                <span class="badge badge-primary badge-pill">320</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><h4>Top Categories</h4></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Politics
                                <span class="badge badge-success badge-pill">1,230</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sports
                                <span class="badge badge-success badge-pill">980</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Technology
                                <span class="badge badge-success badge-pill">765</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><h4>Browser Statistics</h4></div>
                    <div class="card-body">
                        <canvas id="browserChart" class="chart-container"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><h4>Device Statistics</h4></div>
                    <div class="card-body">
                        <canvas id="deviceChart" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Page Views Line Chart (demo)
    var ctxPage = document.getElementById('pageViewsChart').getContext('2d');
    var pageViewsChart = new Chart(ctxPage, {
        type: 'line',
        data: {
            labels: ["1 Dec", "2 Dec", "3 Dec", "4 Dec", "5 Dec", "6 Dec", "7 Dec"],
            datasets: [{
                label: 'Page Views',
                data: [120, 150, 180, 200, 250, 300, 350],
                backgroundColor: 'rgba(54,162,235,0.2)',
                borderColor: 'rgba(54,162,235,1)',
                borderWidth: 2
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Browser Doughnut Chart (demo)
    var ctxBrowser = document.getElementById('browserChart').getContext('2d');
    var browserChart = new Chart(ctxBrowser, {
        type: 'doughnut',
        data: {
            labels: ["Chrome", "Firefox", "Edge", "Safari", "Other"],
            datasets: [{
                data: [450, 200, 120, 80, 50],
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Device Doughnut Chart (demo)
    var ctxDevice = document.getElementById('deviceChart').getContext('2d');
    var deviceChart = new Chart(ctxDevice, {
        type: 'doughnut',
        data: {
            labels: ["Desktop", "Mobile", "Tablet"],
            datasets: [{
                data: [500, 350, 150],
                backgroundColor: ['#007bff', '#28a745', '#ffc107']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\laragon\www\portal\resources\views/backend/website-analytics/index.blade.php ENDPATH**/ ?>