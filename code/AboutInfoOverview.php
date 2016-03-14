<?php

class AboutInfoOverview extends AboutInfoProvider {

	private static $provider_sort = -1;
	private static $provider_title = 'Overview';

	public function render() {
		return $this->renderWith('AboutInfoOverview');
	}

	public function KeyModuleVersions() {
		$result = new ArrayList();

		foreach (array(
				'silverstripe/framework',
				'silverstripe/cms',
				'cwp/cwp-core'
			) as $moduleName) {
			$version = AboutAppDependencyManager::get_module_version($moduleName);
			if ($version !== FALSE) {
				$result->push(new ArrayData(array(
					'ModuleName' => $moduleName,
					'Version' => $version
				)));
			}
		}

		return $result;
	}
}