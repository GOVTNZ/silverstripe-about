# Deprecated

This module is deprecated as of SilverStripe 4/Common Web Platoform 2 - we suggest users make use of the following set of modules via a recipe to gain similar features to this module [https://github.com/silverstripe/recipe-reporting-tools](https://github.com/silverstripe/recipe-reporting-tools)

No further updates or patches will be available for this module as of March 2019.

# Introduction

The "About" module adds an admin section to your site that shows information about the execution context of the site. This includes:

 *	An overview of the app version and versions of major components such as framework, CMS and cwp-core (if it's a dependency)
 *	App dependencies (via composer.lock) which tell you exactly which versions of which dependencies are installed
 *	phpinfo() which tells you the PHP version, context provided by Apache, which PHP extensions are installed, and their configurations.
 *	A list of processes currently running on the server.


# Installation

Simply install via composer. It will work without configuration, but the next section details some optional configuration properties.

# Configuration

## App Version

The overview provider displays the app version and date the version was tagged. It determines this by looking for a file
relative to web root that contains the version number. The modification time of the file is used to determine when it was
tagged.

By default, the module looks in web root for a file called APP_VERSION. This can be overridden in the configuration system by setting
AboutInfoOverview::$app_version_file to be the path of such a file.

If the nominated file can't be found, the overview section just omits displaying the app version section. It will still display
major dependencies. The module does not provide facilities to write the app version file; this should be done as part of your site's
tag/release process.

## Major Dependencies

The overview provider displays the names and versions of major dependencies of the application. This comes from composer.lock,
as does the version information displayed by the app dependencies provider. The "major" dependencies are just a subset that you
want to display on the overview page.

By default, the list it looks for includes:

 *	silverstripe/framework
 *	silverstripe/cms
 *	cwp/cwp-core

If you want different modules to appear, you can use config to override AboutInfoOverview::$major_dependencies. This is a simple list
of composer module names.

## Disabling Providers

By default, the module will look for all info provider classes, and show a menu item for them. If you want to suppress certain providers,
you can do this by setting AboutAdmin::$excludeProviders, which is a simple array of class names of the providers you want to exclude.

# Extending

The admin interface uses a concept of a provider. These are just sub-classes of AboutInfoProvider. Each such class introduces
a menu option for that provider, and the provider renders whatever it wants to display.

	class AboutInfoMyProvider extends AboutInfoProvider {

		private static $provider_title = 'My stuff';

		public function render() {
			return $this->renderWith('AboutInfoMyProvider');
		}
	}

You simply tell it what the label is on the left, and provide a render method.

# Notes

Process dump is experimental. It currently requires that exec() is available, and will probably only work on *nix servers.

# To do

 *	Determine if there is a more robust way to get processes without exec(), and format them better
 *	Add tail of error log
