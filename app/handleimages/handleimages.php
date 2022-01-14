<?php

namespace app\handleimages;

class handleimages{
  private function checkextension($tosave){
    $ext = pathinfo($tosave,PATHINFO_EXTENSION);
    if($ext != "png" && $ext != "jpg" && $ext != "jpeg"){
      return false;
    }
    return $ext;
  }
  private function checkimage($file){
    $check = getimagesize($file["tmp_name"]);
    if($check==false){
      return $check;
    }
    return true;
  }
  private function save($file,$folder,$tosave){
    $saved = $folder.$_COOKIE["manager"];
    $save = $folder.$_COOKIE["manager"].".jpg";
    if(! move_uploaded_file($file["tmp_name"],$save)){
      return false;
    }
    
    $this->compressImage($save,$save);
    
    return $save;
  }
  private function compressImage($source_image, $compress_image) {
                  $image_info = getimagesize($source_image);
                  if ($image_info['mime'] == 'image/jpeg') {
                  $source_image = imagecreatefromjpeg($source_image);
                  imagejpeg($source_image, $compress_image, 75);
                  } elseif ($image_info['mime'] == 'image/gif') {
                  $source_image = imagecreatefromgif($source_image);
                  imagegif($source_image, $compress_image, 75);
                  } elseif ($image_info['mime'] == 'image/png') {
                  $source_image = imagecreatefrompng($source_image);
                  imagepng($source_image, $compress_image, 6);
                  }
                  return $compress_image;
  }
  public function dp($file){
    $folder = "../images/";
    $tosave = $folder.basename($file["name"]);
    if(!$this->checkextension($tosave)){
      return false;
    }
    if(!$this->checkimage($file)){
      return false;
    }
    return $this->save($file,$folder,$tosave);
  }
}