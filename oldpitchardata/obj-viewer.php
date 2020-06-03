<?php
include 'conn.php';
session_start();
 if(!isset($_SESSION["login"])){
     header("Location:register.php");
 }
 
   $token=$_GET["token"];
   $query=mysqli_query($conn,"SELECT * FROM tbl_std_project WHERE token='$token'");
   $data=mysqli_fetch_array($query);
   $objFile= $data["objfile"];
   $mtlFile= $data["mtlfile"];

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        body { 
  margin: 0; 
  background-color: #ddd;
}
#canvas-container { 
  position:fixed;
  width: 100%; 
  height: 100%;
}
    </style>
</head>
<body>
<div id="canvas-container"><div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/86/three.min.js"></script>
<script src="https://threejs.org/examples/js/controls/OrbitControls.js" ></script>
<script src="https://threejs.org/examples/js/loaders/OBJLoader.js" ></script>
<script src="https://threejs.org/examples/js/loaders/MTLLoader.js" ></script>

    <script type="text/javascript">
        div = document.getElementById("canvas-container");
scene = new THREE.Scene();

renderer = new THREE.WebGLRenderer({ antialias: false, alpha: true });
renderer.setPixelRatio(window.devicePixelRatio * 2);
renderer.setSize(div.offsetWidth, div.offsetHeight);

renderer.shadowMap.enabled = true;
div.appendChild( renderer.domElement );
//camera
camera = new THREE.PerspectiveCamera(
  75,
  div.offsetWidth / div.offsetHeight,
  0.1,
  1000
);
camera.position.z = 5;
camera.position.y = 5;
controls = new THREE.OrbitControls(camera, renderer.domElement);
//controls.addEventListener( 'change', ()=>{ renderer.render( scene, camera );} );
//lights
//https://stackoverflow.com/questions/15478093/realistic-lighting-sunlight-with-three-js
var dirLight = new THREE.DirectionalLight(0xffffff, 1);
dirLight.position.set(-1, 0.75, 1);
dirLight.position.multiplyScalar(50);
dirLight.name = "dirlight";
dirLight.castShadow = true;

dirLight.shadow.mapSize.width = 768;//4096;
dirLight.shadow.mapSize.height = 768; //4096;
dirLight.shadow.camera.near = 1;
dirLight.shadow.camera.far = 200;
//dirLight.shadowBias = 0.0005;
scene.add(dirLight);

var ambLight = new THREE.AmbientLight( 0x202020 ); // soft white light
scene.add( ambLight );

//loader for the material
var mtlLoader = new THREE.MTLLoader();
//var material = new THREE.MeshLambertMaterial({ color: 0xcc8729 });
var materials = mtlLoader.parse(getMtlFileAsString());

//Loader for the model
var objLoader = new THREE.OBJLoader();
objLoader.setMaterials(materials);
var geometry = objLoader.parse(getObjFileAsString());
geometry.position.set(0, 0, 0);
geometry.rotation.y = 0.7;
geometry.traverse(function(child){
  if (child instanceof THREE.Mesh) {
    //child.material = material;
    child.castShadow = true;
    child.receiveShadow = true;
  }
});
/*
var box = new THREE.BoxGeometry(1, 1, 1);
var material = new THREE.MeshLambertMaterial({ color: 0x00ff00 });
var geometry = new THREE.Mesh(box, material);
*/
scene.add(geometry);


function animate() {
  requestAnimationFrame(animate);
  geometry.rotation.y += 0.005;

  renderer.render(scene, camera);
}
animate();

window.addEventListener('resize', function(){
        camera.aspect   = div.offsetWidth / div.offsetHeight;
        camera.updateProjectionMatrix();
  
        renderer.setSize(div.offsetWidth, div.offsetHeight);
    }, false)

function getObjFileAsString() {
  return `<?php include 'uploads/obj/'.$objFile; ?>`;
}

function getMtlFileAsString() {
  return `<?php include 'uploads/mtl/'.$mtlFile; ?>`;
}
    </script>
</body>
</html>