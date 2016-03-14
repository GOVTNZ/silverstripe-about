<?php

class AboutInfoAppDependencies extends AboutInfoProvider {

	private static $provider_title = 'App dependencies';

	public function render() {
		return $this->renderWith('AboutInfoAppDependencies');
	}

	// Return a dataset of dependencies
	public function Dependencies() {
		// Get the dependency information
		$deps = self::get_dependency_info();

		$packages = array();
		if (isset($deps['packages'])) {
			$packages = $deps['packages'];
		}

		$result = new ArrayList();

		foreach ($packages as $package) {
			$sourceUrl = '';
			if (isset($package['source']['url'])) {
				$sourceUrl = $package['source']['url'];
			}
			$sourceReference = '';
			if (isset($package['source']['reference'])) {
				$sourceReference = $package['source']['reference'];
			}

			$result->push(new ArrayData(array(
				'Name' => $package['name'],
				'Version' => $package['version'],
				'SourceURL' => $sourceUrl,
				'SourceReference' => $sourceReference
			)));
		}

		return $result;
	}

	// Retrieve the contents of composer.lock
	public static function get_dependency_info() {
		$folder = Director::baseFolder();
		$raw = file_get_contents($folder . '/composer.lock');
		$deps = json_decode($raw, true);

		return $deps;
	}
}