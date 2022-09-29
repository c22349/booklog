    <h2 class="h2 text-dark mt-4 mb-4">予約変更フォーム</h2>
    <form action="create.php" method="post">
      <?php if (count($errors)) : ?>
        <ul class="text-danger">
          <?php foreach ($errors as $error) : ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <div class="form-group">
        <label for="name">お名前</label>
        <input type="text" name="name" id="name" placeholder="山田" class="form-control">
        <!-- value="<?php echo $name['name'] ?>" -->
        <label for="date">変更前日時</label>
        <input type="date" name="day" list="daylist" class="form-control">
        <!-- value="<?php echo $day['day'] ?>" -->
        <label for="date">変更後日時</label>
        <input type="date" name="day" list="daylist" class="form-control">
        <!-- value="<?php echo $day['day'] ?>" -->
      </div>
    </form>
    <button type="submit" class="btn btn-success">予約を変更</button>
    <a href="index.php" class="btn btn-secondary">トップに戻る</a>
    </form>
