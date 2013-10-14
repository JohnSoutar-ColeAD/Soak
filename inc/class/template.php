<?php

class Template {
	var $templateID = '';
	var $themeID = '';
	var $templateName = '';
	var $templateDescription = '';

	var $templateContent;
	var $templateLocation;

	var $Theme;

	function Template($templateID = '') {
		global $Site;

		$this->templateID = $templateID;

		if ($templateID = '') {
			die('No template ID');
		} else {
			$this->loadFromID($this->templateID);
		}

		$this->templateLocation = 'themes/' . $this->Theme->themeName . '/' . $this->templateName . '.php';
		$this->templateContent = file_get_contents('themes/' . $this->Theme->themeName . '/' . $this->templateName . '.php');

	}

	function getTemplateContent() {

	}
	function loadFromID($templateID) {
		global $DB;

		$DB->prepare('SELECT * FROM template LEFT JOIN theme ON template.themeID = theme.themeID WHERE templateID = :templateID');
		$DB->execute(array('templateID' => $templateID));

		$this->loadFromArray($DB->result);

		$this->Theme = new Theme;
		$this->Theme->themeID = $this->themeID;
		$this->Theme->themeName = $DB->result[0]['themeName'];
		$this->Theme->themeDescription = $DB->result[0]['themeDescription'];
	}

	function loadFromArray($templateArray) {
		if (count($templateArray) > 0) {
			foreach ($templateArray[0] as $key => $value) {
				if (isset($this->$key)) {
					$this->$key = $value;
				}
			}
		}
	}
}

?>