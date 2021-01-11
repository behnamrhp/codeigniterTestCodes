<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if ($pager->hasPreviousPage()) : ?>

        <li class="page-item"><a class="page-link" href="<?= $pager->getPreviousPage() ?>"><?= lang('Pager.previous') ?></a></li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>

        <li <?= $link['active']  ? 'class="page-item active"' : '' ?> ><a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
        <?php endforeach ?>
        <?php if ($pager->hasNextPage()) : ?>
        <li class="page-item"><a class="page-link" href="<?= $pager->getNextPage() ?>"><?= lang('Pager.next') ?></a></li>
        <?php endif ?>

    </ul>
</nav>