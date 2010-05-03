<?php

/**
 * @file classes/core/Handler.inc.php
 *
 * Copyright (c) 2000-2010 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class Handler
 * @ingroup handler
 *
 * @brief Base request handler application class
 */


import('lib.pkp.classes.handler.PKPHandler');
import('classes.handler.validation.HandlerValidatorConference');
import('classes.handler.validation.HandlerValidatorSchedConf');

class Handler extends PKPHandler {
	function Handler() {
		parent::PKPHandler();

		$conference =& Request::getConference();
		$page = Request::getRequestedPage();
		if ( $conference && $conference->getSetting('restrictSiteAccess')) {
			$this->addCheck(new HandlerValidatorCustom($this, true, null, null, create_function('$page', 'if (!Validation::isLoggedIn() && !in_array($page, Handler::getLoginExemptions())) return false; else return true;'), array($page)));
		}
	}
}

?>
