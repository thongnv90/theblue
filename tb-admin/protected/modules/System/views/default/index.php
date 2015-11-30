<?php
/* @var $this DefaultController */
/* @var systemModel */
?>
<h1>Systems</h1>
<div id="content-system">
    <table cellpadding="8">
        <tr>
            <th><?php echo YII::t('lang',Systems::model()->getConfigSys('d_titlepage')->sys_name) ;?></th>
            <td><input type="text" primary_key="<?php echo Systems::model()->getConfigSys('d_titlepage')->sys_id; ?>" value="<?php echo Systems::model()->getConfigSys('d_titlepage')->sys_value;?>" id="sys_titlepage" name="sys_titlepage" /></td>
        </tr>
        <tr>
            <th><?php echo YII::t('lang',Systems::model()->getConfigSys('d_email')->sys_name);?></th>
            <td><input type="text" primary_key="<?php echo Systems::model()->getConfigSys('d_email')->sys_id; ?>" value="<?php echo Systems::model()->getConfigSys('d_email')->sys_value;?>" id="sys_email" name="sys_email" /></td>
        </tr>
        <tr>
            <th><?php echo YII::t('lang',Systems::model()->getConfigSys('d_day')->sys_name);?></th>
            <td>
                <?php $format_day = Systems::model()->getConfigSys('d_day')->sys_value ; ?>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_day')->sys_id; ?>" value="d-m-Y" id="sys_day" name="formatday" <?php echo ($format_day=="d-m-Y") ? "checked" : ""; ?> /> <?php echo date('d-m-Y') ?></label>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_day')->sys_id; ?>" value="m-d-Y" id="sys_day" name="formatday" <?php echo ($format_day=="m-d-Y") ? "checked" : ""; ?> /> <?php echo date('m-d-Y') ?></label>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_day')->sys_id; ?>" value="d M, Y" id="sys_day" name="formatday" <?php echo ($format_day=="d M, Y") ? "checked" : ""; ?> /> <?php echo date('d M, Y') ?></label>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_day')->sys_id; ?>" value="M d, Y" id="sys_day" name="formatday" <?php echo ($format_day=="M d, Y") ? "checked" : ""; ?> /> <?php echo date('M d, Y') ?></label>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_day')->sys_id; ?>" value="Y-m-d" id="sys_day" name="formatday" <?php echo ($format_day=="Y-m-d") ? "checked" : ""; ?> /> <?php echo date('Y-m-d') ?></label>
            </td>
        </tr>
        <tr>
            <th><?php echo YII::t('lang',Systems::model()->getConfigSys('d_time')->sys_name);?></th>
            <td>
                <?php $format_day = Systems::model()->getConfigSys('d_time')->sys_value; ?>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_time')->sys_id; ?>" id="sys_time" value="H:i" value="timeHi" name="formattime" <?php echo ($format_day=="H:i") ? "checked" : ""; ?> /> <?php echo date('H:i') ?></label>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_time')->sys_id; ?>" id="sys_time" value="H:i:s" value="timeHis" name="formattime" <?php echo ($format_day=="H:i:s") ? "checked" : ""; ?> /> <?php echo date('H:i:s') ?></label>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_time')->sys_id; ?>" id="sys_time" value="h:i a" value="timehia" name="formattime" <?php echo ($format_day=="h:i a") ? "checked" : ""; ?> /> <?php echo date('h:i a') ?></label>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_time')->sys_id; ?>" id="sys_time" value="h:i:s a" value="timehisa" name="formattime" <?php echo ($format_day=="h:i:s a") ? "checked" : ""; ?> /> <?php echo date('h:i:s a') ?></label>
  
            </td>
        </tr>
        <tr>
            <th><?php echo YII::t('lang',Systems::model()->getConfigSys('d_currency')->sys_name);?></th>
            <td>
                <label><input type="text" primary_key="<?php echo Systems::model()->getConfigSys('d_currency')->sys_id; ?>" value="<?php echo Systems::model()->getConfigSys('d_currency')->sys_value;?>" id="sys_currency" name="d_currency" /></label>
            </td>
        </tr>
        <tr>
            <th><?php echo YII::t('lang',Systems::model()->getConfigSys('d_language')->sys_name);?></th>
            <td>
                <?php echo CHtml::dropDownList('sys_language',Systems::model()->getConfigSys('d_language')->sys_value, Systems::model()->ArrLanguage(),array(
                        'primary_key'=>Systems::model()->getConfigSys('d_language')->sys_id
                )); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td align="left">
                <?php
                    $this->widget('bootstrap.widgets.TbButton',array(
                        'label'=>'<i class="icon-ok icon-white"></i>&nbsp;'.YII::t('lang','Save'),
                        'type'=>'primary',
                        'size'=>'normal',
                        'encodeLabel'=>false,
                        'buttonType'=>'button',
                        'htmlOptions'=> array('onclick' => 'updateSysytem()'),
                    ));
                ?>
            </td>
        </tr>
        <tr>
            <th><?php echo YII::t('lang',Systems::model()->getConfigSys('d_check_comment')->sys_name);?></th>
            <td>
                <?php $check_comment = Systems::model()->getConfigSys('d_check_comment')->sys_value ; ?>
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_check_comment')->sys_id; ?>" value="1" id="sys_check_comment" name="sys_check_comment" <?php echo ($check_comment==1 ? "checked" : ""); ?> /> Kiểm duyệt trước khi hiện thị</label
                <label><input type="radio" primary_key="<?php echo Systems::model()->getConfigSys('d_check_comment')->sys_id; ?>" value="0" id="sys_check_comment" name="sys_check_comment" <?php echo ($check_comment==0 ? "checked" : ""); ?> /> Không cần kiểm duyệt trước khi hiện thị</label>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    function updateSysytem()
    {
        var titlepage_id = $( "#sys_titlepage" ).attr( "primary_key" );
        var titlepage_value = $( "#sys_titlepage" ).val();
        var email_id = $( "#sys_email" ).attr( "primary_key" );
        var email_value = $( "#sys_email" ).val();
        var daycheck = document.getElementsByName('formatday');
        var day_id = "";
        var day_value = "";
        for(var i=0; i< daycheck.length; i++) {
            if(daycheck[i].checked)
            {
                day_id  = $( "#sys_day" ).attr( "primary_key" );
                day_value = daycheck[i].value;
            }
        }
        
        var timecheck = document.getElementsByName('formattime');
        var time_id = "";
        var time_value = "";
        for(var i=0; i< timecheck.length; i++) {
            if(timecheck[i].checked)
            {
                time_id  = $( "#sys_time" ).attr( "primary_key" );
                time_value = timecheck[i].value;
            }
        }
        var currency_id = $( "#sys_currency" ).attr( "primary_key" );
        var currency_value = $( "#sys_currency" ).val();
        var lang_id = $( "#sys_language" ).attr( "primary_key" );
        var lang_value = $( "#sys_language" ).val();
        var check_comment_id = $( "#sys_check_comment" ).attr$('primary_key');
        var check_comment = $('#sys_check_comment').val();
        
        $.ajax({
                type: 'Post',
                url: '<?php echo $this->createURL("updateSystem"); ?>',
                data:{
                    titlepage_id:titlepage_id,
                    titlepage_value:titlepage_value,
                    email_id:email_id,
                    email_value:email_value,
                    currency_id:currency_id,
                    currency_value:currency_value,
                    lang_id:lang_id,
                    lang_value:lang_value,
                    day_id:day_id,
                    day_value:day_value,
                    time_id:time_id,
                    time_value:time_value,
                    check_comment:check_comment,
                    check_comment_id:check_comment_id,
                },
                beforeSend:function(){
                    $('#content').block();
                },
            //'processData' => false,
                success:function(data){ 
                    $('#content').unblock();
                },
        })
        
    }
</script>