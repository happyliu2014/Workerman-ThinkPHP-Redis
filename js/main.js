+function ($) {
	var dialogDiv = $('#dialog');
	dialogFix();

    //监听事件
    $('#textarea').keydown(function(evt){
        //console.log(evt.keyCode);
        //console.log(evt.ctrlKey);
        //同时按下ctrl+enter
        if(evt.keyCode == 13 && evt.ctrlKey == true) {
            onSubmit();
        }

    });

}(jQuery);

function dialogFix() {
	//滚动条自动定位
	var dialogDiv = $('#dialog');
	dialogDiv.scrollTop(dialogDiv[0].scrollHeight);
}
