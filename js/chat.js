/**
 * chat.js
 */
if (typeof console == "undefined") {
    this.console = {
        log: function (msg) {

        }
    };
}
//swf socket
WEB_SOCKET_SWF_LOCATION = "/swf/WebSocketMain.swf";
WEB_SOCKET_DEBUG = true;

var ws, name, client_list={}, timeid, reconnect=false;

function init() {
    // 创建websocket
    ws = new WebSocket("ws://"+document.domain+":7272");
    // 当socket连接打开时，输入用户名
    ws.onopen = function() {
        timeid && window.clearInterval(timeid);
        if (!name) {
            show_prompt();
        }
        if (!name) {
            return ws.close();
        }
        if(reconnect == false) {
            // 登录
            var login_data = JSON.stringify({"type":"login","client_name":name,"room_id":room_id});
            console.log("websocket握手成功，发送登录数据:"+login_data);
            ws.send(login_data);
            reconnect = true;
        } else {
            // 断线重连
            var relogin_data = JSON.stringify({"type":"re_login","client_name":name,"room_id":room_id});
            console.log("websocket握手成功，发送重连数据:"+relogin_data);
            ws.send(relogin_data);
        }
    };

    // 当有消息时根据消息类型显示不同信息
    ws.onmessage = function(e) {
        console.log(e.data);
        var data = JSON.parse(e.data);
        switch(data['type']){
            // 服务端ping客户端
            case 'ping':
                ws.send(JSON.stringify({"type":"pong"}));
                break;
            // 登录更新用户列表
            case 'login':
                //{"type":"login","client_id":xxx,"client_name":"xxx","client_list":"[...]","time":"xxx"}
                say(data['client_id'], data['client_name'],  data['client_name']+' 加入了讨论组', data['time']);
                flush_client_list(data['client_list']);
                console.log(data['client_name']+"登录成功");
                break;
            // 断线重连，只更新用户列表
            case 're_login':
                //{"type":"re_login","client_id":xxx,"client_name":"xxx","client_list":"[...]","time":"xxx"}
                flush_client_list(data['client_list']);
                console.log(data['client_name']+"重连成功");
                break;
            // 发言
            case 'say':
                //{"type":"say","from_client_id":xxx,"to_client_id":"all/client_id","content":"xxx","time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['content'], data['time']);
                break;
            // 用户退出 更新用户列表
            case 'logout':
                //{"type":"logout","client_id":xxx,"time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['from_client_name']+' 退出了', data['time']);
                flush_client_list(data['client_list']);
                break;
        }
    };

    // 关闭链接时
    ws.onclose = function() {
        console.log("连接关闭，定时重连");
        // 定时重连
        window.clearInterval(timeid);
        timeid = window.setInterval(init, 3000);
    };

    // 有错误时
    ws.onerror = function() {
        console.log("出现错误");
    };
}

// 输入姓名
function show_prompt(){
    name = prompt('输入你的名字：', '');
    if(!name || name=='null'){
    alert("输入名字为空或者为'null'，请重新输入！");
    show_prompt();
    }
}

// 提交对话
function onSubmit() {
    var input = document.getElementById("textarea");
    var to_client_id = $("#client_list option:selected").attr("value");
    var to_client_name = $("#client_list option:selected").text();
    ws.send(JSON.stringify({"type":"say","to_client_id":to_client_id,"to_client_name":to_client_name,"content":input.value}));
    input.value = "";
    input.focus();
}

// 刷新用户列表框
function flush_client_list(client_list){
    var userlist_window = $("#userlist");
    var client_list_slelect = $("#client_list");
    userlist_window.empty();
    client_list_slelect.empty();
    userlist_window.append('<ol>');
    client_list_slelect.append('<option value="all" id="cli_all">所有人</option>');
    for (var p in client_list) {
        userlist_window.append('<li id="'+client_list[p]['client_id']+'">'+client_list[p]['client_name']+'</li>');
        client_list_slelect.append('<option value="'+client_list[p]['client_id']+'">'+client_list[p]['client_name']+'</option>');
    }
    $("#client_list").val(select_client_id);
    userlist_window.append('</ol>');
}

// 发言
function say(from_client_id, from_client_name, content, time) {
    var str = '<dl class="clearfix">';
    str += '<img src="http://lorempixel.com/38/38/?' + from_client_id + '" width="50" height="50" /> ';
    str += '<div class="msgcon text-primary"><dt class="text-danger">'+ from_client_name + ' <span class="text-info text-info">'+ time +'</span></dt>';
    str += '<dd>'+ content +'</dd>';
    str += '</div></dl>';
    $("#dialog").append(str);
    dialogFix();
}

// 初始化
$(function(){
    init();
    select_client_id = 'all';
    $("#client_list").change(function(){
        select_client_id = $("#client_list option:selected").attr("value");
    });
});
