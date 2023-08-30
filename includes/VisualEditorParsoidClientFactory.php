<?php

namespace MediaWiki\Extension\VisualEditor;

use MediaWiki\Config\ServiceOptions;
use MediaWiki\Permissions\Authority;
use MediaWiki\Rest\Handler\Helper\PageRestHelperFactory;
use RequestContext;

/**
 * @since 1.40
 */
class VisualEditorParsoidClientFactory {

	/**
	 * @internal For use by ServiceWiring.php only or when locating the service
	 * @var string
	 */
	public const SERVICE_NAME = 'VisualEditor.ParsoidClientFactory';

	/**
	 * @internal For used by ServiceWiring.php
	 *
	 * @var array
	 */
	public const CONSTRUCTOR_OPTIONS = [];

	private ServiceOptions $options;
	private PageRestHelperFactory $pageRestHelperFactory;

	public function __construct(
		ServiceOptions $options,
		PageRestHelperFactory $pageRestHelperFactory
	) {
		$this->options = $options;
		$this->options->assertRequiredOptions( self::CONSTRUCTOR_OPTIONS );

		$this->pageRestHelperFactory = $pageRestHelperFactory;
	}

	/**
	 * Create a ParsoidClient for accessing Parsoid.
	 *
	 * @param string|string[]|false $cookiesToForward
	 * @param Authority|null $performer
	 *
	 * @return ParsoidClient
	 */
	public function createParsoidClient(
		/* Kept for compatibility with other extensions */ $cookiesToForward,
		?Authority $performer = null
	): ParsoidClient {
		if ( $performer === null ) {
			$performer = RequestContext::getMain()->getAuthority();
		}

		return $this->createDirectClient( $performer );
	}

	/**
	 * Create a ParsoidClient for accessing Parsoid.
	 *
	 * @param Authority $performer
	 *
	 * @return ParsoidClient
	 */
	private function createDirectClient( Authority $performer ): ParsoidClient {
		return new DirectParsoidClient(
			$this->pageRestHelperFactory,
			$performer
		);
	}

}
