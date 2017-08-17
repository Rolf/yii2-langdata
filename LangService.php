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

class LangService
{
    const LANG_CACHE_HASH = 'lang_cache_hash';
    const LANG_RUS = 'rus';
    const LANG_ENG = 'eng';
    public $arrayConstant = ['rus' => self::LANG_RUS, 'eng' => self::LANG_ENG];

    /*
    *   Записывает все языковые метки в кэш
    *   @return array возвращает все языковые метки
    */

    public static function langData(int $duration = 31536000)
    {
        return LangData::getDb()->cache(function ($db) use ($duration) {
            return LangData::find()
                ->indexBy('slug')
                ->all();
        }, $duration);
    }

    /*
    *   Установить хэш
    *   @return array возвращает хэш
    */

    public function setHash()
    {
        Yii::$app->cache->set(self::LANG_CACHE_HASH, uniqid(), 60*60*24*365);
    }

    /*
    *   Вернуть хэш
    *   @return array возвращает хэш
    */

    public function getHash()
    {
        return Yii::$app->cache->get(self::LANG_CACHE_HASH);
    }

    /*
    *   Вернуть результат перевода по слагу и выбранному языку
    *   @return возвращает результат перевода по метке
    */

    public function translate(string $slug, string $translate, array $params = [])
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

