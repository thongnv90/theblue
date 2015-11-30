<?php foreach ($model->search()->data as $commentItem) { ?>
    <div id="comments-thread" class="comments-thread">
        <div id="comment-thread-<?php echo $commentItem->comment_id; ?>">
            
            <div class="comment-content-container-<?php echo $commentItem->comment_id; ?>" style="overflow: hidden;">
                
                <div style="width: 55px; float: left;" class="comment-profile-photo-<?php echo $commentItem->comment_id; ?>" >
                        <a href="#" rel="tooltip" style="display: inline-block;">
                            <img class="images_circle_50" alt="images user" src="<?php echo Yii::app()->getBaseUrl().'/images/no-user.png' ?>">
                        </a> 
                </div>
                
                <div class="comment-content-<?php echo $commentItem->comment_id; ?>">
                        <b><?php echo $commentItem->comment_name.":"; ?></b>
                        <span id="comment-description-<?php echo $commentItem->comment_id; ?>">
                            <?php echo $commentItem->comment_content; ?>
                        </span>
                </div>
            </div>
            
            <!-- Footer Comment -->
            <div class="comment-footer">
                Ngày đăng: update
                &nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-comment"></i>
                    <a id="" class="blur-summary" 
                       onclick="load_form_comment_reply(<?php echo $commentItem->comment_entry_id ; ?>,<?php echo $commentItem->comment_id; ?>,<?php echo $commentItem->comment_id; ?>);return false"
                       href="#form-comment-reply-<?php echo $commentItem->comment_id; ?>">Trả lời</a>
            </div>
        </div>
        <div id="form-comment-reply-<?php echo $commentItem->comment_id; ?>" class="form-coment-reply"></div>
    </div>
    <div id="view-list-comments-reply-<?php echo $commentItem->comment_id; ?>" class="comments-thread-reply">
        <?php
                $modelReply=new Comment('search');
                $modelReply->unsetAttributes();  // clear any default values
                $modelReply->comment_parent = $commentItem->comment_id;
                $this->renderPartial('Comments.views.default._view_list_comment_reply_entry',array(
                        'modelReply'=>$modelReply,
                ));
        ?>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
    function load_form_comment_reply(post_id,comment_id,parent_root){
       $(".form-comment").hide();
       $('#form-comment-reply-'+comment_id).load('<?php echo $this->createUrl('/Comments/default/commentMember'); ?>',
            {entry:'<?php echo Post::ENTRY; ?>',entry_id:post_id,parent:comment_id,parent_root:parent_root});
    }
</script>
