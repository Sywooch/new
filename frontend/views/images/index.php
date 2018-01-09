<?php
/**
 * User: beckson
 * Date: 15.12.2017
 * Time: 12:51
 * Email: becksonq@gmail.com
 */
use dosamigos\fileupload\FileUpload;
use yii\web\View;
use frontend\assets\ImagesAsset;

ImagesAsset::register( $this );

// without UI
?>

<? /*= FileUpload::widget( [
    'model'         => $model,
    'attribute'     => 'image',
    'url'           => [ 'images/image-upload', 'id' => $model->id ], // your url, this is just for demo purposes,
    'options'       => [ 'accept' => 'image/*' ],
    'clientOptions' => [
        'maxFileSize' => 2000000
    ],
    // Also, you can specify jQuery-File-Upload events
    // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
    'clientEvents'  => [
        'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
    ],
] );
*/ ?>

<?php
use dosamigos\fileupload\FileUploadUI;

// with UI
?>

<!--<div id="dropzone" class="fade well">Drop files here</div>-->


<?= FileUploadUI::widget( [
    'model'         => $model,
    'attribute'     => 'image',
    'url'           => [ 'images/image-upload', 'id' => $model->id ],
    'gallery'       => false,
    'fieldOptions'  => [
        'accept' => 'image/*'
    ],
    'clientOptions' => [
//    		'acceptFileTypes' => '/(\.|\/)(gif|jpe?g|png)$/i',
        'maxFileSize' => 2000000,
				'minFileSize' => 100,
				'maxNumberOfFiles' => 4,
    ],
    // ...
    'clientEvents'  => [
    		'fileuploadprocessdone' => 'function(e, data) {
    		
    				console.log("Processing " + data.files[data.index].name + " done . ");
    		}',
        'fileuploaddone' => 'function(e, data) {
       
        		$.each(data.files, function (index, file) {
								console.log("Added file: " + file.name);
						});
                                console.log( "Event: " + e);
                                console.log( "Data: " + data ) ;
										console.log( "Result: " + data.result );
										console.log( "Text status: " + data.textStatus );
										console.log( "Data jq: " + data.jqXHR );
										console.log( "Data context: " + data.context );
                            }',
        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
//				'fileuploadsubmit' => 'function(e, data) {
//						var input = $("#input");
//						data.formData = {example: input.val()};
//						if (!data.formData.example) {
//								data.context.find("button").prop("disabled", false);
//								input.focus();
//								return false;
//						}
//				}',
    ],
] );

?>

