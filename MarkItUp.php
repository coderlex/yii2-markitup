<?php
namespace coderlex\markitup;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;
use yii\web\View;

class MarkItUp extends InputWidget
{
	public $clientOptions = [];
	public $options = [];
	public $skin = 'simple';

	public function init()
	{
		$defaultOptions = ['class' => 'form-control', 'style' => 'overflow:auto;resize:none;'];
		$this->options = ArrayHelper::merge($defaultOptions, $this->options);
		if ($this->hasModel()) {
			$this->options['id'] = Html::getInputId($this->model, $this->attribute);
		} else {
			$this->options['id'] = $this->getId();
		}
		// Register asset bundle
		$bundle = MarkItUpAsset::register($this->getView());
		$fileOptions = ['depends' => MarkItUpAsset::className()];
		$view = $this->getView();
		// Add skin CSS
		if (!empty($this->skin))
			$view->registerCssFile("{$bundle->baseUrl}/skins/{$this->skin}/style.css", $fileOptions, "markitup-skin-{$this->skin}");
		// Register script
		$clientOptions = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
		$this->view->registerJs("jQuery('#{$this->options['id']}').markItUp({$clientOptions});");
	}

	public function run()
	{
		if ($this->hasModel()) {
			echo Html::activeTextarea($this->model, $this->attribute, $this->options);
		} else {
			echo Html::textarea($this->name, $this->value, $this->options);
		}
	}
}
