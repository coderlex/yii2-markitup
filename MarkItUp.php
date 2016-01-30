<?php
namespace yii\markitup;

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
	public $setName = 'default';
	public $skinName = 'simple';
	public $addons = [];

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
		$assetBundle = MarkItUpAsset::register($this->getView());
		$assetPath = Yii::getAlias($assetBundle->sourcePath);
		$fileOptions = ['depends' => MarkItUpAsset::className()];
		$view = $this->getView();
		// Add setting JS/CSS
		$settingKey = "markitup-set-{$this->setName}";
		$view->registerJsFile("{$assetPath}/sets/{$this->setName}/set.js", $fileOptions, $settingKey)
		$view->registerCssFile("{$assetPath}/sets/{$this->setName}/style.css", $fileOptions, $settingKey);
		// Add skin CSS
		$view->registerCssFile("{$assetPath}/skins/{$this->skin}/style.css", $fileOptions, "markitup-skin-{$this->skinName}");
		// Add addons JS/CSS
		foreach ($this->addons as $addon) {
			$addonKey = "markitup-addon-{$addon}";
			$view->registerJsFile("{$assetPath}/addons/{$addon}/set.js", $fileOptions, $addonKey);
			$view->registerCssFile("{$assetPath}/addons/{$addon}/style.css", $fileOptions, $addonKey);
		}
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
		$this->renderModalPreview();
	}

	public function renderModalPreview()
	{
		echo Html::beginTag('div', ['id' => 'miuPreview', 'class' => 'modal']);
		echo Html::beginTag('div', ['class' => 'modal-dialog']);
		echo Html::beginTag('div', ['class' => 'modal-content']);
		echo Html::beginTag('div', ['class' => 'modal-header']);
		echo Html::button('&times;', ["class" => "close", "data-dismiss" => "modal", "aria-hidden" => "true"]);
		echo Html::tag('h4', 'Preview', ['class' => 'modal-title']);
		echo Html::endTag('div');
		echo Html::tag('div', '', ['class' => 'modal-body']);
		echo Html::endTag('div');
		echo Html::endTag('div');
		echo Html::endTag('div');
	}
}
