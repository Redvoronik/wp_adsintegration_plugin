<form method="post" action="/wp-admin/admin.php?page=wp_adsintegration_plugin%2Fincludes%2F<?= (isset($advert)) ? 'edit.php' : 'create.php' ?>">
	<table class="form-table" role="presentation">
		<tbody>
		<?php if(isset($advert)): ?>
			<input type="hidden" name="id" value="<?= $advert->getId(); ?>">
		<?php endif; ?>
		<tr>
			<th scope="row"><label for="is_active">Активность</label></th>
			<td><label><input name="is_active" type="checkbox" id="is_active" class="regular-text" <?= (isset($advert) && $advert->getActive()) ? 'checked="checked"' : null ?>>Включить рекламную интеграцию</label></td>
		</tr>
		<tr>
			<th scope="row"><label for="post_id">id статьи *</label></th>
			<td><input name="post_id" type="number" id="post_id" value="<?= (isset($advert)) ? $advert->getPostId() : null ?>" class="regular-text"></td>
		</tr>

		<tr>
			<th scope="row"><label for="contact">Контакт</label></th>
			<td><input placeholder="test@mail.ru" name="contact" type="text" value="<?= (isset($advert)) ? $advert->getContact() : null ?>" id="contact" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="end_date">Дата завершения *</label></th>
			<td><input min="<?= date('Y-m-d') ?>" name="end_date" type="date" id="end_date" value="<?= (isset($advert)) ?date("Y-m-d", strtotime($advert->getEnddate())) : null ?>" class="regular-text">
				<p class="description">После окончания даты, независимо от значения параметра "Активность", интеграция будет отключена</p></td>
		</tr>
		<tr>
			<th scope="row"><label for="content">Текст интеграции *</label></th>
			<td><textarea rows="10" name="content" class="regular-text" id="content"><?= (isset($advert)) ? $advert->getContent() : null ?></textarea></td>
		</tr>

		</tbody>
	</table>

	<p class="submit">
		<input type="submit" name="submit" id="submit" class="button button-primary" value="Сохранить изменения">
	</p>
</form>