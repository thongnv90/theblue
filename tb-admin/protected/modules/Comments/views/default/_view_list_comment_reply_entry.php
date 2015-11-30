   <?php foreach ($modelReply->search()->data as $modelReplyItem) { ?>
        <div  class="comments-thread" style="width: 100%;clear: both;overflow: hidden;margin-bottom: 20px;">
            <div id="comment-thread-<?php echo $modelReplyItem->comment_id; ?>">

                <div class="comment-content-container-<?php echo $modelReplyItem->comment_id; ?>" style="overflow: hidden;">

                    <div style="width: 55px; float: left;" class="comment-profile-photo-<?php echo $modelReplyItem->comment_id; ?>" >
                            <a href="#" rel="tooltip" style="display: inline-block;">
                                <img class="images_circle_50"  alt="images user" src="<?php echo Yii::app()->getBaseUrl().'/images/no-user.png' ?>">
                            </a> 
                    </div>

                    <div class="comment-content-<?php echo $modelReplyItem->comment_id; ?>">
                            <b><?php echo $modelReplyItem->comment_name.":"; ?></b>
                            <span id="comment-description-<?php echo $modelReplyItem->comment_id; ?>">
                                <?php echo $modelReplyItem->comment_content; ?>
                            </span>
                    </div>
                </div>

                <!-- Footer Comment -->
                <div class="comment-footer">
                    Ngày đăng: update
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-comment"></i>
                        <a id="" class="blur-summary"
                           onclick="load_form_comment_reply(<?php echo $modelReplyItem->comment_entry_id ; ?>,<?php echo $modelReplyItem->comment_id; ?>,<?php echo $modelReplyItem->comment_parent; ?> );return false"
                           href="#form_redly_comment-<?php echo $modelReplyItem->comment_id; ?>">Trả lời</a>
                </div>
            </div>
            <div id="form-comment-reply-<?php echo $modelReplyItem->comment_id; ?>" class="form-coment-reply"></div>
        </div>
    <?php } ?>
