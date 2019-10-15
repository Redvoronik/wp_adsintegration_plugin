<?php
if(!empty($_POST))
{
	$advert = Advert::find($_POST['id']);
	$advert->delete();

	add_action( 'admin_notices', 'advert_save_success' );
?>