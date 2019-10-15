<?php
if(!empty($_GET))
{
	$advert = Advert::find($_GET['id']);
	$advert->delete();

	add_action( 'admin_notices', 'advert_save_success' );
?>