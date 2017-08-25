<?php
/**
 * Created by PhpStorm.
 * User: artyom
 * Date: 10.08.17
 * Time: 10:27
 */

namespace bubogumy;

use yii\db\ActiveRecord;

/**
 * @property string $slug
 * @property string $rus
 * @property string $eng
 */
class LangData extends ActiveRecord
{
    public static function tableName()
    {
        return 'lang_data';
    }
}
