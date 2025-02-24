<?php $__container->servers(['main' => deploy@petramsphere.com]); ?>

<?php $__container->startTask('list', ['on' => 'main']); ?>
    cd /var/www/html/petramsphere.com
    ls
<?php $__container->endTask(); ?>