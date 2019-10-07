<form method="post" action="/wp-admin/admin.php?page=advert-integration%2Fincludes%2Fcreate.php">
	<div>
		<input type="checkbox" name="is_active">
		<label for="is_active">Активность</label>
	</div>
	<div>
		<label for="article_id">id статьи</label>
		<input type="number" name="article_id">
	</div>
	<div>
		<label for="name">Контакт</label>
		<input type="text" name="name">
	</div>
	<div>
		<label for="end_date">Дата завершения</label>
		<input type="datetime-local" name="end_date">
	</div>
	<div>
		<label for="text">Текст интеграции</label>
		<textarea name="text"></textarea>
	</div>
	<button type="submit">Создать</button>
</form>