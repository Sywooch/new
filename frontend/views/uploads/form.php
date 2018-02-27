<?php
/** @var \dosamigos\fileupload\FileUploadUI $this */
use yii\helpers\Html;

$context = $this->context;
?>
<!-- The file upload form used as target for the file upload widget -->
<?= Html::beginTag( 'div', $context->options ); ?>
<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
<div class="row fileupload-buttonbar">
	<div class="col-sm-12">
		<!-- The fileinput-button span is used to style the file input field as button -->
		<span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span><?= Yii::t( 'fileupload', 'Add files' ) ?>...</span>

        <?= $context->model instanceof \yii\base\Model && $context->attribute !== null
            ? Html::activeFileInput( $context->model, $context->attribute, $context->fieldOptions )
            : Html::fileInput( $context->name, $context->value, $context->fieldOptions ); ?>
		</span>
	</div>
	<!-- The global progress state -->
	<div class="col-sm-7 fileupload-progress fade">
		<!-- The global progress bar -->
		<div class="progress active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
			<div class="progress-bar-success progress-bar" style="width:0%;"></div>
		</div>
	</div>
</div>
<!-- The table listing the files available for upload/download -->
<div id="preview-container">
	<ul class="files list-unstyled"></ul>
</div>
<div class="clearfix"></div>
<?= Html::endTag( 'div' ); ?>
