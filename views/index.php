<a href="new.php" class="btn btn-primary mb-4">読書ログを登録する</a>
<main>
  <?php if (count($reviews) > 0) : ?>
    <?php foreach ($reviews as $review) : ?>
      <section class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="card-title h4 text-dark mb-3"><?php echo escape($review['title']) ?></h2>
          <div class="small mb-3">
            <?php echo escape($review['author']) ?>&nbsp;/&nbsp;
            <?php echo escape($review['status']) ?>&nbsp;/&nbsp;
            <?php echo escape($review['score']) ?>点
          </div>
          <p>
            <?php echo nl2br(escape($review['summary']), false) ?>
          </p>
        </div>
      </section>
    <?php endforeach; ?>
  <?php else : ?>
    <p>まだ読書ログが登録されていません。</p>
  <?php endif; ?>
</main>
