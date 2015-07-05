<?php

namespace Grs\Utils;

use Nette;


class Strings
{

	/**
	 * Static class - cannot be instantiated.
	 */
	final public function __construct()
	{
		throw new Nette\StaticClassException;
	}


	/**
	 * Convert camel case to underscore
	 * @result Pages => pages, ArticleTag => article_tag
	 * @param  string $s
	 * @return string
	 */
	public static function camelCaseToUnderScore($s)
	{
		return lcfirst(preg_replace_callback('#(?<=.)([A-Z])#', function ($m) {
			return '_' . strtolower($m[1]);
		}, $s));
	}


	/**
	 * Convert underscore to camel case
	 * @result pages => Pages, article_tag => ArticleTag
	 * @param  string $s
	 * @return string
	 */
    public static function underScoreToCamelCase($s)
	{
		return preg_replace_callback('#_(.)#', function ($m) {
			return strtoupper($m[1]);
		}, $s);
	}


	/**
	 * @param  string $string
	 * @param  string $basePath
	 * @return string
	 */
	public static function addBasePath($string, $basePath)
	{
		$string = str_replace('href="/', 'href="' . $basePath . '/', $string);
		$string = str_replace('src="/', 'src="' . $basePath . '/', $string);
		return $string;
	}


	/**
	 * @param  string $string
	 * @param  string $basePath
	 * @return string
	 */
	public static function removeBasePath($string, $basePath)
	{
		$string = str_replace('href="' . $basePath . '/', 'href="/', $string);
		$string = str_replace('src="' . $basePath . '/', 'src="/', $string);
		return $string;
	}


	/**
	 * Check if a string is serialized
	 * @param  string $string
	 * @return bool
	 */
	public static function isSerialized($string) {
		return (@unserialize($string) !== false || $string === 'b:0;');
	}


	/**
	 * Return generated random code
	 * @param  int $length desired length
	 * @param  string $chars character of the field selected
	 * @return string
	 */
	public static function generateCode($length = 8, $chars = 'abcdefghijklmnopqrstuvwxABCDEFGHIJKLMNOPQRSTUVWX1234567890')
	{
		$chars_length = (strlen($chars) - 1);

		$string = $chars{rand(0, $chars_length)};

		for ($i = 1; $i < $length; $i = strlen($string)) {
			$r = $chars{rand(0, $chars_length)};
			if ($r != $string{$i - 1}) $string .=  $r;
		}

		return (string) $string;
	}

}
