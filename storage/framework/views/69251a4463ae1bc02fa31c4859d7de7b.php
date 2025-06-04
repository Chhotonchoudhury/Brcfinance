<?php
// Calculate the range for visible pagination links
$start = max(1, $paginator->currentPage() - 2); // Start 2 pages before the current page
$end = min($paginator->lastPage(), $paginator->currentPage() + 2); // End 2 pages after the current page
?>

<?php if($paginator->hasPages() && $paginator->lastPage() > 1): ?>
<nav aria-label="Page navigation">
    <ul class="pagination pagination-secondary">
        
        <?php if($paginator->onFirstPage()): ?>
        <li class="page-item disabled">
            <span class="page-link"><span>«</span></span>
        </li>
        <?php else: ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo e($paginator->url(1)); ?>" aria-label="First">
                <span>«</span>
            </a>
        </li>
        <?php endif; ?>

        
        

        
        <?php if($start > 1): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo e($paginator->url(1)); ?>">1</a>
        </li>
        
        <?php if($start > 2): ?>
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        <?php endif; ?>
        <?php endif; ?>

        
        <?php $__currentLoopData = range($start, $end); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($page == $paginator->currentPage()): ?>
        <li class="page-item active" aria-current="page">
            <span class="page-link"><?php echo e($page); ?></span>
        </li>
        <?php else: ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo e($paginator->url($page)); ?>"><?php echo e($page); ?></a>
        </li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($end < $paginator->lastPage()): ?>
            
            <?php if($end < $paginator->lastPage() - 1): ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <?php endif; ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginator->url($paginator->lastPage())); ?>">
                        <?php echo e($paginator->lastPage()); ?>

                    </a>
                </li>
                <?php endif; ?>

                
                

                
                <?php if(!$paginator->onLastPage()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginator->url($paginator->lastPage())); ?>" aria-label="Last">
                        <span>»</span>
                    </a>
                </li>
                <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link"><span>»</span></span>
                </li>
                <?php endif; ?>
    </ul>
</nav>
<?php else: ?>

<nav aria-label="Page navigation">
    <ul class="pagination pagination-secondary">
        <li class="page-item disabled">
            <span class="page-link">No Pages</span>
        </li>
    </ul>
</nav>
<?php endif; ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/vendor/pagination/custom-pagination.blade.php ENDPATH**/ ?>