<?php

// AboutInfoProvider is the base class for data providers to AboutAdmin.
class AboutInfoProvider extends ViewableData {
	
	// Sub-classes should override this.
	protected function render() {
	}

	public function getTitle() {
		$config = Config::inst();

	 	$title = get_class($this);
		if ($config->get($title, 'provider_title')) {
			$title = $config->get($title, 'provider_title');
		}

		return $title;
	}

	public function getLink() {
		return '/admin/about?provider=' . get_class($this);
	}
}