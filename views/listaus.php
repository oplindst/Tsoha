<?php foreach($data->kissat as $kissa): ?>
<div class="kissa">
  Kissan nimi on
  <?php echo $kissa->getNimi(); ?>
</div>
<?php endforeach; ?>

