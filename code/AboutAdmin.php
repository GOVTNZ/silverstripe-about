<?php

class AboutAdmin extends LeftAndMain {
	
	private static $url_segment = 'about';
	
	private static $url_rule = '/$Action/$ID/$OtherID';
	
	// // Maintain a lower priority than other administration sections
	// // so that Director does not think they are actions of CMSMain
	// private static $url_priority = 39;
	
	private static $menu_title = 'About site';
	
	private static $menu_priority = 10;

	// Render the main menu, which consists of a list of provider names.
	public function Tools() {
		return $this->renderWith('AboutAdmin_Tools');
	}

	// Get an ordered list of data providers, which are subclasses of AboutInfoProvider. Returns an ArrayList.
	public function Providers() {
		$config = Config::inst();
		$providers = ClassInfo::subclassesFor('AboutInfoProvider');
		$list = new ArrayList();
		foreach ($providers as $providerClass) {
			if ($providerClass == 'AboutInfoProvider') {
				// ignore the abstract
				continue;
			}

			$title = $providerClass;			
			if ($config->get($providerClass, 'provider_title')) {
				$title = $config->get($providerClass, 'provider_title');
			}

			$sort = 0;
			if ($config->get($providerClass, 'provider_sort')) {
				$sort = $config->get($providerClass, 'provider_sort');
			}

			$urlSegment = $providerClass;

			$list->push(new ArrayData(array(
				'Title' => $title,
				'ClassName' => $providerClass,
				'URLSegment' => $urlSegment,
				'Sort' => $sort
			)));
		}

		$list = $list->sort(array(
			'Sort' => 'ASC',
			'Title' => 'ASC'
		));

		return $list;
	}

	// Left and main is wired to use EditForm. We don't return a form, we instead figure out which provider
	// to display, and return our rendered editform template, with the result from the provider injected.
	public function EditForm($request = NULL) {
		// Get a provider instance
		$provider = $this->getSelectedProviderInstance();

		// get it to render
		$fromProvider = $provider->render();

		$details = new HTMLText();
		$details->setValue($fromProvider);

		return $this
			->customise(array(
					'ProviderDetails' => $details
				))
			->renderWith('AboutAdmin_EditForm');
	}

	// Return an instance of the selected provider. The provider is identified by a query field.
	protected function getSelectedProviderInstance() {
		$selectedProvider = '';
		if (isset($_REQUEST['provider'])) {
			$selectedProvider = $_REQUEST['provider'];
		}

		$providers = ClassInfo::subclassesFor('AboutInfoProvider');
		if (!in_array($selectedProvider, $providers) || $selectedProvider == 'AboutInfoProvider') {
			// If it's not a support provider class, display the overview.
			$selectedProvider = 'AboutInfoOverview';
		}

		$inst = Object::create($selectedProvider);

		return $inst;
	}
}