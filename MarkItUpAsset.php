<?php
namespace yii\markitup;

use yii\web\AssetBundle;

class MarkItUpAsset extends AssetBundle
{
	public $sourcePath = '@bower/markitup';
	public $js = ['jquery.markitup.js'];
	public $depends = ['yii\web\JqueryAsset'];
}
