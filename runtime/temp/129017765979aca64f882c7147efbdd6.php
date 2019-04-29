<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:80:"C:\phpEnv\www\localhost\zhihui\public/../application/user\view\user\profile.html";i:1554791438;s:72:"C:\phpEnv\www\localhost\zhihui\application\user\view\layout\default.html";i:1554791438;s:69:"C:\phpEnv\www\localhost\zhihui\application\user\view\layout\meta.html";i:1554791438;s:71:"C:\phpEnv\www\localhost\zhihui\application\user\view\layout\script.html";i:1554791438;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $site['languages']['frontend']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <style>
    .profile-avatar-container {
        position: relative;
        width: 100px;
    }

    .profile-avatar-container .profile-user-img {
        width: 100px;
        height: 100px;
    }

    .profile-avatar-container .profile-avatar-text {
        display: none;
    }

    .profile-avatar-container:hover .profile-avatar-text {
        display: block;
        position: absolute;
        height: 100px;
        width: 100px;
        background: #444;
        opacity: .6;
        color: #fff;
        top: 0;
        left: 0;
        line-height: 100px;
        text-align: center;
    }

    .profile-avatar-container button {
        position: absolute;
        top: 0;
        left: 0;
        width: 100px;
        height: 100px;
        opacity: 0;
    }
