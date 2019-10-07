<?php
	$param 	= $_GET['param'] ?? null;
	$page 	= $_GET['page'] ?? 1;

	$adverts 	= Advert::getAll($param);

	$mainUrl = '/wp-admin/admin.php?page=advert-integration%2Fincludes%2Fmain.php';
	$formUrl = $mainUrl . '&method=edit';
?>

<div>
	<h1>Рекламные интеграции</h1>
	
	<?php if(!empty($adverts)): ?>
	<div style="margin-top: 70px;">
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
							<a href="" type="button">Редактировать</a>
							<form method="post" action="<?= $formUrl ?>">
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

