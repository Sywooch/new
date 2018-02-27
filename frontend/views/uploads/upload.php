<?php
?>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <li class="template-upload fade">
        <ul class="list-unstyled">
            <li class="preview thumbnail"></li>
            <li class="buttons">
								{% if (!i && !o.options.autoUpload) { %}
										<button class="btn btn-primary btn-xs start" disabled>
												<i class="fa fa-trash" aria-hidden="true"></i>
												<span><?= Yii::t( 'fileupload', 'Start' ) ?></span>
										</button>
								{% } %}
								{% if (!i) { %}
										<button class="btn btn-warning btn-xs cancel">
												<i class="fa fa-ban" aria-hidden="true"></i>
												<span><?= Yii::t( 'fileupload', 'Cancel' ) ?></span>
										</button>
								{% } %}
            </li>
        </ul>
    </li>
{% } %}
</script>
