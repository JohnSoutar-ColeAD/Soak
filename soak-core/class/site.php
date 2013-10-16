<?php

class Site {
	var $siteID;
	var $siteName = '';
	var $siteURL= '';
	var $siteDescription = '';
	var $themeID = '';

	var $Page;

	var $Theme;

	var $Settings = array();

	var $Session;

	// Constructor function
	function Site($siteID = 1, $alive = TRUE) {

		$this->siteID = $siteID;

		$this->loadSettings();

		if ($alive) {
			// Build the page object with the page ID specified in the URL
			if (isset($_GET[$this->Settings['pageIDParam']->get()])) {
				$pageID = $_GET[$this->Settings['pageIDParam']->get()];
			} elseif (isset($_GET['slug'])) {
				$slug = $_GET['slug'];
			} else {
				$pageID = $this->Settings['defaultPageID']->get();
			}

			if (isset($pageID)) {
				$this->Page = new Page($pageID);
			} elseif ($slug) {
				$this->Page = new Page($slug, TRUE);
			} else {
				// Load the "defaultPageID" setting
				$this->Page = new Page($this->Settings['defaultPageID']->get());
			}	

			$this->startSession();
		}
		
	}

	function startSession() {
		// Start the session
		$this->Session = new Session;
	}

	function loadSettings() {
		global $DB;

		// Load site details
		$DB->prepare('SELECT * FROM site WHERE siteID = :siteID');
		$DB->execute(array(':siteID' => $this->siteID));

		$this->loadFromArray($DB->result);

		// Load theme
		$this->Theme = new Theme($this->themeID);

		// Load foreign settings
		$DB->prepare('SELECT * FROM setting WHERE siteID = :siteID');
		$DB->execute(array(':siteID' => $this->siteID));

		foreach ($DB->result as $settingArray => $setting ) {
			$settingName = $setting['settingName'];
			$settingValue = $setting['settingValue'];

			$this->Settings[$settingName] = new Setting($settingName, $settingValue);
		}
	}

	function loadFromArray($siteArray) {
		if (count($siteArray) > 0) {
			foreach ($siteArray[0] as $key => $value) {
				if (isset($this->$key)) {
					$this->$key = $value;
				}
			}
		}
	}
}

?>