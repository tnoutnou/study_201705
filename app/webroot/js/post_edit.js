var f_cnt = 0;
var f_max_cnt = $('#global-cont').attr('data-filemax');

$(function(){



$('#selectFile1').on('click', function() {

	strstr = '#inputFile' + (f_cnt + 1);
	$(strstr).trigger('click');
	

	
});

//$('.cls-inputFile').change(function() {
$("[id^='inputFile']").change(function() {

	strstr = '#selectedFile' + (f_cnt + 1);
	$(strstr).val($(this).val());
	  
  if (this.files.length > 0) {
    // 選択されたファイル情報を取得
    var file = this.files[0];
    
    // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
    var reader = new FileReader();
    reader.readAsDataURL(file);
    
	f_cnt = f_cnt + 1;
	if (f_cnt >= f_max_cnt) {
		$("#selectFile1").prop("disabled", true);
	}
    reader.onload = function() {
		str3 = reader.result;
		str2 = '<li id="add-li-img1" class="add-li-img"><img src="' + str3 + '" width=80 height=80 alt><span> 新規ファイル：' + file.name + '</span></li>';
		$('#img_ul').prepend(str2);
	}
  }

});


// Post　登録画面で利用
$('#addselectFile1').on('click', function() {
	strstr = '#addinputFile' + (f_cnt + 1);
	$(strstr).trigger('click');
});

// Post　登録画面で利用
$("[id^='addinputFile']").change(function() {

	strstr = '#addselectedFile' + (f_cnt + 1);
	$(strstr).val($(this).val());
	  
  if (this.files.length > 0) {
    // 選択されたファイル情報を取得
    var fd = new FormData();
	fd.append( "file", this.files[0] );
	fd.append("dir", "tmp");

	var now_dt = new Date();
	var now_dt_str = '' + now_dt.getFullYear() + (now_dt.getMonth()+1) + now_dt.getDate()
					+ now_dt.getHours() + now_dt.getMinutes() + now_dt.getSeconds();

	fd.append("file_pre", now_dt_str);
	
	var filename = this.files[0].name;
	var tmpfilename = now_dt_str + this.files[0].name;

	//
    var postData = {
		type : "POST",
		dataType : "text",
		data : fd,
		processData : false,
		contentType : false
	};
	
	$.ajax(
//	 "/cakephpc/posts/addFile", postData
	 "/posts/addFile", postData
	).done(function (text ){
//		console.log(text);

		f_cnt = f_cnt + 1;
		if (f_cnt >= f_max_cnt) {
			$("#addselectFile1").prop("disabled", true);
		}
		str2 = '<li id="add-li-img1" class="add-li-img"><img src="../app/webroot/img/tmp/' + tmpfilename + '" width=80 height=80 alt><span> 新規ファイル：' + filename + '</span></li>';
		$('#img_ul').prepend(str2);

	});

  };

});


// 新規で追加したファイルを削除
$('#delFilebtn').on('click', function() {
//	$('#add-li-img1').remove();
	$('.add-li-img').remove();

	$("[id^='inputFile']").val('');

	//カウント初期化
	f_cnt = 0;
	$("#selectFile1").prop("disabled", false);

	var postData = {
		type : "POST",
		dataType : "text",
		processData : false,
		contentType : false
	};

	
	$.ajax(
	 "/cakephpc/posts/delTmpFile", postData
	).done(function (text ){
		console.log(text);

	});
	
});


	
});

