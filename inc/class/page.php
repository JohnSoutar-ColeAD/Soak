<?php

class Page {
	var $pageID = '';
	var $siteID = '';

	var $userID = '';
	var $templateID = '';
	var $parentID = '';

	var $pageTitle = '';
	var $pageDescription = '';
	var $pageContent = '';

	var $parsedContent;

	var $Template;

	function Page($pageID = '') {

		$this->pageID = $pageID;

		if ($pageID != '') {
			$this->loadFromID($pageID);
			$this->Template = new Template($this->templateID);

			$this->parsedContent = $this->parsePage();
		} else {
			die('No page ID provided');
		}
		
	}

	function parsePage() {


		return $this->parsedContent;
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