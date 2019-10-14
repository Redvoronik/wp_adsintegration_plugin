<form method="post" action="/wp-admin/admin.php?page=advert-integration%2Fincludes%2Fcreate.php">
	<table class="form-table" role="presentation">
		<tbody>
		<tr>
			<th scope="row"><label for="is_active">Активность</label></th>
			<td><label><input name="is_active" type="checkbox" id="is_active" class="regular-text" checked="checked">Включить рекламную интеграцию</label></td>
		</tr>
		<tr>
			<th scope="row"><label for="post_id">id статьи *</label></th>
			<td><input name="post_id" type="number" id="post_id" value="test" class="regular-text"></td>
		</tr>

		<tr>
			<th scope="row"><label for="contact">Контакт</label></th>
			<td><input placeholder="test@mail.ru" name="contact" type="text" id="contact" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="end_date">Дата завершения *</label></th>
			<td><input min="<?= date('Y-m-d') ?>" name="end_date" type="date" id="end_date" class="regular-text">
				<p class="description">После окончания даты, независимо от значения параметра "Активность", интеграция будет отключена</p></td>
		</tr>
		<tr>
			<th scope="row"><label for="content">Текст интеграции *</label></th>
			<td><textarea rows="10" name="content" class="regular-text" id="content"></textarea></td>
		</tr>

		</tbody>
	</table>

	<p class="submit">
		<input type="submit" name="submit" id="submit" class="button button-primary" value="Сохранить изменения">
	</p>
</form>