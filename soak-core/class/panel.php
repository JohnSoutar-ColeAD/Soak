<?php

class Panel {
	
	var $Site;
	var $Session;

	function Panel($siteID = 1) {

		$this->Site = new Site($siteID, FALSE);
		$this->Session = new Session;
	}
}


?>