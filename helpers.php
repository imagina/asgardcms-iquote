<?php
if(!function_exists('base64_convert_img')){
  function base64_convert_img($img){
    if( $img ){
      $img_path = str_ireplace('http://', 'https://', $img);
      $img_type = explode('.',$img_path);
      //convert image into Binary data
      $img_data = fopen ( $img_path, 'rb' );
      $img_size = filesize ( $img_path );
      $binary_image = fread ( $img_data, $img_size );
      fclose ( $img_data );

      //Build the src string to place inside your img tag
      $img_src = "data:image/".$img_type[count($img_type)-1].";base64,".str_replace ("\n", "", base64_encode ( $binary_image ) );
      return $img_src;
    }
    return false;
  }
}
