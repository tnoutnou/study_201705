$(function() {


    // ポップアップ用のタグを消す
    $('#popup-background').hide();
    $('#zip-sel').hide();

    $('#popup-sel').hide();

    $('#tran-btn').click(function() {

		// リストボックスの選択を全削除
		$("#zip-sel option").each( function(){
	        $(this).remove();
		});

		if ($('#UserZipCode').val() != false) {
		
        $.get('/zips/zipList',  {
				'zipcode': $('#UserZipCode').val()
		}, function(data) {

			if (data.length == 1) {
				$('#UserZipId').val(data[0].zip_id);
				$('#UserPrefectureName').val(data[0].prefecture_name_kan);
				$('#UserCityName').val(data[0].city_name_kan);
				$('#UserTownName').val(data[0].town_name_kan);
			} else if (data.length > 1) {
			
				for(var value of data) {
					$('#zip-sel').append($('<option>')
					.val(value.zip_id + ',' + value.zip_code + ',' + value.prefecture_name_kan + ',' + value.city_name_kan + ',' +value.town_name_kan)
					.text(value.zip_code + ':' + value.prefecture_name_kan + value.city_name_kan + value.town_name_kan));
				}

				$('#zip-sel').fadeIn(100);
				$('#popup-sel').fadeIn(100);
				$('#popup-background').fadeIn(100);
			} else {
				$('#UserZipId').val("");
				$('#UserPrefectureName').val("");
				$('#UserCityName').val("");
				$('#UserTownName').val("");
			}
			
		});
		
		};
		
	});
	
	// リストが選択されたら
	$('#zip-sel').bind('change',function(e){
		var selectVal = $("#zip-sel").val();
		var sVal=selectVal.split(','); 
		$('#UserZipId').val(sVal[0]);
		$('#UserZipCode').val(sVal[1]);
		$('#UserPrefectureName').val(sVal[2]);
		$('#UserCityName').val(sVal[3]);
		$('#UserTownName').val(sVal[4]);
		
		$('#popup-background').fadeOut();
        $('#zip-sel').fadeOut();
        $('#popup-sel').fadeOut();

	});

    // 黒バックグラウンドが選択されたら
    $('#popup-background').bind('click', function(){
        // ポップアップを消すため、タグをフェードアウトさせる
        $('#popup-background').fadeOut();
        $('#zip-sel').fadeOut();
        $('#popup-sel').fadeOut();

	});

	
	
});


	


