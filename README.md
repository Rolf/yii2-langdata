## Сервис для работы с языковыми метками

В composer.json добавляем 
````
"require": {
    "bubogumy/langdata": "dev-master"
}
````  
В терминале - ``composer require bubogumy/langdata``  

Накатываем миграцию из папки migration

### Использование
 
Присваиваем класс ``$I = new bubogumy\LangService``  
И выводим нужный нам перевод по нашему slug, выбрав нужный язык ``echo $I->translate('button.succes.ok', 'eng');``  
Использование с параметризированными метками в виде массива: ``echo $q->translate('parse.timerInfo', 'eng', $params);``, где $params - массив с нужными параметрами. Данные из него заменяются вместо ``{}`` на данные из массива соответственно.

#### Пример
Емеется таблица в БД вида:  

slug  | rus | eng
----- | --- | ---
button.success.ok  | Принять | Accept
parse.timerInfo  | До завершения операции, предположительно, {0} минут | Prior to completion of the operation, presumably, {0} minutes.
````
$I = new bubogumy\LangService
echo $I->translate('button.succes.ok', 'eng');
````
Результат: ``Принять``

````
$params = [10, 20, 30];
$I = new bubogumy\LangService
echo $I->translate('parse.timerInfo', 'eng', $params);
````
Результат: ``До завершения операции, предположительно, 10 минут``
