<?
	function photo($dir,$dirLink){
		if(isset($_FILES["upfile"]["name"]) && $_FILES["upfile"]["name"] !=null){
			$upfile_name	 = $_FILES["upfile"]["name"];
			$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
			$upfile_type     = $_FILES["upfile"]["type"];
			$upfile_size     = $_FILES["upfile"]["size"];
			$upfile_error    = $_FILES["upfile"]["error"];

			//$upload_dir = './warePhoto/';
			$upload_dir = $dir;

			$file = explode(".", $upfile_name);
			$file_name = $file[0];
			$file_ext  = $file[1];

			$new_file_name = date("Y_m_d_H_i_s");
			$new_file_name = $new_file_name."_".$i;
			$copied_file_name = $new_file_name.".".$file_ext;      
			$uploaded_file = $upload_dir.$copied_file_name;

			$file_path = "http://ccit2.dothome.co.kr/wineAccount/api/basicReg/{$dirLink}/".$copied_file_name;

			if (!$upfile_error)
			{
				$new_file_name = date("Y_m_d_H_i_s");
				$new_file_name = $new_file_name."_".$i;
				$copied_file_name = $new_file_name.".".$file_ext;      
				$uploaded_file = $upload_dir.$copied_file_name;
/*
				if( $upfile_size  > 500000 ) {
					echo("
					<script>
					alert('업로드 파일 크기가 지정된 용량(500KB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
					history.go(-1)
					</script>
					");
					exit;
				}
*/
				if ( ($upfile_type != "image/gif") &&
					 ($upfile_type != "image/jpeg") &&
					 ($upfile_type != "image/pjpeg") &&
					 ($upfile_type != "image/png") )
				{
					echo("
						<script>
							alert('JPG, GIF, PNG 이미지 파일만 업로드 가능합니다!');
							history.go(-1)
						</script>
						");
					exit;
				}

				if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
				{
					echo("
						<script>
						alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
						history.go(-1)
						</script>
					");
					exit;
				}
			}
		}
		return $file_path;
	}
?>