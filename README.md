# yii2-markitup
MarkItUp (http://markitup.jaysalvat.com) widget for Yii2

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
	// Textarea options (default):
	'options' => ['class' => 'form-control', 'style' => 'overflow:auto;resize:none;'],
	// Skin (default):
	'skin' => 'simple',
	// JS widget initialization options:
	'clientOptions' => [
		'markupSet' => [ 	
			[
				'name' => 'Bold',
				'key' => 'B',
				'className' => 'markitup-bold',
				'openWith' => '[b]',
				'closeWith' => '[/b]'
			],
			// ...
			['separator' => '---------------'],
			[
				'name' => 'Numeric List',
				'className' => 'markitup-nlist',
				'openWith' => '[*]',
				'multiline' => true,
				'openBlockWith' => "[list=1]\n",
				'closeBlockWith' => "\n[/list]"
			],
			// ...
			['separator' => '---------------'],
			[
				'name' => 'Link',
				'key' => 'L',
				'className' => 'markitup-link',
				'replaceWith' => '[url=[![Link:!:http://]!]](!( title="[![Title]!]")!)[/url]',
				'placeHolder' => 'Your text to link...'
			],
			// ...
		]
	],
]);
\yii\widgets\ActiveForm::end();
```

Styling:
```scss
$markitup-btn-height: 24px;
$markitup-btn-width: 24px;

html {
	.markItUpHeader ul a {
		height: $markitup-btn-height;
		width: $markitup-btn-width;
		text-align: center;
		line-height: $markitup-btn-width;
	}
	.markItUpHeader ul .markItUpSeparator {
		height: $markitup-btn-height;
	}
	.markItUpEditor {
		width: 100%;
	}
	.markItUp {
		width: auto;
	}
}
%markitup-button {
	@include fa-icon();
	font-size: 14px;
	display: block;
	text-indent: 0;
	position: absolute;
	left: 0;
	top: 0;
	width: $markitup-btn-width;
	height: $markitup-btn-height;
	line-height: $markitup-btn-height;
}
.markitup-bold a:before {
	@extend %markitup-button;
	content: $fa-var-bold;
}
.markitup-italic a:before {
	@extend %markitup-button;
	content: $fa-var-italic;
}
.markitup-underline a:before {
	@extend %markitup-button;
	content: $fa-var-underline;
}
.markitup-strike a:before {
	@extend %markitup-button;
	content: $fa-var-strikethrough;
}
.markitup-blist a:before {
	@extend %markitup-button;
	content: $fa-var-list-ul;
}
.markitup-nlist a:before {
	@extend %markitup-button;
	content: $fa-var-list-ol;
}
.markitup-image a:before {
	@extend %markitup-button;
	content: $fa-var-picture-o;
}
.markitup-link a:before {
	@extend %markitup-button;
	content: $fa-var-link;
}
.markitup-preview a:before {
	@extend %markitup-button;
	content: $fa-var-eye;
}
```
