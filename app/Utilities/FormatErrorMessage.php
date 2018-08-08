<?php

namespace App\Utilities;

class FormatErrorMessage
{
	/**
	 * insert the value of a given field and the field name in the text 
	 * that contains ' :attribute '
	 * use regex to replace ' :attribute ' by a given value
	 * @param  [String] $text      the error text
	 * @param  [String] $fieldName name of the field 
	 * @param  [String] $value     the bad value that user given
	 * @return [String] 		   error message contains the name of the field 
	 *                             and the value that user given
	 */
	public static function replaceAttributeToFieldName($text, $fieldName, $value)
	{
		$pattern = "%\:[a-z]+%i";
		$new_text = preg_replace($pattern, $value, $text);
		$pattern = "%_[a-z]+%i";
		$new_text = preg_replace($pattern, $fieldName, $new_text);
		return $new_text;
	}
}