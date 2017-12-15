<?php
/**
 * User: beckson
 * Date: 15.12.2017
 * Time: 12:51
 * Email: becksonq@gmail.com
 */
use dosamigos\fileupload\FileUpload;

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
<?= FileUploadUI::widget( [
    'model'         => $model,
    'attribute'     => 'image',
    'url'           => [ 'images/image-upload', 'id' => $model->id ],
    'gallery'       => false,
    'fieldOptions'  => [
        'accept' => 'image/*'
    ],
    'clientOptions' => [
        'maxFileSize' => 2000000
    ],
    // ...
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
?>
