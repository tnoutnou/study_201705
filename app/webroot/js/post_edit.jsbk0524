var f_cnt = 0;

$(function(){

$('#file-input-group2').css("display" , "none");
$('#file-input-group3').css("display" , "none");
//$('#file-input-group2').hide();
//$('#file-input-group3').hide();


$('#selectFile1').on('click', function() {

	if (f_cnt == 0) {
		$('#inputFile1').trigger('click');
	} else if (f_cnt == 1) {
		$('#inputFile2').trigger('click');
	} else if (f_cnt == 2) {
		$('#inputFile3').trigger('click');
	}

});

$('#selectFile2').on('click', function() {
  $('#inputFile2').trigger('click');
});

$('#selectFile3').on('click', function() {
  $('#inputFile3').trigger('click');
});



//$('.cls-inputFile').change(function() {
$('#inputFile1').change(function() {
	
	if (f_cnt == 0) {
		$('#selectedFile1').val($(this).val());
	} else if (f_cnt == 1) {
		$('#selectedFile2').val($(this).val());
	} else if (f_cnt == 2) {
		$('#selectedFile3').val($(this).val());
	}
  
  if (this.files.length > 0) {
    // 選択されたファイル情報を取得
    var file = this.files[0];
    
    // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
    var reader = new FileReader();
    reader.readAsDataURL(file);
    
	f_cnt = f_cnt + 1;
	if (f_cnt >= 3) {
		$("#selectFile1").prop("disabled", true);
	}
	
    reader.onload = function() {
		str3 = reader.result;
//		str2 = '<li><img src="' + str3 + '" width=80 height=80 alt></li>';
		str2 = '<li><img src="' + str3 + '" width=80 height=80 alt><a>' + file.name + '</a></li>';
		$('#img_ul').prepend(str2);

	}
  }

});



//$('.cls-inputFile').change(function() {
$('#inputFile2').change(function() {
	
	$('#selectedFile2').val($(this).val());
  
  if (this.files.length > 0) {
    // 選択されたファイル情報を取得
    var file = this.files[0];
    
    // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
    var reader = new FileReader();
    reader.readAsDataURL(file);
    
	f_cnt = f_cnt + 1;
	if (f_cnt >= 3) {
		$("#selectFile1").prop("disabled", true);
	}
	
    reader.onload = function() {
		str3 = reader.result;
//		str2 = '<li><img src="' + str3 + '" width=80 height=80 alt></li>';
		str2 = '<li><img src="' + str3 + '" width=80 height=80 alt><a>' + file.name + '</a></li>';
		$('#img_ul').prepend(str2);

	}
  }

});



//$('.cls-inputFile').change(function() {
$('#inputFile3').change(function() {
	
	$('#selectedFile3').val($(this).val());
  
  if (this.files.length > 0) {
    // 選択されたファイル情報を取得
    var file = this.files[0];
    
    // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
    var reader = new FileReader();
    reader.readAsDataURL(file);
    
	f_cnt = f_cnt + 1;
	if (f_cnt >= 3) {
		$("#selectFile1").prop("disabled", true);
	}
	
    reader.onload = function() {
		str3 = reader.result;
//		str2 = '<li><img src="' + str3 + '" width=80 height=80 alt></li>';
		str2 = '<li><img src="' + str3 + '" width=80 height=80 alt><a>' + file.name + '</a></li>';
		$('#img_ul').prepend(str2);

	}
  }

});








$('#selectedFile').change(function() {
  $('#img_ul').prepend('<li>追加されました</li>');
});


	
});
