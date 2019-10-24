<?php
if(!empty($_GET))
{
	$advert = Advert::find($_GET['id']);
	$advert->delete();
}