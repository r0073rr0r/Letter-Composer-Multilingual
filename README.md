# Letter-Composer-Multilingual

Provides methods useful for composing letters (mail).

## Dependency

If you intend to use Czech language, you will also need to install library [peterkahl/czech-name-declension](https://github.com/peterkahl/Czech-Name-Declension).

## Usage

```php
use peterkahl\LetterComposer\LetterComposer;

$letterObj = new LetterComposer;
$letterObj->senderNamePlain = 'Customer Service Representative'. PHP_EOL .'Famous Company, Ltd.';
$letterObj->senderNameHtml  = 'Customer Service Representative<br>Famous Company, Ltd.';

# Example, Russian
$letterObj->lang            = 'ru';
$letterObj->recipientName   = 'Мари́я Шара́пова';
$letterObj->recipientGender = 'f';
echo $letterObj->$letterObj->makeSalutation() . PHP_EOL . PHP_EOL . 'Это ваш новый пароль.' . PHP_EOL . PHP_EOL . $letterObj->makeValedictionPlain();
/*
'Уважаемая Мари́я Шара́пова,

Это ваш новый пароль.

С уважением,
Customer Service Representative
Famous Company, Ltd.'
*/

# Example, Czech
$letterObj->lang            = 'cs';
$letterObj->recipientName   = 'Václav Čtvrtek';
$letterObj->recipientGender = 'm';
echo $letterObj->$letterObj->makeSalutation() . PHP_EOL . PHP_EOL . 'Zde je Vaše nové heslo.' . PHP_EOL . PHP_EOL . $letterObj->makeValedictionPlain();
/*
'Milý Václave Čtvrtku,

Zde je Vaše nové heslo.

S pozdravem,
Customer Service Representative
Famous Company, Ltd.'
*/
```