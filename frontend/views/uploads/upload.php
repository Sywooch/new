<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
<div class="col-sm-4 template-upload fade">
    <div class="panel panel-default">

        <ul class="list-unstyled">
            <li class="preview"></li>

            <li class="buttons">
								{% if (!i && !o.options.autoUpload) { %}
										<button class="btn btn-primary btn-xs start" disabled>
												<i class="fa fa-trash" aria-hidden="true"></i>
												<span><?= Yii::t( 'fileupload', 'Start' ) ?></span>
										</button>
								{% } %}
								{% if (!i) { %}
										<button class="btn btn-warning cancel" title="Отменить">
												<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
										</button>
								{% } %}
            </li>
        </ul>

    </div>
</div>
{% } %}
</script>
