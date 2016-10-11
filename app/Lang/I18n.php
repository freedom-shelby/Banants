<?php

namespace Lang;
restrictAccess();


use EntityModel;
use EntityTranslationModel;
use Cache\LocalStorage as Cache;

/**
 *
 * Typically this class would never be used directly, but used via the __()
 * function, which loads the message and replaces parameters:
 *
 *     // Display a translated message
 *     echo __('Hello, world');
 *
 *     // With parameter replacement
 *     echo __('Hello, :user', array(':user' => $username));
 */
class I18n extends Lang{

	/**
	 * @var  array  cache of loaded languages
	 */
	protected static $_cache = array();


	/**
	 * Returns translation of a string. If no translation exists, the original
	 * string will be returned. No parameters are replaced.
	 *
	 *     $hello = I18n::get('Hello friends, my name is :name');
	 *
	 * @param   string  $string text to translate
	 * @param   string  $lang   target language
	 * @return  string
	 */
	public static function get($string, $lang = NULL)
	{
		if ( ! $lang)
		{
			// Use the global target language
			$lang = Lang::instance()->getCurrentLang()['iso'];
		}

		// Load the translation table for this language
		$items = I18n::load($lang);

		// Return the translated string if it exists
		return isset($items[$string]) ? $items[$string] : $string;
	}

	/**
	 * Returns the translation table for a given language.
	 *
	 *     // Get all defined Spanish messages
	 *     $messages = I18n::load('es');
	 *
	 * @param   string  $lang   language to load
	 * @return  array
	 */
	public static function load($lang)
	{
		if (isset(I18n::$_cache[$lang]))
		{
			return I18n::$_cache[$lang];
		}

		// Кешировка данных
		$cache = new Cache();
		$cache->setLocalPath($lang . '_I18n');
		$cache->load();
		if($cache->isValid()){
			$items = json_decode($cache->getData(), true);
		}else{
			// Возврошает масив где ключи те ж что id таблици
			$entities = EntityModel::all()->keyBy('id')->toArray();
			$translations = (new EntityTranslationModel())->whereLang_id(Lang::instance()->getLang($lang)['id'])->get()->toArray();

			// Новая таблица для трансляций
			$items = [];

			// Заливает масив где ключом становится entities.text а значением entities_translations.text
			foreach($translations as $trans)
			{
				$items[$entities[$trans['entity_id']]['text']] = $trans['text'];
			}

			$cache->setData(json_encode($items));
			$cache->save();
		}

		// Cache the translation table locally
		return I18n::$_cache[$lang] = $items;
	}

}
if ( ! function_exists('__'))
{
	/**
	 * translation/internationalization function. The PHP function
	 * [strtr](http://php.net/strtr) is used for replacing parameters.
	 *
	 *    __('Welcome back, :user', array(':user' => $username));
	 *
	 * [!!] The target language is defined by [Lang::instance()->getCurrentLang()].
	 *
	 * @uses    I18n::get
	 * @param   string  $string text to translate
	 * @param   array   $values values to replace in the translated text
	 * @param   string  $lang   source language
	 * @return  string
	 */
	function __($string, array $values = NULL, $lang = null)
	{
		if( ! $lang){
			$lang = Lang::instance()->getCurrentLang()['iso'];
		}

		if ($lang !== Lang::DEFAULT_LANGUAGE)
		{
			// The message and target languages are different
			// Get the translation for this message
			$string = I18n::get($string, $lang);
		}

		return empty($values) ? $string : strtr($string, $values);
	}
}
