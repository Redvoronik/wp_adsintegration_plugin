<?php
	$param 	= $_GET['param'] ?? null;
	$page 	= $_GET['page'] ?? 1;

	$adverts 	= Advert::getAll($param);

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
			<th scope="col" id="<?= $key ?>" class="manage-column column-username column-primary sortable desc">
				<a href="http://maks.local/wp-admin/users.php?orderby=<?= $key ?>&amp;order=asc">
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
					<a target="_blank" href="/<?= $advert->url ?>"><strong><?= $advert->post_id ?></strong></a>
					<div class="row-actions">
						<span class="edit"><a href="/wp-admin/admin.php?page=advert-integration%2Fincludes%2Fedit.php&post_id=<?= $advert->id ?>">Изменить</a> | </span><span class="submitdelete"><a href="/wp-admin/admin.php?page=advert-integration%2Fincludes%2Fdelete.php&id=<?= $advert->id ?>">Удалить</a></span></div>
				</td>
				<td><?= $advert->contact ?></td>
				<td><?= $advert->end_date ?></td>
				<td>[article_advertising_place id="<?= $advert->id ?>"]</td>
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

