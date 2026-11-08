<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <a class="brand" href="<?php echo e(route('frontend.home')); ?>" style="color:white"><span class="logo" style="background:#2563eb">C</span>CampusNotes</a>
                <p>One organized space for notes, questions and academic resources. Built by students, for students.</p>
            </div>
            <div><h4>Explore</h4><a href="<?php echo e(route('resources.index')); ?>">Browse resources</a><a href="<?php echo e(route('departments.index')); ?>">Departments</a><a href="<?php echo e(route('questions.index')); ?>">Previous questions</a><a href="<?php echo e(route('assignments.index')); ?>">Assignments</a></div>
            <div><h4>Community</h4><a href="<?php echo e(route('frontend.community')); ?>">Community</a><a href="<?php echo e(route('frontend.contributors')); ?>">Contributors</a><a href="<?php echo e(route('blog.index')); ?>">Study blog</a><a href="<?php echo e(route('frontend.faq')); ?>">FAQ</a></div>
            <div><h4>Support</h4><a href="<?php echo e(route('frontend.about')); ?>">About us</a><a href="<?php echo e(route('frontend.contact')); ?>">Contact us</a><a href="<?php echo e(route('login')); ?>">Sign in</a><a href="<?php echo e(route('register')); ?>">Create account</a></div>
        </div>
        <div class="copyright">© <?php echo e(date('Y')); ?> CampusNotes. All rights reserved. · <a href="<?php echo e(route('blog.sitemap')); ?>" style="display:inline">Sitemap</a></div>
    </div>
</footer>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Campus-Notes/resources/views/frontend/partials/footer.blade.php ENDPATH**/ ?>