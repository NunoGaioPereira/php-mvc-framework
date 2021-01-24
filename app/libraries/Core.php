<?php
	// Core App Class
	class Core {
		protected $currentController = 'Pages';
		protected $currentMethod = 'index';
		protected $params = [];

		public function __construct() {
			$url = $this->getUrl();

			// Look in controllers for first  value
			if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
				$this->currentController = ucwords($url[0]);
				unset($url[0]);
			}

			// Require the controller
			require_once('../app/controllers/' . $this->currentController . '.php');
			$this->currentController = new $this->currentController;
		}

		public function getUrl() {
			if (isset($_GET['url'])) {
				$url = rtrim($_GET['url'], '/');
				// Filter string/number
				$url = filter_var($url, FILTER_SANITIZE_URL);
				// Breaking into an array
				$url = explode('/', $url);
				return $url;
			}
		}
	}