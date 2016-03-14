<?php

// An info provider that dumps phpinfo() to a string and renders it.
class AboutInfoPHP extends AboutInfoProvider {
	
	private static $provider_title = 'PHP Info';

	public function render() {
		ob_start();
		phpinfo();
		$result = ob_get_contents();
		ob_get_clean();

		return $result;
	}
}