<?php

class Theme {
	
	var $themeID;
	var $themeName = '';
	var $themeDescription = '';

	var $themeLocation;

	function Theme($themeID = '') {

		if ($themeID == '') {

		} else {
			$this->loadFromID($themeID);

			$this->themeLocation = 'themes/' . $this->themeName;
		}

	}

	function loadFromID($themeID) {
		global $DB;
		
		$DB->prepare('SELECT * FROM theme WHERE themeID = :themeID');
		$DB->execute(array(':themeID' => $themeID));

		$this->loadFromArray($DB->result);
	}

	function loadFromArray($themeArray) {
		if (count($themeArray) > 0) {
			foreach ($themeArray[0] as $key => $value) {
				if (isset($this->$key)) {
					$this->$key = $value;
				}
			}
		}
	}

}

?>