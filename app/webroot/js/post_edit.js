var f_cnt = 0;
var f_max_cnt = $('#global-cont').attr('data-filemax');

$(function(){

//$('#file-input-group2').css("display" , "none");
//$('#file-input-group3').css("display" , "none");
//$('#file-input-group2').hide();
//$('#file-input-group3').hide();

$('#selectFile1').on('click', function() {

	strstr = '#inputFile' + (f_cnt + 1);
	$(strstr).trigger('click');
	
//	if (f_cnt == 0) {
//		$('#inputFile1').trigger('click');
//	} else if (f_cnt == 1) {
//		$('#inputFile2').trigger('click');
//	}
	
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
//		str2 = '<li><img src="' + str3 + '" width=80 height=80 alt><a>' + file.name + '</a></li>';
		str2 = '<li id="add-li-img1" class="add-li-img"><img src="' + str3 + '" width=80 height=80 alt><span> 新規ファイル：' + file.name + '</span></li>';
		$('#img_ul').prepend(str2);

	}

  }


});


//$('#selectedFile').change(function() {
//  $('#img_ul').prepend('<li>追加されました</li>');
//});


$('#delFilebtn').on('click', function() {
//	$('#add-li-img1').remove();
	$('.add-li-img').remove();

//	strstr = '#selectedFile' + (f_cnt + 1);
//	$(strstr).val($(this).val());
	
//	$('#selectedFile1').val('');
//	$('#inputFile1').val('');	
	$("[id^='inputFile']").val('');

	//カウント初期化
	f_cnt = 0;
	$("#selectFile1").prop("disabled", false);
	
});


	
});

