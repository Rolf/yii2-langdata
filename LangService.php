<?php
/**
 * Created by PhpStorm.
 * User: artyom
 * Date: 10.08.17
 * Time: 12:31
 */

namespace bubogumy;

use bubogumy\LangData;
use Yii;

/**
 * Сервис для работы с языковыми метками
 * @package bubogumy
 */
class LangService
{
    const LANG_RUS = 'rus';
    const LANG_ENG = 'eng';

    const LANG_CACHE_HASH = 'lang_cache_hash';

    public $arrayConstant = ['rus' => self::LANG_RUS, 'eng' => self::LANG_ENG];

    /**
     * Записывает все языковые метки в кэш
     * @param int $duration
     * @return mixed
     */
    public static function langData(int $duration = 60*60*24*365)
    {
        return LangData::getDb()->cache(function ($db) use ($duration) {
            return LangData::find()
                ->indexBy('slug')
                ->all();
        }, $duration);
    }

    /**
     * Установить хэш
     */
    public function setHash()
    {
        Yii::$app->cache->set(self::LANG_CACHE_HASH, uniqid(), 60*60*24*365);
    }

    /**
     * Вернуть хэш
     * @return mixed
     */
    public function getHash()
    {
        return Yii::$app->cache->get(self::LANG_CACHE_HASH);
    }

    /**
     * Вернуть результат перевода по слагу и выбранному языку
     * @param string $slug
     * @param string $translate
     * @param array $params
     * @return mixed|string
     */
    public function translate(string $slug, string $translate = self::LANG_RUS, array $params = [])
    {
        $langData = self::langData();

        if (!in_array($translate, $this->arrayConstant)) {
            $translate = LangService::LANG_RUS;
        }
        if (!isset($langData[$slug])) {
            return $slug;
        }

        $result = $langData[$slug][$translate];
        if (!empty($result)) {
            for ($i = 0; $i < count($params); $i++) {
                $result = str_replace('{' . $i . '}',
                    $params[$i], $result);
            }
        }
        return $result;
    }
}

