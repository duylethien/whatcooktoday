<?php

namespace App\Model\Enum;


abstract class ELanguage {
	const EN = 'en';
	const VI = 'vi';

	public static function isSupportedLanguage(string $lang) {
		return in_array($lang, self::getSupportedLanguage());
	}

	public static function getSupportedLanguage() {
		return [
			static::EN,
			static::VI,
		];
	}

	public static function valueToName($val) {
		switch ($val) {
			case self::EN:
				return 'English';
			case self::VI:
				return 'Vietnamese';
		}
		return null;
	}
}