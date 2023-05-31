<?php $pager->setSurroundCount(2) ?>
<div class="card-footer">
  <nav aria-label="Contacts Page Navigation">
    <ul class="pagination justify-content-center m-0">
      <?php if ($pager->hasPreviousPage()) : ?>
        <li class="page-item">
          <a class="page-link" href="<?= $pager->getFirst() ?>">&laquo;</a>
        </li>
      <?php endif ?>
      <?php foreach ($pager->links() as $link) : ?>
        <li <?= $link['active'] ? 'class="page-item active"' : '' ?>>
          <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
        </li>
      <?php endforeach ?>
      <?php if ($pager->hasNextPage()) : ?>
        <li class="page-item">
          <a class="page-link" href="<?= $pager->getLast() ?>">&raquo;</a>
        </li>
      <?php endif ?>
    </ul>
  </nav>
</div>