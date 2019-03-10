<?php
/*
 *	Made by Samerton
 *  https://github.com/samerton
 *  NamelessMC version 2.0.0-pr6
 *
 *  License: MIT
 *
 *  Particles.js module for NamelessMC
 */

class Particles_Module extends Module {
	public function __construct(){
		$name = 'Particles';
		$author = '<a href="https://samerton.me" target="_blank" rel="nofollow noopener">Samerton</a>, <a href="https://vincentgarreau.com/particles.js/" target="_blank" rel="noopener nofollow">particles.js</a>';
		$module_version = '1.0.0';
		$nameless_version = '2.0.0-pr6';

		parent::__construct($this, $name, $author, $module_version, $nameless_version);

	}

	public function onInstall(){
		// Not necessary
	}

	public function onUninstall(){
		// Not necessary
	}

	public function onEnable(){
		// Not necessary
	}

	public function onDisable(){
		// Not necessary
	}

	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template){
		if(defined('FRONT_END') && $template){
			$template->addJSFiles(array(
				(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/modules/Particles/particles/particles.min.js' => array()
			));
			$template->addJSScript('
			particlesJS.load(\'particles-js\', \'' . (defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/modules/Particles/particles/particles.json' . '\', function() {
				// Loaded
			});
			');
			$template->addCSSStyle('
			#particles-js canvas {
			    position: fixed;
			    width: 100%;
			    height: 100%;
			    z-index: 0;
			}
			.home-header, .masthead {
				z-index: -1;
			}
			.home-header .container {
				z-index: 1;
				position: relative;
			}
			');

			// Add to template - Default template
			if(file_exists(ROOT_PATH . '/custom/templates/Default/header.tpl')){
				$template = file_get_contents(ROOT_PATH . '/custom/templates/Default/header.tpl');

				if(strpos($template, '<body>') !== false && strpos($template, 'particles-js') === false){
					try {
						file_put_contents(ROOT_PATH . '/custom/templates/Default/header.tpl', $template . PHP_EOL . '<div id="particles-js"></div>');
					} catch(Exception $e){
						// Unable to add to template
					}
				}
			}

			// Default revamp
			if(file_exists(ROOT_PATH . '/custom/templates/DefaultRevamp/navbar.tpl')){
				$template = file_get_contents(ROOT_PATH . '/custom/templates/DefaultRevamp/navbar.tpl');

				if(strpos($template, '<div class="ui masthead') !== false && strpos($template, 'particles-js') === false){
					try {
						file_put_contents(ROOT_PATH . '/custom/templates/DefaultRevamp/navbar.tpl', str_replace('<div class="ui masthead', '<div id="particles-js"></div><div class="ui masthead', $template));
					} catch(Exception $e){
						// Unable to add to template
					}
				}
			}
		}
	}
}