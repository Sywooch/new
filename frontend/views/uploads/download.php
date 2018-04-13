<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
<div class="col-sm-4 template-download fade">
    <div class="panel panel-default">

       <ul class="list-unstyled">
					<li class="preview">
									<img src="{%=file.thumbnailUrl%}">
					</li>

					<li class="buttons">
						{% if (file.deleteUrl) { %}
							<button class="btn btn-danger delete" title="Удалить" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"
								{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button>

						{% } else { %}
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
