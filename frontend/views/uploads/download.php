<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="panel panel-default template-download fade">

       <ul class="list-unstyled">
       		<!-- -------------------------------------------------------------------- -->
					<li class="preview">
									<img src="{%=file.thumbnailUrl%}">
					</li>
					<!-- -------------------------------------------------------------------- -->
					<li class="buttons">
						{% if (file.deleteUrl) { %}
							<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"
								{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
									<i class="glyphicon glyphicon-trash"></i>
							</button>

						{% } else { %}
							<button class="btn btn-warning cancel">
									<i class="glyphicon glyphicon-ban-circle"></i>
							</button>
						{% } %}

					</li>
       </ul>

    </div>
{% } %}

</script>
