<form method="post" action="/wp-admin/admin.php?page=advert-integration%2Fincludes%2Fcreate.php">
	<div>
		<input type="checkbox" name="is_active">
		<label for="is_active">Активность</label>
	</div>
	<div>
		<label for="post_id">id статьи</label>
		<input type="number" name="post_id">
	</div>
	<div>
		<label for="contact">Контакт</label>
		<input type="text" name="contact">
	</div>
	<div>
		<label for="end_date">Дата завершения</label>
		<input type="datetime-local" name="end_date">
	</div>
	<div>
		<label for="content">Текст интеграции</label>
		<textarea name="content"></textarea>
	</div>
	<button type="submit">Создать</button>
</form>