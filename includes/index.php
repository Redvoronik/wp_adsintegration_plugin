<?php
	$page 	= $_GET['paget'] ?? 1;
	$orderBy = $_GET['orderby'] ?? 'id';
	$order 	= $_GET['order'] ?? 'desc';

	$adverts 	= Advert::getAll($page, $orderBy, $order);

	$mainUrl = '/wp-admin/admin.php?page=advert-integration%2Fincludes%2F';

	$params = [
		'post_id' => 'ID статьи', 
		'contact' => 'Контакт', 
		'end_date' => 'Дата завершения', 
		'shortcode' => 'Шорткод', 
		'is_active' => 'Активность'
	];
?>

<div class="wrap" id="wp-media-grid" data-search="">
	<div>
		<h1 style="display: inline-block;">Рекламные интеграции</h1>
		<a style="display: inline-block;" href="<?= $mainUrl ?>create.php" class="page-title-action aria-button-if-js" role="button" aria-expanded="false">Добавить новую</a>
	</div>
	
	<?php if(!empty($adverts)): ?>

	<table style="margin-top: 30px;" class="wp-list-table widefat fixed striped users">
		<thead>
		<tr>
			<?php foreach($params as $key => $value): ?>
			<th scope="col" id="<?= $key ?>" class="manage-column column-username column-primary sortable <?= ($key == $orderBy && $order == 'asc') ? 'desc' : 'asc' ?>">
				<a href="/wp-admin/admin.php?page=advert-integration%2Fincludes%2Findex.php&amp;orderby=<?= $key ?>&amp;order=<?= ($key == $orderBy && $order == 'asc') ? 'desc' : 'asc' ?>">
					<span><?= $value ?></span>
					<span class="sorting-indicator"></span>
				</a>
			</th>
			<?php endforeach; ?>
		</tr>
		</thead>

		<tbody id="the-list" data-wp-lists="list:user">
			
		<?php foreach($adverts as $advert): ?>
			<tr>
				<td>
					<a title="<?= $advert->post_title ?>" target="_blank" href="/<?= $advert->url ?>"><strong><?= $advert->post_id ?> - <?= $advert->post_title ?></strong></a>
					<div class="row-actions">
						<span class="edit"><a href="/wp-admin/admin.php?page=advert-integration%2Fincludes%2Fedit.php&post_id=<?= $advert->id ?>">Изменить</a> | </span><span class="submitdelete"><a href="/wp-admin/admin.php?page=advert-integration%2Fincludes%2Fdelete.php&id=<?= $advert->id ?>">Удалить</a></span></div>
				</td>
				<td><?= $advert->contact ?></td>
				<td><?= date('d.m.y', strtotime($advert->end_date)) ?></td>
				<td>[article_advertising_place id="<?= $advert->id ?>"]<div class="row-actions">
						<span class="edit"><a href="#" onclick="copyShortcode('<?= $advert->id ?>')">Копировать в буфер</a></div></td>
				<td><?= (($advert->is_active) ? 'Да' : 'Нет') ?></td>
			</tr>
		<?php endforeach; ?>

	</table>

	<?php else: ?>
	<div style="margin-top: 70px;">
		<span>Ничего не найдено</span>
	</div>
	<?php endif;?>
</div>

<script type="text/javascript">
	function copyShortcode(text) {
		text = "[article_advertising_place id=" + text + "]";
		navigator.clipboard.writeText(text).then(function() {
		  console.log('Async: Copying to clipboard was successful!');
		}, function(err) {
		  console.error('Async: Could not copy text: ', err);
		});
	}
</script>
