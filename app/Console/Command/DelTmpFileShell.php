<?php
class DeltmpfileShell extends AppShell {
    public function main() {

		$tmpdir = 'img/tmp';

		$tagdir = ROOT . "/" . APP_DIR. "/" . WEBROOT_DIR. "/" . $tmpdir;

		// 現在の日付
		$dt_td =date("Y-m-d H:i");
		$d_td=strtotime($dt_td);

		
		foreach (glob($tagdir . '/*.*') as $file) {

			// globで取得したファイルをunlinkで1つずつ削除していく
			if(file_exists($file)){

				// ファイルの日付
				$dt1_1 = filemtime($file);
				$dt1 = date("Y/m/d H:i",$dt1_1);
				$d1=strtotime($dt1);
				
				$diff = $d_td - $d1;//現在からファイル作成時の日時を引く
//				$diffDay = $diff / 86400;//1日は86400秒
//				if(intval($diff)>=86400){//前回更新時から1日以上経過している場合のみ
				if(intval($diff)>=3600){//前回更新時から1時間以上経過している場合のみ
					unlink($file);
				}
			}
		}


	}
}

