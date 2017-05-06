# Letter-Composer-Multilingual

Provides methods useful for composing letters (mail).

## Usage

```php
use peterkahl\LetterComposer\LetterComposer;

$letterObj = new LetterComposer;
$letterObj->lang            = 'ru';
$letterObj->recipientName   = 'Мари́я Шара́пова';
$letterObj->recipientGender = 'f';
$letterObj->senderNamePlain = 'Custome Service Representative'. PHP_EOL .'Famous Company, Ltd.';
$letterObj->senderNameHtml  = 'Custome Service Representative<br>Famous Company, Ltd.';

echo $letterObj->$letterObj->makeSalutation() . PHP_EOL . PHP_EOL . 'Это ваш новый пароль.' . PHP_EOL . PHP_EOL . $letterObj->makeValedictionPlain();

/*

'Уважаемая Мари́я Шара́пова,

Это ваш новый пароль.

С уважением,
Custome Service Representative
Famous Company, Ltd.'

*/
