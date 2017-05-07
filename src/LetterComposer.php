<?php
/**
 * Letter Composer (Multilingual)
 *
 * Provides methods useful for composing letters (mail).
 *
 * @version    2.0 (2017-05-07 22:29:00 GMT)
 * @author     Peter Kahl <peter.kahl@colossalmind.com>
 * @since      2017
 * @license    Apache License, Version 2.0
 *
 * Copyright 2017 Peter Kahl <peter.kahl@colossalmind.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      <http://www.apache.org/licenses/LICENSE-2.0>
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace peterkahl\LetterComposer;

use peterkahl\CzechNameDeclension\CzechNameDeclension;
use \Exception;

class LetterComposer {

  public $lang;

  public $recipientName;

  /**
   * Gender of recipient
   * (only for purposes of grammar)
   * @var string
   * Possible values
   * 'M' .... male
   * 'F' .... female
   * 'N' .... neutral or unknown
   */
  public $recipientGender = 'N';

  public $senderNamePlain;

  public $senderNameHtml;

  #===================================================================

  private function ValidateLanguage($lang) {
    $available = array(
      'ar',
      'cs',
      'da',
      'de',
      'en',
      'es',
      'fr',
      'he',
      'it',
      'ja',
      'nl',
      'pt',
      'ru',
      'sk',
      'zh-cn',
      'zh-hk',
    );
    $this->lang = $this->denormaliseLangcode($this->lang);
    if ($this->lang == 'zh-tw' || $this->lang == 'zh-mo') {
      $this->lang = 'zh-hk';
    }
    elseif ($this->lang == 'zh-sg' || $this->lang == 'zh') {
      $this->lang = 'zh-cn';
    }
    if (in_array($this->lang, $available)) {
      return;
    }
    $this->lang = substr($this->lang, 0, 2);
    if (in_array($this->lang, $available)) {
      return;
    }
    throw new Exception('Invalid property lang');
  }

  #===================================================================

  /**
   * turns en_GB --> en-gb
   *
   */
  private function denormaliseLangcode($str) {
    $str = strtolower($str);
    return str_replace('_', '-', $str);
  }

  #===================================================================

  public function makeSalutation() {
    $this->ValidateLanguage();
    $this->recipientGender = strtoupper($this->recipientGender);
    $lcName = mb_strtolower($this->recipientName);
    #----------------------------
    if ($this->lang == 'zh-hk') {
      return '尊敬的'.         $this->recipientName .':';
    }
    #----------------------------
    elseif ($this->lang == 'zh-cn') {
      return '尊敬的'.         $this->recipientName .':';
    }
    #----------------------------
    elseif ($this->lang == 'ja') {
      return '拝啓'.           $this->recipientName .':';
    }
    #----------------------------
    elseif ($this->lang == 'de') {
      return 'Hallo '.         $this->recipientName .':';
    }
    #----------------------------
    elseif ($this->lang == 'fr') {
      return 'Salut '.         $this->recipientName .':';
    }
    #----------------------------
    elseif ($this->lang == 'es') {
      switch ($this->recipientGender) {
        case 'M':
          return 'Estimado '.  $this->recipientName .':';
        case 'F':
          return 'Estimada '.  $this->recipientName .':';
        default:
          return 'Salud '.     $this->recipientName .':';
      }
    }
    #----------------------------
    elseif ($this->lang == 'pt') {
      switch ($this->recipientGender) {
        case 'M':
          return 'Estimado '.  $this->recipientName .':';
        case 'F':
          return 'Estimada '.  $this->recipientName .':';
        default:
          return 'Saúde '.     $this->recipientName .':';
      }
    }
    #----------------------------
    elseif ($this->lang == 'it') {
      return 'Ciao '.          $this->recipientName .':';
    }
    #----------------------------
    elseif ($this->lang == 'nl') {
      return 'Geachte '.       $this->recipientName .':';
    }
    #----------------------------
    elseif ($this->lang == 'ru') {
      switch ($this->recipientGender) {
        case 'M':
          return 'Уважаемый '.  $this->recipientName .':';
        case 'F':
          return 'Уважаемая '.  $this->recipientName .':';
        default:
          return 'Привет, '.    $this->recipientName .':';
      }
    }
    #----------------------------
    elseif ($this->lang == 'cs') {
      switch ($this->recipientGender) {
        case 'M':
          return 'Milý '.       CzechNameDeclension::getVocative($this->recipientName) .':';
        case 'F':
          return 'Milá '.       CzechNameDeclension::getVocative($this->recipientName) .':';
        default:
          return 'Dobrý den, '. CzechNameDeclension::getVocative($this->recipientName) .':';
      }
    }
    #----------------------------
    elseif ($this->lang == 'sk') {
      switch ($this->recipientGender) {
        case 'M':
          return 'Milý '.       $this->recipientName .':';
        case 'F':
          return 'Milá '.       $this->recipientName .':';
        default:
          return 'Dobrý den, '. $this->recipientName .':';
      }
    }
    #----------------------------
    elseif ($this->lang == 'en') {
      return 'Dear '.           $this->recipientName.',';
    }
  }

  #===================================================================

  public function makeValedictionPlain() {
    $this->ValidateLanguage();
    #----
    if ($this->lang == 'zh-hk') {
      $str = '此致敬禮，';
    }
    elseif ($this->lang == 'zh-cn') {
      $str = '此致敬礼，';
    }
    elseif ($this->lang == 'ja') {
      $str = '敬具，';
    }
    elseif ($this->lang == 'de') {
      $str = 'Mit Grüssen,';
    }
    elseif ($this->lang == 'fr') {
      $str = 'Amicalement,';
    }
    elseif ($this->lang == 'es') {
      $str = 'Saludos,';
    }
    elseif ($this->lang == 'pt') {
      $str = 'Cordialmente,';
    }
    elseif ($this->lang == 'it') {
      $str = 'Ti saluto,';
    }
    elseif ($this->lang == 'nl') {
      $str = 'Met groet,';
    }
    elseif ($this->lang == 'ru') {
      $str = 'С уважением,';
    }
    elseif ($this->lang == 'cs') {
      $str = 'S pozdravem,';
    }
    elseif ($this->lang == 'sk') {
      $str = 'S pozdravom,';
    }
    elseif ($this->lang == 'en') {
      $str = 'Best regards,';
    }
    return $str . PHP_EOL . $this->senderNamePlain;
  }

  #===================================================================

  public function makeValedictionHtml() {
    $this->ValidateLanguage();
    #----
    if ($this->lang == 'zh-hk') {
      $str = '此致敬禮，';
    }
    elseif ($this->lang == 'zh-cn') {
      $str = '此致敬礼，';
    }
    elseif ($this->lang == 'ja') {
      $str = '敬具，';
    }
    elseif ($this->lang == 'de') {
      $str = 'Mit Grüssen,';
    }
    elseif ($this->lang == 'fr') {
      $str = 'Amicalement,';
    }
    elseif ($this->lang == 'es') {
      $str = 'Saludos,';
    }
    elseif ($this->lang == 'pt') {
      $str = 'Cordialmente,';
    }
    elseif ($this->lang == 'it') {
      $str = 'Ti saluto,';
    }
    elseif ($this->lang == 'nl') {
      $str = 'Met groet,';
    }
    elseif ($this->lang == 'ru') {
      $str = 'С уважением,';
    }
    elseif ($this->lang == 'cs') {
      $str = 'S pozdravem,';
    }
    elseif ($this->lang == 'sk') {
      $str = 'S pozdravom,';
    }
    elseif (substr($this->lang, 0, 2) == 'en') {
      $str = 'Best regards,';
    }
    return $str . '<br>' . $this->senderNameHtml;
  }

  #===================================================================

}