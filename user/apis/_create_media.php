<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
include('../../includes/functions.php');

if (isset($_REQUEST["create"])) {
	$projectName = (isset($_REQUEST["name"])) ? $_REQUEST["name"] : '';
	$type = (isset($_REQUEST["type"])) ? $_REQUEST["type"] : '';
	$tags = (isset($_REQUEST["tags"])) ? $_REQUEST["tags"] : '';
	$token = $_REQUEST["authtoken"];
	function generateRandomString($length = 12) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}

	//audioFile
	if (isset($_FILES['audio']) AND !empty($_FILES['audio'])) {
		$valid_formats = array("mp3", "wav", "ogg");
		$audio = $_FILES['audio']['name'];
		$audioSize = $_FILES['audio']['size'];
		if (strlen($audio)) {
			list($txt, $ext) = explode(".", $audio);
			if (in_array($ext, $valid_formats)) {
				if ($audioSize < (10240 * 10240)) {
					$audioName = time() . "." . $ext;
					$audioExtension = substr($audioName, -3);
					$tmp = $_FILES['audio']['tmp_name'];
					move_uploaded_file($tmp, "../uploads/audio/" . $audioName);
					$getAudioName = 'http://localhost/user/uploads/audio/' . $audioName;
				}
			}
		}
	} elseif (isset($_POST['audio']) AND !empty($_POST['audio'])) {
		$linkImage = $_POST["audio"];
		$linkImage = explode('=', $linkImage);
		$audioName = time() . '.mp3';
		copy('https://drive.google.com/uc?id=' . $linkImage[1] . '&export=download', '../uploads/audio/' . $audioName);
		$getAudioName = 'https://pitchar.io/uploads/audio/' . $audioName;
		$audioExtension = 'mp3';
	} else {
		$getAudioName = '';
		$audioName = '';
		$audioExtension = '';
	}

	//VideoFile
	if (isset($_FILES['video']) AND !empty($_FILES['video'])) {
		$valid_formats = array("mp4", "wmv", "avi");
		$video = $_FILES['video']['name'];
		$videoSize = $_FILES['video']['size'];
		if (strlen($video)) {
			list($txt, $ext) = explode(".", $video);
			if (in_array($ext, $valid_formats)) {
				if ($videoSize < (10240 * 10240)) {
					$videoName = time() . "." . $ext;
					$tmp = $_FILES['video']['tmp_name'];
					move_uploaded_file($tmp, "../uploads/video/" . $videoName);
					$videoUrlPath = 'http://localhost/user/uploads/video/' . $videoName;
				}
			}
		}
	} elseif (isset($_POST['video']) AND !empty($_POST['video'])) {
		$linkImage = $_POST["video"];
		$linkImage = explode('=', $linkImage);
		$videoName = time() . '.mp4';
		copy('https://drive.google.com/uc?id=' . $linkImage[1] . '&export=download', '../uploads/video/' . $videoName);
		$videoUrlPath = 'https://pitchar.io/uploads/video/' . $videoName;
	} else {
		$videoUrlPath = '';
		$videoName = '';
	}

	//videoThumbnail
	if (isset($_FILES['thumbnail']) AND !empty($_FILES['thumbnail'])) {
		$valid_formats = array("png", "jpeg", "jpg");
		$videoThumb = $_FILES['thumbnail']['name'];
		$videoSize = $_FILES['thumbnail']['size'];
		if (strlen($videoThumb)) {
			list($txt, $ext) = explode(".", $videoThumb);
			if (in_array($ext, $valid_formats)) {
				if ($videoSize < (10240 * 10240)) {
					$videoThumbName = time() . "." . $ext;
					$tmp = $_FILES['thumbnail']['tmp_name'];
					move_uploaded_file($tmp, "../uploads/videoThumbnail/" . $videoThumbName);
					$getVideoThumbnail = 'http://localhost/user/uploads/videoThumbnail/' . $videoThumbName;
				}
			}
		}
	} elseif (isset($_POST['thumbnail']) AND !empty($_POST['thumbnail'])) {
		$linkImage = $_POST["thumbnail"];
		$linkImage = explode('=', $linkImage);
		$videoThumbName = time() . '.png';
		copy('https://drive.google.com/uc?id=' . $linkImage[1] . '&export=download', '../uploads/videoThumbnail/' . $videoThumbName);
		$getVideoThumbnail = 'https://pitchar.io/uploads/videoThumbnail/' . $videoThumbName;
	} else {
		$getVideoThumbnail = '';
		$videoThumbName = '';
	}

// Add New Media
	$queryMedia = mysqli_query($conn, "INSERT INTO media(authtoken,type,video,thumbnail,audio,extension,name,tags)VALUES('$token','$type','$videoUrlPath','$getVideoThumbnail','$getAudioName','$audioExtension','$projectName','$tags')");

	if ($queryMedia) {

		$getMedia = mysqli_query($conn, "SELECT * FROM media WHERE authtoken='$token' ORDER BY id DESC");
		$mediaData = mysqli_fetch_assoc($getMedia);
		$response['message'] = "Media Uploads";
		$response['msg_code'] = 1;
		$response['data'] = $mediaData;
	}
} else {
	$response['message'] = "Invalid Request";
	$response['msg_code'] = 00;
}

echo json_encode($response);
?>
