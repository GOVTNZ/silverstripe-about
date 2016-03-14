# Introduction

The "About" module adds an admin section to your site that shows information about the execution context of the site. This includes:

 *	An overview of the app version and versions of major components such as framework, CMS and cwp-core (if it's a dependency)
 *	App dependencies (via composer.lock) which tell you exactly which versions of which dependencies are installed
 *	phpinfo() which tells you the PHP version, context provided by Apache, which PHP extensions are installed, and their configurations.
 *	A list of processes currently running on the server.


# Installation

Simply install via composer. There is currently nothing to configure.

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

 *	Permit configuration of which modules to display in the overview.
 *	Determine if there is a more robust way to get processes without exec(), and format them better
 *	Add tail of error log
