<?php
namespace coderlex\markitup;

use yii\web\AssetBundle;

class MarkItUpAsset extends AssetBundle
{
	public $sourcePath = '@bower/markitup/markitup';
	public $js = ['jquery.markitup.js'];
	public $depends = ['yii\web\JqueryAsset'];
}
