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
				$('#UserKenNameKan').val(data[0].ken_name_kan);
				$('#UserCityNameKan').val(data[0].city_name_kan);
				$('#UserTownNameKan').val(data[0].town_name_kan);
			} else if (data.length > 1) {
			
				for(var value of data) {
					$('#zip-sel').append($('<option>')
					.val(value.zip_code + ',' + value.ken_name_kan + ',' + value.city_name_kan + ',' +value.town_name_kan)
					.text(value.zip_code + ':' + value.ken_name_kan + value.city_name_kan + value.town_name_kan));
				}

				$('#zip-sel').fadeIn(100);
				$('#popup-sel').fadeIn(100);
				$('#popup-background').fadeIn(100);
			} else {
				$('#UserKenNameKan').val("");
				$('#UserCityNameKan').val("");
				$('#UserTownNameKan').val("");
			}
			
		});
		
		};
		
	});
	
	// リストが選択されたら
	$('#zip-sel').bind('change',function(e){
		var selectVal = $("#zip-sel").val();
		var sVal=selectVal.split(','); 
		$('#UserZipCode').val(sVal[0]);
		$('#UserKenNameKan').val(sVal[1]);
		$('#UserCityNameKan').val(sVal[2]);
		$('#UserTownNameKan').val(sVal[3]);
		
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


	


