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
				<th>Заголовок</th>
				<th>Кол-во похожих</th>
				<th>Обновлено</th>
				<th>Действия</th>
			</thead>
			<tbody>
				<?php foreach($adverts as $advert): ?>
					<tr>
						<td><?= $advert->id ?></td>
						<td><a target="_blank" href="/<?= $advert->url ?>"><?= $advert->title ?></a></td>
						<td><?= $advert->count_advert_article_id ?></td>
						<td><?= $advert->updated_at ?></td>
						<td>
							<form method="post" action="<?= $formUrl ?>">
								<input type="hidden" name="post_id" value="<?= $advert->id ?>">
								<button type="submit">Обновить</button>
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

