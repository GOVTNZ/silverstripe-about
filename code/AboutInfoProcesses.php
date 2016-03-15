<?php

class AboutInfoEnvironment extends AboutInfoProvider {

	private static $provider_title = 'Environment';

	public function render() {
		return $this->renderWith('AboutInfoEnvironment');
	}

	public function Processes() {
		// @todo figure how this will behave if exec is disabled. Is there another way to get processes, e.g. via file system?
		exec('ps aux', $output);

		return print_r($output,true);
	}
}