<?php

class AboutInfoProcesses extends AboutInfoProvider {

	private static $provider_title = 'Processes';

	public function render() {
		return $this->renderWith('AboutInfoProcesses');
	}

	public function Processes() {
		// @todo figure how this will behave if exec is disabled. Is there another way to get processes, e.g. via file system?
		exec('ps aux', $output);

		if (!is_array($output)) {
			// Not sure what it returned
			return print_r($output,true);
		}

		$result = '<br/>';
		foreach ($output as $row) {
			$result .= $row . "<br/>";
		}
		return $result;
	}
}