<?php

// A class to abstract out inquiring about application dependencies.
class AboutAppDependencyManager {

	private static $_deps = null;

	// Retrieve the contents of composer.lock
	public static function get_dependency_info() {
		if (!self::$_deps) {
			$folder = Director::baseFolder();
			$raw = file_get_contents($folder . '/composer.lock');
			self::$_deps = json_decode($raw, true);
		}

		return self::$_deps;
	}

	public static function get_module_version($moduleName) {
		$deps = self::get_dependency_info();

		if (!isset($deps['packages'])) {
			return FALSE;
		}

		foreach ($deps['packages'] as $dependency) {
			if (isset($dependency['name']) && $dependency['name'] == $moduleName) {
				if (isset($dependency['version'])) {
					return $dependency['version'];
				}
				return FALSE;
			}
		}

		return FALSE;
	}
}