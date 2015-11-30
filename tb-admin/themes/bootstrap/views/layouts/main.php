<?php /* @var $this Controller */ 
    $_SESSION['lang']=  TBApplication::getDefaultLangue();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/styles.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/reset.css"> <!-- CSS reset -->
            
        <?php Yii::app()->bootstrap->register(); ?>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.blockUI.js"></script>
       <!--<script src="<?php echo Yii::app()->baseUrl; ?>/js/application.js"></script>-->
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/theblue.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/sidebar/modernizr.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/sidebar/jquery.menu-aim.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/sidebar/main.js"></script>
</head>

<body>

	<header class="cd-main-header">
            <a href="<?php echo YII::app()->homeUrl;?>" style="color:#fff; font-size: 24px;" ><?php echo YII::app()->name;?></a>
		<a href="#0" class="cd-nav-trigger"><span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li>
                                        <?php
                                            echo TBApplication::workspaceLink(
                                                '<i class="icon-cog icon-white"></i> <span class="labeltb-menu-left">Cài đặt</span>',
                                                YII::app()->createUrl('System'),
                                                array('data-toggle'=>"tooltip", 'title'=>"Cài đặt"));
                                       ?>
                                </li>
				<li class="has-children account">
					<a href="#0">
						<?php echo CHtml::image(MemberProfile::model()->getProfileUrl(YII::app()->user->id), 'images_user', array('width'=>'100','class'=>'images_circle small','id'=>'member_images')); ?>
						Account
					</a>

					<ul>

                                            <li><a href="<?php echo YII::app()->createUrl('/Members/default/view/id/'.YII::app()->user->id) ?>">My Account</a></li>
                                            <li><a href="<?php echo YII::app()->createUrl('/site/logout'); ?>">Logout</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header> <!-- .cd-main-header -->


	<?php echo $content; ?>


	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by TheBluevn.<br/>
		All Rights Reserved.<br/>
	</div> 

</body>
</html>
