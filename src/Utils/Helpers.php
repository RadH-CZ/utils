<?php

namespace Grs\Utils;

use Nette,
	Nette\Templating\ITemplate;


class Helpers
{

	/**
	 * Static class - cannot be instantiated.
	 */
	final public function __construct()
	{
		throw new Nette\StaticClassException;
	}


	/**
	 *
	 * @param ITemplate $template
	 * @return void
	 */
	public static function addCustomHelpers(ITemplate $template)
	{
		$template->registerHelper('age', function ($value, $s) {
			return empty($value) ? '-' : (floor((date('Ymd') - str_replace('-', '', $value)) / 10000) . $s);
		});

		$template->registerHelper('yesNo', function ($value) {
			return empty($value) ? 'ne' : 'ano';
		});

		$template->registerHelper('abbrCsMonth', function ($value) {
			$monthCsAbbr = array(
				'01' => 'led',
				'02' => 'úno',
				'03' => 'bře',
				'04' => 'dub',
				'05' => 'kvě',
				'06' => 'čer',
				'07' => 'čvc',
				'08' => 'srp',
				'09' => 'zář',
				'10' => 'říj',
				'11' => 'lis',
				'12' => 'pro'
			);

			return $monthCsAbbr[$value];
		});
	}

}
