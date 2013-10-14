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

	$DB->prepare('SELECT * FROM page WHERE siteID = :siteID AND parentID = :parentID ORDER BY sortOrder ASC');
	$DB->execute(array(':siteID' => $Site->siteID, 'parentID' => $level));

	if ($level == 0) {
		echo '<ul class="nav navbar-nav">';

	} else {
		echo '<ul class="dropdown-menu">';
	}
	foreach ($DB->result as $Page) {

		$DB->prepare('SELECT * FROM page WHERE siteID = :siteID AND parentID = :parentID ORDER BY sortOrder ASC');
		$DB->execute(array(':siteID' => $Site->siteID, 'parentID' => $Page['pageID']));
		$hasChild = $DB->result;

		if ($hasChild) {
			echo '<li class="dropdown">';
			echo '<a href="?pid=' . $Page['pageID'] . '">' . $Page['pageTitle'] . '<b class="caret"></b></a>';
			buildMenu($Page['pageID']);


		} else {
			echo '<li>';
			echo '<a href="?pid=' . $Page['pageID'] . '">' . $Page['pageTitle'] . '</a>';

		}

		echo "</li>";
	}
	echo "</ul>";
}
