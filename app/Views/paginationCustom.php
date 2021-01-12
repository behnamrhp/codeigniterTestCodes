
<?php $pager->setSurroundCount(3);  ?>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if ($pager->hasPreviousPage()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>"><?= lang('Pager.first') ?></a>
        </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>"><?= lang('Pager.previous') ?></a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
        <li  class="page-item <?= $link['active'] ? 'active' : '' ?>"><a class="page-link" href="<?= $link['uri'] ?>"> <?= $link['title'] ?></a></li>
        <?php endforeach ?>
        <?php if ($pager->hasNextPage()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>"><?= lang('Pager.next') ?></a>
        </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>"><?= lang('Pager.last') ?></a>
            </li>
        <?php endif ?>

    </ul>
</nav>