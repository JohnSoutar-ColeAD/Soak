<?php

class Page {
	var $pageID = '';
	var $siteID = '';
	var $pageSlug = '';

	var $userID = '';
	var $templateID = '';
	var $parentID = '';

	var $pageTitle = '';
	var $pageDescription = '';
	var $pageContent = '';

	var $parsedContent;

	var $Template;

	function Page($pageID = '', $using_slug = FALSE) {

		$this->pageID = $pageID;

		if ($using_slug) {
			$this->loadFromSlug($pageID);
			$this->Template = new Template($this->templateID);

		} elseif ($pageID != '') {
			$this->loadFromID($pageID);
			$this->Template = new Template($this->templateID);
		}
		
	}

	function loadFromSlug($pageSlug) {
		global $DB;
		
		$DB->prepare('SELECT * FROM page WHERE pageSlug = :pageSlug');
		$DB->execute(array(':pageSlug' => $pageSlug));

		if (count($DB->result) > 0) {
			$this->loadFromArray($DB->result);
		} else {
			$this->loadFromSlug('error-404');
		}
	}
	function loadFromID($pageID) {
		global $DB;
		
		$DB->prepare('SELECT * FROM page WHERE pageID = :pageID');
		$DB->execute(array(':pageID' => $pageID));

		$this->loadFromArray($DB->result);
	}

	function loadFromArray($pageArray) {
		if (count($pageArray) > 0) {
			foreach ($pageArray[0] as $key => $value) {
				if (isset($this->$key)) {
					$this->$key = $value;
				}
			}
		}
	}
}

?>