<?php

use app\services\LangService;
use app\tests\fixtures\LangFixture;


class langDataTest extends \Codeception\Test\Unit
{
    use \yii\test\FixtureTrait;
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $translate;

    protected function _before()
    {
        $this->translate = new LangService();
        $this->loadFixtures();
    }

    protected function _after()
    {
        $this->translate = NULL;
        $this->unloadFixtures();
    }

    public function fixtures()    {
        return [
            'langFixture' => [
                'class' => LangFixture::class,
                ],
            ];
    }

    public function testWhenAllParamsOkAndSelectRusLang()
    {
        $this->tester->wantTo('Тестирование, когда все параметры введены верно и выбран русский язык');
        $result = $this->translate->translate('button.success.ok-d41d8cd98f00b204e9800998ecf8427e', 'rus', [10]);
        $this->assertEquals('Принять', $result);
    }

    public function testWhenAllParamsOkAndSelectEngLang()
    {
        $this->tester->wantTo('Тестирование, когда все параметры введены верно и выбран английский язык');
        $result = $this->translate->translate('button.success.ok-d41d8cd98f00b204e9800998ecf8427e', 'eng', [10]);
        $this->assertEquals('Accept', $result);
    }

    public function testWhenSlugNotFound()
    {
        $this->tester->wantTo('Тестирование, когда не найден slug');
        $result = $this->translate->translate('button.ssuccess.ok-d41d8cd98f00b204e9800998ecf8427e', 'rus', [10]);
        $this->assertEquals('button.ssuccess.ok-d41d8cd98f00b204e9800998ecf8427e', $result);
    }

    public function testWhenLangNotFound()
    {
        $this->tester->wantTo('Тестирование, когда не найден язык, но найден slug');
        $result = $this->translate->translate('button.success.ok-d41d8cd98f00b204e9800998ecf8427e', 'asdrus', [10]);
        $this->assertEquals('Принять', $result);
    }

    public function testWhenAllParamsNotFound()
    {
        $this->tester->wantTo('Тестирование, когда ни один из параметор не найден');
        $result = $this->translate->translate('button.susccess.ok-d41d8cd98f00b204e9800998ecf8427e', 'asdrus', [10]);
        $this->assertEquals('button.susccess.ok-d41d8cd98f00b204e9800998ecf8427e', $result);
    }
}