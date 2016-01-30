# yii2-markitup
MarkItUp widget for Yii2
http://markitup.jaysalvat.com

## Install via composer

Run in your console:

```bash
php composer.phar global require "fxp/composer-asset-plugin:1.0.0"
php composer.phar require "coderlex/yii2-markitup" "*"
```

## Basic usage

```php
$form = \yii\widgets\ActiveForm::begin();
print $form->field($model, 'content')->widget(\coderlex\markitup\MarkItUp::className(), [
	// Default options:
	'options' => ['class' => 'form-control', 'style' => 'overflow:auto;resize:none;'],
	'clientOptions' => [], // JS widget initialization options
	'setName' => 'default', // Preset (aka 'Set') name
	'skinName' => 'simple',
	'addons' => [],
]);
\yii\widgets\ActiveForm::end();
```