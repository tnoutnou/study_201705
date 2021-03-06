$(function(){
	$(".hoge1").css("color","blue");

    // ポップアップ用のタグを消す
    $('#popup-background').hide();
    $('#popup-item').hide();
    $('#popup-text').hide();
//    $('#PostIndexForm').hide();
	
    // class「popupimg」のリンクがクリックされた時のイベント定義
    $('.popupimg').bind('click', function(e){
        // aタグでデフォルト動作を無効にする
        e.preventDefault(); 
 
        // 画像の読み込み
        var img = new Image();
        // クリックされたaタグのhrefを取得する
        var imgsrc = this.href;
		        
        $('#popup-item').attr('src', imgsrc);

		// テスト中
//        $('#popup-item').attr('data', this.id);
//        $('#popup-item').data('test', this.id);
          $('#hoge1').data('test', this.id.substr(-1));		
		
		// ポップアップで表示するためのimgタグに画像が読み込まれているかチェックする
		$('#popup-item').each(function(){
			// 読み込み済みならばポップアップ表示用の関数を呼び出す
			if (this.complete) {
				imgload(img);
				return;
			}
		});

		// imgタグのロードイベントを定義
		$('#popup-item').bind('load', function(){
			// 画像がロードされたらポップアップ表示用の関数を呼び出す
			imgload(img);
		});
            
        // Image()に画像を読み込ませる
        img.src = imgsrc;
		
		$('#popup-text').text('');
		if (e.offsetX >= 100) {
			$('#popup-text').css('text-align','right');
		} else {
			$('#popup-text').css('text-align','left');
		}


    });
	

    // ポップアップされた領域のクリックイベント
    $('#popup-background').bind('click', function(){
        // ポップアップを消すため、タグをフェードアウトさせる
        $('#popup-background').fadeOut();
        $('#popup-item').fadeOut();
        $('#popup-text').fadeOut();
        
    });

    // ポップアップされた領域のクリックイベント
    $('#popup-item').bind('click', function(e){
        // ポップアップを消すため、タグをフェードアウトさせる
//        $('#popup-background').fadeOut();
//        $('#popup-item').fadeOut();
		var v_id = $('#hoge1').data('test');
//		alert(e.offsetX);
		
//		var v_id2 = $(v_id).href;
		var v_arr = [];
		
		$(".popupimg").each(function(i, elem) {
			console.log(i + ': ' + $(elem).attr('href'));
			v_arr.push($(elem).attr('href'));
		});

		if (e.offsetX >= 100) {
			var v_id5 = Number(v_id) + 1;
			$('#popup-text').text('>>');
			$('#popup-text').css('text-align','right');
		} else {
			var v_id5 = (Number(v_id) - 1 + v_arr.length) % v_arr.length;
			$('#popup-text').text('<<');
			$('#popup-text').css('text-align','left');
		}
				
//		alert(v_arr);
//		var v_id4 = v_id % 3;
		var v_id4 = (v_id5 - 1 + v_arr.length) % v_arr.length;
				
		// 画像の読み込み
        var img = new Image();
        // src
        var imgsrc = v_arr[v_id4];

        $('#popup-item').attr('src', imgsrc);
		
		// ポップアップで表示するためのimgタグに画像が読み込まれているかチェックする
		$('#popup-item').each(function(){
			// 読み込み済みならばポップアップ表示用の関数を呼び出す
			if (this.complete) {
				imgload(img);
				return;
			}
		});

		// imgタグのロードイベントを定義
		$('#popup-item').bind('load', function(){
			// 画像がロードされたらポップアップ表示用の関数を呼び出す
			imgload(img);
		});
 
        // Image()に画像を読み込ませる
        img.src = imgsrc;
		$('#hoge1').data('test', v_id5);


        
    });
	
	
	
    // ポップアップされた領域でマウスを移動したら
    $('#popup-item').bind('mousemove', function(e){
		if (e.offsetX >= 100) {
			$('#popup-text').text('>>');
			$('#popup-text').css('text-align','right');
		} else {
			$('#popup-text').text('<<');
			$('#popup-text').css('text-align','left');
		}
	});

    // ポップアップされた領域のクリックイベント
    $('#search-btn').bind('click', function(){
        // 表示
		var v_lbl = $('#search-btn').attr('value');
		
		if (v_lbl === '検索表示') {
			//表示
			$('#PostIndexForm').fadeIn();
			$('#search-btn').attr('value','検索非表示');
		} else {
			// 非表示
			$('#PostIndexForm').fadeOut();
			$('#search-btn').attr('value','検索表示');
		};
        
    });


    
    // ポップアップ表示用関数
    function imgload(imgsource){
        // ポップアップの背景部分を表示する
		$('#popup-background').css('opacity','0.60');
        $('#popup-background').fadeIn(function(){
            // 画像を中心に表示させるため、画像の半分のサイズを取得
            /* 
            * 画像を表示するimgタグ「popup-item」はCSSで画面の中心に
            * 表示するようにしているため、そのまま表示すると画像の左上の端が
            * 中心に来ます。
            * そのため、マイナスのマージンを画像の半分のサイズ設定します。
            */

//            var item_hieght_margin = (imgsource.height / 2) * -1;
//            var item_width_margin = (imgsource.width / 2) * -1;
            
            // 取得したマージンと画像のサイズをCSSで定義する
            var cssObj = {
//                  marginTop: item_hieght_margin
//                , marginLeft: item_width_margin
//                , width: imgsource.width
//                , height: imgsource.height
                  marginTop: -150
                , marginLeft: -150
                , width: 300
                , height: 300
            }

            // 画像の表示用タグにCSSを当て、表示を行う
            $('#popup-item').css(cssObj).fadeIn(100);

            // 取得したマージンと画像のサイズをCSSで定義する
            var cssObj2 = {
//                  marginTop: item_hieght_margin
//                , marginLeft: item_width_margin
//                , width: imgsource.width
//                , height: imgsource.height
                  marginTop: 150
                , marginLeft: -150
            }


            $('#popup-text').css(cssObj2).fadeIn(100);
        });
    }

    // 
    $('#hoge1').bind('click', function(e){
		alert($('#hoge1').data('test'));
//        $('#hoge1').data('test' , $('#popup-item').data('test'));
	});

	// #back-to-topを消す
	$('#back-to-top').hide();

	
	// スクロールが十分されたら#back-to-topを表示、スクロールが戻ったら非表示
	$(window).scroll(function() {
//		$('#pos').text($(this).scrollTop());
		if ($(this).scrollTop() > 500) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});

	
	// #back-to-topがクリックされたら上に戻る
	$('#back-to-top').click(function() {
		$('body').animate({
			scrollTop:0
		}, 150);
		return false;
	});

	
	
	// アーカイブが押されたら
	$('.arcive_ym').on('click', function() {
//		$('#PostCreatedYm').val('2017年06月');
//		$('#PostCreatedYm').val($('.arcive_ym').data('arc-ym'));
		$('#PostCreatedYm').val($(this).data('arc-ym'));
		$('#src_btn').trigger('click');
	});


	// 投稿がクリックされたら、aタグのイベントをキック
	$('.one_post').on('click', function(e) {
		$('a',this)[0].click();
//		$('.one_post a')[0].click();
//		$('.one_post a').trigger('click');		// これだとさらに、親のイベントを呼んで無限ループする？
	});

	$('.one_post a').on('click', function(e) {
		e.stopPropagation();
	});


	// 一覧中のカテゴリが押されたら
	$('.category-label').on('click', function(e) {
		$('#PostCategoryId').val($(this).data('category-id'));
		$('#src_btn')[0].click();
		e.stopPropagation();
	});
	
	
	// 一覧中のタグが押されたら
	$('.tag-label').on('click', function(e) {
//		$('#PostTagId').val([]);

//		var value = $('#PostTagId select'+':checked').val();
//		$('#PostTagId select').removeAttr('checked');

//		$('#PostTagId select' + '[value="'+value+'"]').attr('checked','checked');

//		$('#PostTagId select > option:selected').remove();

		// 選択されたチェックを外す
		$('select#PostTagId option:selected').attr("selected",false);
		
//		$('#PostTagId select').val(0);

//		$('#PostTagId select').each(function() {
//			this.selectedIndex = 0;
//		});

//		$('.filter-option.pull-left').val(null);
		$('#PostTagId').val($(this).data('tag-id'));
		var debug1 = $('#PostTagId').val(); 
		$('#src_btn')[0].click();
		e.stopPropagation();
	});


});
