<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo get_assets_url('css_bootstrap');?>" rel="stylesheet">
    <title>本期预测</title>
  </head>

  <body>
    <div class="container" style="padding-top:88px;"> 
        <form class="form-horizontal" role="form" method="post" action="/lottery/combine">
           <?php if(!empty($result)): ?><div class="form-group">
             <label class="col-sm-2 control-label">合并结果</label>
             <div class="col-sm-6">
                <input type="text" class="form-control" id="result"  value="<?php echo ($result); ?>" readonly="readonly">
             </div>
           </div><?php endif; ?>

           <div class="form-group">
             <label for="sp_2" class="col-sm-2 control-label">皆有可能</label>
             <div class="col-sm-6">
                <input type="text" class="form-control" id="sp_2" name="sp_2" value="<?php echo ($sp_2); ?>">
             </div>
             <label for="sp_2" class="control-label">
                <a href="http://www.022822.com/mode.php?m=o&q=user&u=3502" target="_blank">查看</a> 10.23.13.34.41.15.25.04.16.03.01
             </label>
           </div>

           <div class="form-group">
             <label for="sp_1" class="col-sm-2 control-label">扬帆起航</label>
             <div class="col-sm-6">
                <input type="text" class="form-control" id="sp_1" name="sp_1" value="<?php echo ($sp_1); ?>">
             </div>
             <label for="sp_1" class="control-label">
                <a href="http://www.022822.com/mode.php?m=o&q=user&u=3468" target="_blank">查看</a> 01-25-37-12-36-48-18-30-42-08-20-32-10-34-46
             </label>
           </div>

           <div class="form-group">
             <label for="sp_3" class="col-sm-2 control-label">铺天盖地</label>
             <div class="col-sm-6">
                <input type="text" class="form-control" id="sp_3" name="sp_3" value="<?php echo ($sp_3); ?>">
             </div>
             <label for="sp_3" class="control-label">
                <a href="http://www.022822.com/mode.php?m=o&q=user&u=3517" target="_blank">查看</a> 12.24.22.34.14.38
             </label>
           </div>
           <div class="form-group">
             <label for="sp_4" class="col-sm-2 control-label">神仙之刃</label>
             <div class="col-sm-6">
                <input type="text" class="form-control" id="sp_4" name="sp_4" value="<?php echo ($sp_4); ?>">
             </div>
             <label for="sp_4" class="control-label">
                <a href="http://www.022822.com/mode.php?m=o&q=user&u=3540" target="_blank">查看</a> 01,25,37,12,24,36,48,06,18,30,42,08,20,32,10,34,46,31
             </label>
           </div>
           <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-primary">合并特码</button></div>
           </div>

        </form>
    </div>

    <!--[if lt IE 9]>
      <script src="<?php echo get_assets_url('js_html5shiv');?>"></script>
      <script src="<?php echo get_assets_url('js_respond');?>"></script>
    <![endif]-->
    <script src="<?php echo get_assets_url('js_jquery');?>"></script>
    <script src="<?php echo get_assets_url('js_bootstrap');?>"></script>
  </body>

</html>