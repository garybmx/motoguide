<!-- Pager v4 -->
<?php
$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);

$trans = $environment->getTranslator();
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <ul class="pager pager-v4">
        <?php
        echo getPrevious($paginator->getCurrentPage(), $paginator->getUrl($paginator->getCurrentPage() - 1));
        echo getPageRange($paginator->getCurrentPage(), $paginator->getLastPage());
        echo getNext($paginator->getCurrentPage(), $paginator->getLastPage(), $paginator->getUrl($paginator->getCurrentPage() + 1));
        ?>
    </ul>
<?php endif; ?>


<?php


function getPrevious($currentPage, $url) {
    if ($currentPage <= 1)
        return '<li class="previous disabled"></li>';
    else
        return '<li class="previous"><a class="rounded-3x" href="' . $url . '">'.trans('pagination.previous').'</a></li>';
}


function getPageRange($currentPage, $lastPage) {
    return ' <li class="page-amount">' . $currentPage . ' of ' . $lastPage . '</li>';
}


function getNext($currentPage, $lastPage, $url) {
    if ($currentPage >= $lastPage)
        return '<li class="next"></li>';
    else
        return '<li class="next"><a class="rounded-3x" href="' . $url . '">'.trans('pagination.next').'</a></li>';
}
?>
<!-- End Pager v4 -->	
<!--
echo $presenter->getPrevious('older', array('class'=> ));
<li class="previous"><a class="rounded-3x" href="#">&larr; Older</a></li>
 <li class="page-amount">1of 7</li>
 <li class="next"><a class="rounded-3x" href="#">Newer &rarr;</a></li> -->	