<?php
/*@var $this Controller*/
/*@var $model Document*/

//$this->widget('bootstrap.widgets.TbGridView',array(
//    'id'=>'document-grid',
//    'dataProvider'=>$model,
//    'template'=>'{items}{pager}',
//    'hideHeader'=>true,
//    'columns'=>array(
//        array(
//            'header'=>false,
//            'type'=>'raw',
//            'name'=>'document_url',
//            'value'=>function($data){
//                return '<img src="'.YII::app()->baseUrl.$data->document_url.'" width="100" />';
//            },
//        ),
//        array(
//            'class'=>'bootstrap.widgets.tbButtonColumn',
//            'template'=>'{delete}'
//        )
//    ),
//));
?>
<div>
    <ul style="margin:0;">
        <?php foreach ($model->data as $items) {
            echo '<li style="list-style:none;">'
                    . '<img src="'.YII::app()->baseUrl.$items->document_url.'" width="100" />'
                    . '<i class="icon-remove" style="position: relative;right: 10px; top: -33px;"></i>'
                 . '</li>';
        } ?>
        
    </ul>
</div>
