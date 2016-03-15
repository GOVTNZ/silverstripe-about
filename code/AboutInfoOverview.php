<?php

class AboutInfoOverview extends AboutInfoProvider {

	private static $provider_sort = -1;
	private static $provider_title = 'Overview';

	/**
	 * The name of a path, interpreted from web root, which contains the version number of the application. If this file is
	 * not present, no app version information is displayed.
	 * @var string
	 * @config
	 */
	private static $app_version_file = 'APP_VERSION';

	/**
	 * The names of modules to look for in the dependency list that are considered "major" dependencies, which are
	 * displayed on the overview page. The values are the composer names of the modules.
	 * @var array of strings
	 * @config
	 */
	private static $major_dependencies = array(
		'silverstripe/framework',
		'silverstripe/cms',
		'cwp/cwp-core'
	);

	// cache of version info, computed on demand.
	private static $_appVersion = FALSE;

	public function render() {
		return $this->renderWith('AboutInfoOverview');
	}

	public function KeyModuleVersions() {
		$result = new ArrayList();

		$majorDeps = $this->getMajorDependencies();

		foreach ($majorDeps as $moduleName) {
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

	// Get the major dependencies for the overview.
	public function getMajorDependencies() {
		$config = Config::inst();

		return $config->get(get_class($this), 'major_dependencies');
	}

	public function ApplicationVersioned() {
		$versionInfo = $this->getAppVersion();
		if ($versionInfo) {
			return true;
		}
		return false;
	}

	public function AppVersion() {
		$versionInfo = $this->getAppVersion();
		return $versionInfo['version'];
	}

	public function DateTagged() {
		$versionInfo = $this->getAppVersion();
		return $versionInfo['dateTagged'];
	}

	// Get app version information. If app version is present, return an array that contains
	// 'version' and 'dateTagged' keys. If not present, return null.
	protected function getAppVersion() {
		if (self::$_appVersion === FALSE) {
			$path = $this->getAppVersionPath();

			// If the file is not present, return null, there is no info.
			if (!file_exists($path)) {
				self::$_appVersion = null;
				return self::$_appVersion;
			}

			// Get the version (contents of the file)
			$version = file_get_contents($path);

			// Get the date it was tagged (modification date of the file)
			$timestamp = filemtime($path);
			$dateTagged = date('j-M-Y H:i:s', $timestamp);

			self::$_appVersion = array(
				'version' => $version,
				'dateTagged' => $dateTagged
			);

		}

		return self::$_appVersion;
	}

	// Get the full path of the app version file.
	protected function getAppVersionPath() {
		$config = Config::inst();
		$appPath = $config->get(get_class($this), 'app_version_file');

		$path = Director::baseFolder();
		if (substr($appPath, 0, 1) != '/') {
			$path .= '/';
		}
		$path .= $appPath;
		return $path;
	}
}