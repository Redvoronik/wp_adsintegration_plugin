<?php
if(!empty($_POST))
{
	$advert = new Advert($_POST);
	$advert->update();
} 
elseif(!empty($_GET['post_id']))
{
	$advert = Advert::find($_GET['post_id']);
}
?>

<div class="wrap" id="wp-media-grid" data-search="">
<h1 style="display: inline-block;">Редактировать рекламную интеграцию</h1>
<?php require_once 'form.php' ?>
</div>