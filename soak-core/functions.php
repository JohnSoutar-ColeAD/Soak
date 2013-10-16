<?php

// functions.php
// Functions for use in templates/themes/pages

function get_header() {
	global $Site;

	include($Site->Theme->themeLocation . '/header.php');
}

function get_footer() {
	global $Site;

	include($Site->Theme->themeLocation . '/footer.php');
}

function get_siteName() {
	global $Site;

	echo $Site->siteName;
}

function get_siteDescription() {
	global $Site;

	echo $Site->siteDescription;
}
function get_pageTitle() {
	global $Site;

	echo $Site->Page->pageTitle;
}

function get_pageContent() {
	global $Site;

	echo $Site->Page->pageContent;
}

////////////////////////////////	
// Navigation                 //
////////////////////////////////

function get_mainNavigation($level = 0) {
	global $Site;
	global $DB;

	$Links = array();

	echo buildMenu();
}

function buildMenu($level = 0) {
	global $Site;
	global $DB;

	$out = '';

	$DB->prepare('SELECT * FROM page WHERE pageVisibility = 1 AND siteID = :siteID AND parentID = :parentID ORDER BY sortOrder ASC');
	$DB->execute(array(':siteID' => $Site->siteID, 'parentID' => $level));

	if ($level == 0) {
		echo '<ul class="nav navbar-nav">';

	} else {
		echo '<ul class="dropdown-menu">';
	}
	foreach ($DB->result as $Page) {

		$DB->prepare('SELECT * FROM page WHERE pageVisibility = 1 AND siteID = :siteID AND parentID = :parentID ORDER BY sortOrder ASC');
		$DB->execute(array(':siteID' => $Site->siteID, 'parentID' => $Page['pageID']));
		$hasChild = $DB->result;

		if ($Site->Page->pageID == $Page['pageID']) {
			$class =" active";
		} else {
			$class = "";
		}

		if ($hasChild) {
			echo '<li class="dropdown' . $class . '">';
			echo '<a href="/' . $Page['pageSlug'] . '">' . $Page['pageTitle'] . '<b class="caret"></b></a>';

			// Recurse into the next level
			buildMenu($Page['pageID']);
		} else {
			echo '<li class="' . $class . '">';
			echo '<a href="/' . $Page['pageSlug'] . '">' . $Page['pageTitle'] . '</a>';

		}

		echo "</li>";
	}
	echo "</ul>";
}

////////////////////////////////	
// Theme functions            //
////////////////////////////////

function get_themeLocation() {
	global $Site;

	echo $Site->Theme->themeLocation;
}