</style>
<div class="row animated fadeInRight">
    <div class="col-md-4">
        <div class="box box-success">
            <div class="panel-heading">
                <?php echo __('Profile'); ?>
            </div>
            <div class="panel-body">
                <form id="profile-form" role="form" data-toggle="validator" method="POST" action="<?php echo url('api/user/profile'); ?>">
                    <?php echo token(); ?>
                    <input type="hidden" name="avatar" id="c-avatar" value="<?php echo $user['avatar']; ?>"/>
                    <div class="box-body box-profile">
                        <div class="profile-avatar-container">
                            <img class="profile-user-img img-responsive img-circle plupload" src="<?php echo $user['avatar']; ?>" alt="">
                            <div class="profile-avatar-text img-circle"><?php echo __('Click to edit'); ?></div>
                            <button id="plupload-avatar" class="plupload" data-mimetype="png,jpg,jpeg,gif" data-input-id="c-avatar"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button>
                        </div>
                        <h3 class="profile-username text-center"><?php echo $user['username']; if($user['level']>0): ?><img width="20" height="20" src="<?php echo $user['level_img']; ?>" title="<?php echo $user['level_name']; ?>"/><?php endif; ?>
                        </h3>
                        <div class="form-group">
                            <label class="control-label"><?php echo __('Nickname'); ?>:</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $user['nickname']; ?>" data-rule="required" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="c-bio" class="control-label"><?php echo __('Intro'); ?>:</label>
                            <input id="c-bio" data-rule="" data-tip="一句话介绍一下你自己" class="form-control" name="bio" type="text" value="<?php echo $user['bio']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="c-email" class="control-label"><?php echo __('Email'); ?>:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="c-email" name="email" value="<?php echo $user['email']; ?>" disabled placeholder="">
                                <span class="input-group-btn" style="padding:0;border:none;">
                                    <a href="javascript:;" class="btn btn-info btn-change" data-type="email"><?php echo __('Change'); ?></a>
                                </span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="c-mobile" class="control-label"><?php echo __('Mobile'); ?>:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="c-mobile" name="mobile" value="<?php echo $user['mobile']; ?>" disabled placeholder="">
                                <span class="input-group-btn" style="padding:0;border:none;">
                                    <a href="javascript:;" class="btn btn-info btn-change" data-type="mobile"><?php echo __('Change'); ?></a>
                                </span>
                            </div>

                        </div>
                        <div class="form-group normal-footer text-center">
                            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('Ok'); ?></button>
                            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-default panel-intro panel-nav">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-list"></i> 基本信息</a></li>
                    <li><a href="#two" data-toggle="tab"><i class="fa fa-circle-o"></i> </a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="one">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo __('Lv'); ?></b> <a class="pull-right"><?php echo $user['level']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo __('Balance'); ?></b> <a class="pull-right"><?php echo (isset($user['money']) && ($user['money'] !== '')?$user['money']:0); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo __('Score'); ?></b> <a class="pull-right"><?php echo $user['score']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo __('Successions'); ?></b> <a class="pull-right"><?php echo $user['successions']; ?> <?php echo __('Day'); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo __('Maxsuccessions'); ?></b> <a class="pull-right"><?php echo $user['maxsuccessions']; ?> <?php echo __('Day'); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo __('Logintime'); ?></b> <a class="pull-right"><?php echo date("Y-m-d H:i:s",$user['logintime']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo __('Prevtime'); ?></b> <a class="pull-right"><?php echo date("Y-m-d H:i:s",$user['prevtime']); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="two">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/html" id="emailtpl">
    <form id="email-form" class="form-horizontal form-layer" method="POST" action="<?php echo url('api/user/changeemail'); ?>">
        <div class="form-body">
            <input type="hidden" name="action" value="changeemail"/>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3"><?php echo __('New Email'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <input type="text" class="form-control" id="email" name="email" value="" data-rule="required;email;remote(<?php echo url('api/validate/check_email_available'); ?>, event=changeemail, id=<?php echo $user['id']; ?>)" placeholder="<?php echo __('New email'); ?>">
                    <span class="msg-box"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3"><?php echo __('Captcha'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <div class="input-group">
                        <input type="text" name="captcha" id="email-captcha" class="form-control" data-rule="required;length(4);integer[+];remote(<?php echo url('api/validate/check_ems_correct'); ?>, event=changeemail, email:#email)"/>
                        <span class="input-group-btn" style="padding:0;border:none;">
                            <a href="javascript:;" class="btn btn-info btn-captcha" data-url="<?php echo url('api/ems/send'); ?>" data-type="email" data-event="changeemail">获取验证码</a>
                        </span>
                    </div>
                    <span class="msg-box"></span>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <div class="form-group" style="margin-bottom:0;">
                <label class="control-label col-xs-12 col-sm-3"></label>
                <div class="col-xs-12 col-sm-8">
                    <button type="submit" class="btn btn-md btn-info"><?php echo __('Submit'); ?></button>
                </div>
            </div>
        </div>
    </form>
</script>
<script type="text/html" id="mobiletpl">
    <form id="mobile-form" class="form-horizontal form-layer" method="POST" action="<?php echo url('api/user/changemobile'); ?>">
        <div class="form-body">
            <input type="hidden" name="action" value="changemobile"/>
            <div class="form-group">
                <label for="c-mobile" class="control-label col-xs-12 col-sm-3"><?php echo __('New mobile'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <input type="text" class="form-control" id="mobile" name="mobile" value="" data-rule="required;mobile;remote(<?php echo url('api/validate/check_mobile_available'); ?>, event=changemobile, id=<?php echo $user['id']; ?>)" placeholder="<?php echo __('New mobile'); ?>">
                    <span class="msg-box"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="mobile-captcha" class="control-label col-xs-12 col-sm-3"><?php echo __('Captcha'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <div class="input-group">
                        <input type="text" name="captcha" id="mobile-captcha" class="form-control" data-rule="required;length(4);integer[+];remote(<?php echo url('api/validate/check_sms_correct'); ?>, event=changemobile, mobile:#mobile)"/>
                        <span class="input-group-btn" style="padding:0;border:none;">
                            <a href="javascript:;" class="btn btn-info btn-captcha" data-url="<?php echo url('api/sms/send'); ?>" data-type="mobile" data-event="changemobile">获取验证码</a>
                        </span>
                    </div>
                    <span class="msg-box"></span>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <div class="form-group" style="margin-bottom:0;">
                <label class="control-label col-xs-12 col-sm-3"></label>
                <div class="col-xs-12 col-sm-8">
                    <button type="submit" class="btn btn-md btn-info"><?php echo __('Submit'); ?></button>
                </div>
            </div>
        </div>
    </form>
</script>
<style>
    .form-layer {
        height: 100%;
        min-height: 150px;
        min-width: 300px;
    }

    .form-body {
        width: 100%;
        overflow: auto;
        top: 0;
        position: absolute;
        z-index: 10;
        bottom: 50px;
        padding: 15px;
    }

    .form-layer .form-footer {
        height: 50px;
        line-height: 50px;
        background-color: #ecf0f1;
        width: 100%;
        position: absolute;
        z-index: 200;
        bottom: 0;
        margin: 0;
    }

    .form-footer .form-group {
        margin-left: 0;
        margin-right: 0;
    }
</style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-userend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>


    </body>
</html>