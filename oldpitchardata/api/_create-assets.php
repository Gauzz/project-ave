<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
include '../conn.php';

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

	// Obj,fbx
	if (isset($_FILES["obj"]["name"]) AND !empty($_FILES["obj"]["name"])) {
		$arrayModel = explode('.', $_FILES["obj"]["name"]);
		$modelReverseArray = array_reverse($arrayModel);
		$modelGetExt = $modelReverseArray[0];
		$modelName = rand() . "." . $modelGetExt;
		move_uploaded_file($_FILES["obj"]["tmp_name"], "../uploads/obj/" . $modelName);
		$shortObFbx = substr($_FILES["obj"]["name"], -4);
		$objurlpath = ($shortObFbx == ".obj" OR $shortObFbx == ".OBJ") ? 'https://pitchar.io/uploads/obj/' . $modelName : '';
		$fbxurlpath = ($shortObFbx == ".fbx" OR $shortObFbx == ".FBX") ? 'https://pitchar.io/uploads/obj/' . $modelName : '';
	} elseif (isset($_POST['obj']) AND !empty($_POST['obj'])) {
		$linkImage = $_POST["obj"];
		$linkImage = explode('=', $linkImage);
		$modelName = rand() . '.obj';
		copy('https://drive.google.com/uc?id=' . $linkImage[1] . '&export=download', '../uploads/obj/' . $modelName);
		$objurlpath = 'https://pitchar.io/uploads/obj/' . $modelName;
	} else {
		$objurlpath = '';
	}

	// Mtl
	if (isset($_FILES["mtl"]["name"]) AND $_FILES["mtl"]["size"] > 0) {
		$arrayMtl = explode('.', $_FILES["mtl"]["name"]);
		$mtlReverseArray = array_reverse($arrayMtl);
		$mtlGetExt = $mtlReverseArray[0];
		$mtlName = rand() . "." . $mtlGetExt;
		move_uploaded_file($_FILES["mtl"]["tmp_name"], "../uploads/mtl/" . $mtlName);
		$mtlUrlPath = 'https://pitchar.io/uploads/mtl/' . $mtlName;
	} elseif (isset($_POST['mtl']) AND !empty($_POST['mtl'])) {
		$linkImage = $_POST["mtl"];
		$linkImage = explode('=', $linkImage);
		$mtlName = rand() . '.mtl';
		copy('https://drive.google.com/uc?id=' . $linkImage[1] . '&export=download', '../uploads/mtl/' . $mtlName);
		$mtlUrlPath = 'https://pitchar.io/uploads/mtl/' . $mtlName;
	} else {
		$mtlUrlPath = '';
	}

	// Gltf
	if (isset($_FILES["gltf"]["name"]) AND $_FILES["gltf"]["size"] > 0) {
		$arrayGltf = explode('.', $_FILES["gltf"]["name"]);
		$gltfReverseArray = array_reverse($arrayGltf);
		$gltfGetExt = $gltfReverseArray[0];
		$gltfName = rand() . "." . $gltfGetExt;
		move_uploaded_file($_FILES["gltf"]["tmp_name"], "../uploads/obj/" . $gltfName);
		$gltfUrlPath = 'https://pitchar.io/uploads/obj/' . $gltfName;
	} elseif (isset($_POST['gltf']) AND !empty($_POST['gltf'])) {
		$linkImage = $_POST["gltf"];
		$linkImage = explode('=', $linkImage);
		$imageName = rand() . '.gltf';
		copy('https://drive.google.com/uc?id=' . $linkImage[1] . '&export=download', '../uploads/obj/' . $imageName);
		$gltfUrlPath = 'https://pitchar.io/uploads/obj/' . $imageName;
	} else {
		$gltfUrlPath = '';
	}

	/* image */
	if (isset($_FILES['image']) AND !empty($_FILES['image'])) {
		$valid_formats = array("png", "jpeg", "jpg", "svg");
		$image = $_FILES['image']['name'];
		$sizeimage = $_FILES['image']['size'];
		if (strlen($image)) {
			list($txt, $ext) = explode(".", $image);
			if (in_array($ext, $valid_formats)) {
				if ($sizeimage < (10240 * 10240)) {
					$imageName = time() . "." . $ext;
					$tmp = $_FILES['image']['tmp_name'];
					move_uploaded_file($tmp, "../uploads/imgs/" . $imageName);
					$imageUrlPath = 'https://pitchar.io/uploads/imgs/' . $imageName;
				}
			}
		} else {
			$imageUrlPath = '';
		}
	} elseif (isset($_POST['image']) AND !empty($_POST['image'])) {
		$linkImage = $_POST["image"];
		$linkImage = explode('=', $linkImage);
		$imageName = time() . '.png';
		copy('https://drive.google.com/uc?id=' . $linkImage[1] . '&export=download', '../uploads/imgs/' . $imageName);
		$imageUrlPath = 'https://pitchar.io/uploads/imgs/' . $imageName;
	} else {
		$imageUrlPath = '';
	}

	//objThumb
	if (isset($_FILES['thumbnail']) AND !empty($_FILES['thumbnail'])) {
		$valid_formats = array("png", "jpeg", "jpg");
		$objThumb = $_FILES['thumbnail']['name'];
		$sizeobj = $_FILES['thumbnail']['size'];
		if (strlen($objThumb)) {
			list($txt, $ext) = explode(".", $objThumb);
			if (in_array($ext, $valid_formats)) {
				if ($sizeobj < (10240 * 10240)) {
					$objThumbnailName = time() . "." . $ext;
					$tmp = $_FILES['thumbnail']['tmp_name'];
					move_uploaded_file($tmp, "../uploads/objThumbnail/" . $objThumbnailName);
					$getObjThumbnail = 'https://pitchar.io/uploads/objThumbnail/' . $objThumbnailName;
				}
			}
		} else {
			$getObjThumbnail = '';
		}
	} else {
		$getObjThumbnail = '';
	}

// Add New Assets
	$queryAssets = mysqli_query($conn, "INSERT INTO assets(authtoken,type,objthumbnail,obj,mtl,gltf,fbx,image,name,tags)VALUES('$token','$type','$getObjThumbnail','$objurlpath','$mtlUrlPath','$gltfUrlPath','$fbxurlpath','$imageUrlPath','$projectName','$tags')");

	if ($queryAssets) {

		$getAssets = mysqli_query($conn, "SELECT * FROM assets WHERE authtoken='$token' ORDER BY id DESC");
		$AssetsData = mysqli_fetch_assoc($getAssets);
		$response['message'] = "Assets Uploads";
		$response['msg_code'] = 1;
		$response['data'] = $AssetsData;
	}
} else {
	$response['message'] = "Invalid Request";
	$response['msg_code'] = 00;
}

echo json_encode($response);
?>