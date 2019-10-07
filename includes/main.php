<?php
	$param 	= $_GET['param'] ?? null;
	$page 	= $_GET['page'] ?? 1;

	$adverts 	= Advert::getAll($param);

	$mainUrl = '/wp-admin/admin.php?page=advert-integration%2Fincludes%2F';
?>

<div class="wrap" id="wp-media-grid" data-search="">
	<div>
		<h1 style="display: inline-block;">Рекламные интеграции</h1>
		<a style="display: inline-block;" href="<?= $mainUrl ?>create.php" class="page-title-action aria-button-if-js" role="button" aria-expanded="false">Добавить новую</a>
	</div>
	
	<?php if(!empty($adverts)): ?>
	<div style="margin-top: 30px;">
		<table cellspacing="2" border="1" cellpadding="5" style="border-color: #AAA;">
			<thead>
				<th>id</th>
				<th>Контакты</th>
				<th>Дата завершения</th>
				<th>Шорткод</th>
				<th>Активность</th>
				<th>Действия</th>
			</thead>
			<tbody>
				<?php foreach($adverts as $advert): ?>
					<tr>
						<td><a target="_blank" href="/<?= $advert->url ?>"><?= $advert->article_id ?></a></td>
						<td><?= $advert->name ?></td>
						<td><?= $advert->end_date ?></td>
						<td>[article_advertising_place id="<?= $advert->id ?>"]</td>
						<td><?= (($advert->is_active) ? 'Да' : 'Нет') ?></td>
						<td>
							<a href="/wp-admin/admin.php?page=advert-integration%2Fincludes%2Fedit.php&post_id=<?= $advert->id ?>" type="button">Редактировать</a>
							<form method="post" action="<?= $mainUrl ?>main.php">
								<input type="hidden" name="post_id" value="<?= $advert->id ?>">
								<button type="submit">Удалить</button>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php else: ?>
	<div style="margin-top: 70px;">
		<span>Ничего не найдено</span>
	</div>
	<?php endif;?>
</div>

