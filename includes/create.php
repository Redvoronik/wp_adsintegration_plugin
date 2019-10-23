<?php
if(!empty($_POST) && !isset($_POST['id']))
{
	$advert = new Advert($_POST);
	$advert->save();
}
?>

<div class="wrap" id="wp-media-grid" data-search="">
<h1 style="display: inline-block;">Добавить новую рекламную интеграцию</h1>
<?php require_once 'form.php' ?>
</div>