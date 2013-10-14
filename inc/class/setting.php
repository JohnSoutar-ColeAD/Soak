<?php

class Setting {
	var $settingName;
	var $settingValue;

	function Setting($settingName, $settingValue) {
		$this->settingName = $settingName;
		$this->settingValue = $settingValue;

		return $this->settingValue;
	}

	function get() {
		return $this->settingValue;
	}
}

?>