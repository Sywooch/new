<?php
/**
 * File: test.php
 * Email: becksonq@gmail.com
 * Date: 18.01.2018
 * Time: 19:54
 */
?>

<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <li class="template-download fade">

       <ul class="list-unstyled">
					<li class="preview">
							{% if (file.thumbnailUrl) { %}
									<a class="thumbnail" href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
							{% } %}

					</li>

					<li class="buttons">

					{% if (file.deleteUrl) { %}

					<button class="btn btn-danger btn-xs delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
							<i class="fa fa-trash" aria-hidden="true"></i>
							<span><?= Yii::t( 'fileupload', 'Delete' ) ?></span>
					</button>

					{% } else { %}
							<button class="btn btn-warning btn-xs cancel">
									<i class="fa fa-ban" aria-hidden="true"></i>
									<span><?= Yii::t( 'fileupload', 'Cancel' ) ?></span>
							</button>
					{% } %}

					<li>

       </ul>

    </li>
{% } %}


</script>
