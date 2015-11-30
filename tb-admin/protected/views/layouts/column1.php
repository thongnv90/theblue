<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/app.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ssd-vertical-navigation.min.js" type="text/javascript" charset="utf-8"></script>
<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/app.js" type="text/javascript" charset="utf-8"></script>-->
<main class="cd-main-content">
		<nav class="cd-side-nav">
			<ul>
				<li class="has-children homve active">
					    <?php
                                                echo TBApplication::workspaceLink(
                                                    '<i class="icontb-home icontb-white"></i> <span class="labeltb-menu-left">Trang chủ</span>',
                                                    YII::app()->createUrl('/'),
                                                    array('data-toggle'=>"tooltip", 'title'=>"Trang chủ"));
                                           ?>
				</li>
				<li class="has-children page">
					 <?php
                                            echo TBApplication::workspaceLink(
                                                '<i class="icontb-page icontb-white"></i> <span class="labeltb-menu-left">Trang</span>',
                                                YII::app()->createUrl('Pages/default/admin'),
                                                array('data-toggle'=>"tooltip", 'title'=>"Trang"));
                                       ?>
					
					<ul>
						<li><a href="#0">Tất cả trang</a></li>
						<li><a href="#0">Thêm trang</a></li>
					</ul>
				</li>

				<li class="has-children post">
                          <?php
                                echo TBApplication::workspaceLink(
                                    '<i class="icontb-post icontb-white"></i> <span class="labeltb-menu-left">Bài viết</span>',
                                    YII::app()->createUrl('Post/default/admin'),
                                    array('data-toggle'=>"tooltip", 'title'=>"Bài viết"));
                           ?>
					
					<ul>
						<li><a href="#0">Tất cả bài viết</a></li>
						<li><a href="#0">Thêm bài viết</a></li>
						<li><a href="#0">Danh mục</a></li>
					</ul>
				</li>
				<li class="has-children comment">
                            <?php
                                echo TBApplication::workspaceLink(
                                    '<i class="icontb-comment icontb-white"></i> <span class="labeltb-menu-left">Phản hồi</span>',
                                    YII::app()->createUrl('Comments/default/admin'),
                                    array('data-toggle'=>"tooltip", 'title'=>"Phản hồi"));
                           ?>
				</li>
				<li class="has-children images">
                           <?php
                                echo TBApplication::workspaceLink(
                                    '<i class="icontb-lib icontb-white"></i> <span class="labeltb-menu-left">Thư viện</span>',
                                    YII::app()->createUrl('Documents/default/admin'),
                                    array('data-toggle'=>"tooltip", 'title'=>"Thư viện"));
                           ?>
				</li>

				<li class="has-children member">
                                    <?php
                                        echo TBApplication::workspaceLink(
                                            '<i class="icontb-member icontb-white"></i> <span class="labeltb-menu-left">Thành viên</span>',
                                            YII::app()->createUrl('Members/default/admin'),
                                            array('data-toggle'=>"tooltip", 'title'=>"Thành viên"));
                                   ?>
					
					<ul>
						<li><a href="#0">Tất cả thành viên</a></li>
						<li><a href="#0">Thêm thành viên</a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<div class="content-wrapper">
			<?php echo $content; ?>
		</div> <!-- .content-wrapper -->
	</main> <!-- .cd-main-content -->
<?php $this->endContent(); ?>