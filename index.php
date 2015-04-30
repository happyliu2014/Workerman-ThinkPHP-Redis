<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HappyLiu's VPS</title>
    <!-- Bootstrap -->
    <link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!--你自己的样式文件 -->
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript">
        var room_id = <?php echo isset($_GET['room_id']) ? $_GET['room_id'] : 1; ?>
    </script>
    <!-- 以下两个插件用于在IE8以及以下版本浏览器支持HTML5元素和媒体查询，如果不需要用可以移除 -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Include these three JS files: -->
    <script type="text/javascript" src="/js/swfobject.js"></script>
    <script type="text/javascript" src="/js/web_socket.js"></script>
    <script type="text/javascript" src="/js/json.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/chat.js"></script>
</head>
<body>
<div class="container">
    <button class="btn btn-primary btn-lg btn-block">HappyLiu's Study Share VPS</button>
    <p></p>
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">请选择讨论组</div>
                <div class="panel-body">
                    <div class="btn-group-cs">
                        <?php $room_id = !isset($_GET['room_id'])? 1: intval($_GET['room_id']);?>
                        <button class="btn <?php if($room_id == 1) {echo 'btn-warning';} else {echo 'btn-info';} ?> btn-block" type="button"><a href="?room_id=1">PHP</a></button>
                        <button class="btn <?php if($room_id == 2) {echo 'btn-warning';} else {echo 'btn-info';} ?> btn-block" type="button"><a href="?room_id=2">W3C</a></button>
                        <button class="btn <?php if($room_id == 3) {echo 'btn-warning';} else {echo 'btn-info';} ?> btn-block" type="button"><a href="?room_id=3">C/C++</a></button>
                        <button class="btn <?php if($room_id == 4) {echo 'btn-warning';} else {echo 'btn-info';} ?> btn-block" type="button"><a href="?room_id=4">JAVA</a></button>
                        <button class="btn <?php if($room_id == 5) {echo 'btn-warning';} else {echo 'btn-info';} ?> btn-block" type="button"><a href="?room_id=5">SWIFT</a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">聊天窗口</div>
                <div class="panel-body">
                    <div class="thumbnail" id="dialogbox">
                        <div class="caption" id="dialog">

                        </div>
                    </div>
                    <form onsubmit="onSubmit(); return false;">
                        <select id="client_list" name="touser">
                            <option value="all">所有人</option>
                        </select>
                        <textarea class="textarea thumbnail" id="textarea"></textarea>
                        <div class="say-btn"><input type="submit" class="btn btn-primary" value="发表 [Ctrl+Enter]" /></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-success">
                <div class="panel-heading">在线用户</div>
                <div class="panel-body" id="userlist">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 如果要使用Bootstrap的js插件，必须先调入jQuery -->
<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
<!-- 包括所有bootstrap的js插件或者可以根据需要使用的js插件调用　-->
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
