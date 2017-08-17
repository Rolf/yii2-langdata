<?php
/**
 * Created by PhpStorm.
 * User: artyom
 * Date: 16.08.17
 * Time: 16:46
 */

namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class LangFixture extends ActiveFixture
{
    public $modelClass = 'app\models\LangData';
    public $dataFile = '@tests/fixtures/data/lang.php';
}
