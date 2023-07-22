<?php
Class FileUploader{

	static function subir($file,$uploadDir,$name = ''){

		if($file["error"] == 0){

			$tmp_uri = $file["tmp_name"];
			$name = ($name == '') ? $file["name"] : $name.FileUploader::getExt($file[$fileInputName]["name"]);
			echo "$uploadDir$name";
			return move_uploaded_file($tmp_uri, "$uploadDir$name");
		}
		else
		{
			return "Error: " . $file["error"] ."<br>";
		}
	}

	static function getExt($filename){
		$array = explode(".", $filename);
		return ".".end($array);
	}
	
	static function subirImagen($nombre, $dimensiones, $indice, $tipo_corte=1 ,$destino){    
    $imagen='';
    $n=count($dimensiones);
    $dimensiones[$n]='100x100';
    if (isset($_FILES[$nombre]['name'])){		
		//$ruta = "../../fotos/";    
		$ruta = $destino;    
		$fileorigen=$_FILES[$nombre]['tmp_name'];
		if (file_exists($fileorigen))
		{            
			$uploadfile=mb_strtolower(basename($_FILES[$nombre]['name']));
			$uploadfile_len=mb_strlen($uploadfile);
			$uploadfile_punto=mb_strrpos($uploadfile,"."); 
			$uploadfile_ext=mb_substr($uploadfile,$uploadfile_punto,($uploadfile_len-$uploadfile_punto));            
		
			if (($uploadfile_ext==".jpg") || ($uploadfile_ext==".jpeg") || ($uploadfile_ext==".gif") || ($uploadfile_ext==".png"))
			{
				$imagen=time().$indice.$uploadfile_ext;
				$filedestino=$ruta.$imagen;
				if (move_uploaded_file($fileorigen, $filedestino))
				{
					foreach ($dimensiones as $u)
					{
						$d=explode('x', $u);
						$_imagen=$u.'_'.$imagen;
						FileUploader::crea_imagen($filedestino, $d[0], $d[1], $tipo_corte, $ruta.$_imagen);
					}
				}
			}
		}
		}
		
		return $imagen;        
	}
	static function crea_imagen($img_origen, $img_ancho, $img_alto, $img_ajustar, $img_destino){ 	
		$img_extension=pathinfo($img_origen, PATHINFO_EXTENSION);
		$img = null;
		if ($img_extension == "jpg" || $img_extension == "jpeg")
			{
			$img = @imagecreatefromjpeg($img_origen); //crea una imagen desde un JPG
			}
		else if ($img_extension == "png")
			{
			$img = @imagecreatefrompng($img_origen); //crea una imagen desde un PNG
			}
		else if ($img_extension == "gif") # Only if your version of GD includes GIF support
			{
			$img = @imagecreatefromgif($img_origen); //crea una imagen desde un GIF
			}
	
			# If an image was successfully loaded, test the image for size
			if ($img)
				{
				# Get image size and scale ratio
				$img_width = imagesx($img); //Get image width
				$img_height = imagesy($img); //Get image height
	
				//Ajuste de imagenes sencillo; no hay fondo blanco de relleno ni ajuste exacto. Solo cuando importa el ancho o alto
				If ($img_ajustar==0)
					{						
					If (($img_ancho>0) and ($img_alto==0)) //solo importa el ancho
						{
						$scale = ($img_ancho/$img_width); 
						}
					If (($img_ancho==0) and ($img_alto>0)) //solo importa el alto
						{
						$scale = ($img_alto/$img_height); 
						}
					If (($img_ancho>0) and ($img_alto>0)) //considerar ambas variables
						{
						$scale = min($img_ancho/$img_width, $img_alto/$img_height); 
						}
		
					$new_width = floor($scale*$img_width); //Obtiene el nuevo tama�o al resize calculado
					$new_height = floor($scale*$img_height); //Obtiene el nuevo tama�o al resize calculado
		
					$new_img = imagecreatetruecolor($new_width, $new_height);

					//TRANSPARENTE
					imagealphablending($new_img, false);
				    imagesavealpha($new_img, true);
				    // Paint the watermark image with a transparent color to remove the default opaque black.
				    // If we don't do this the black shows through later colours.
				    imagefill($new_img,0,0,imagecolorallocatealpha($new_img, 0,0,0,127));


					imagecopyresampled($new_img, $img, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height);
		
					//Genera fisicamente la imagen procesada antes
					imagejpeg($new_img,$img_destino); //Output image to browser or file
					//imagepng($new_img,$img_destino); //Output image to browser or file
		
					imagedestroy($new_img); //Destroy an image (liberando memoria)
					}
	
				//Ajuste de imagenes perfecto; Se corta lo que sobre del ancho o alto para calzar exactamente en el marco dado.
				If ($img_ajustar==1)
					{						
					$scale = max($img_ancho/$img_width, $img_alto/$img_height); 
		
					$new_width = floor($scale*$img_width); //Obtiene el nuevo tama�o al resize calculado
					$new_height = floor($scale*$img_height); //Obtiene el nuevo tama�o al resize calculado
		
					$new_img = imagecreatetruecolor($new_width, $new_height);
					imagecopyresampled($new_img, $img, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height);
	
					//Ahora le sacamos una sub-imagen de exactos pixels
					$new_x = floor(($new_width - $img_ancho) / 2);
					$new_y = floor(($new_height - $img_alto) / 2);
						
					$res = imagecreatetruecolor ($img_ancho, $img_alto);
					imagecopy($res, $new_img, 0, 0, $new_x, $new_y, $img_ancho, $img_alto);
		
					//Genera fisicamente la imagen procesada antes
					imagejpeg($res,$img_destino); //Output image to browser or file
		
					imagedestroy($new_img); //Destroy an image (liberando memoria)
					imagedestroy($res); //Destroy an image (liberando memoria)
					}
	
				//Ajuste de imagenes perfecto; Se rellena con fondo blanco lo necesario para calzar exactamente en el marco dado.
				If ($img_ajustar==2)
					{						
					$scale = min($img_ancho/$img_width, $img_alto/$img_height); 
		
					$new_width = floor($scale*$img_width); //Obtiene el nuevo tama�o al resize calculado
					$new_height = floor($scale*$img_height); //Obtiene el nuevo tama�o al resize calculado
		
					$new_img = imagecreatetruecolor($new_width, $new_height); //thumbnail creado
					
					//FONDO BLANCO
					imagealphablending($new_img, false);
				    imagesavealpha($new_img, true);
				    // Paint the watermark image with a transparent color to remove the default opaque black.
				    // If we don't do this the black shows through later colours.
				    imagefill($new_img,1,1,imagecolorallocate($new_img, 255, 255, 255));

					imagecopyresampled($new_img, $img, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height);
	
					//Ahora le sacamos una sub-imagen de exactos pixels
					$new_x = ($img_ancho/2)-($new_width/2);
					$new_y = ($img_alto/2)-($new_height/2);
						
					$res = imagecreatetruecolor ($img_ancho, $img_alto);
					$blanco=imagecolorallocate ($res, 255, 255, 255);
					imagefill ($res, 1, 1, $blanco);
					 
					//imagecopy($res, $new_img, 0, 0, $new_x, $new_y, $foto_ancho, $foto_alto);
					imagecopy($res, $new_img, $new_x, $new_y, 0, 0, $new_width, $new_height);
		
					//Genera fisicamente la imagen procesada antes
					imagejpeg($res,$img_destino); //Output image to browser or file
					//imagepng($res,$img_destino); //Output image to browser or file
		
					imagedestroy($new_img); //Destroy an image (liberando memoria)
					imagedestroy($res); //Destroy an image (liberando memoria)
					}

				//Ajuste de imagenes perfecto; Se rellena con fondo transparente lo necesario para calzar exactamente en el marco dado.
				If ($img_ajustar==3)
					{						
					$scale = min($img_ancho/$img_width, $img_alto/$img_height); 
		
					$new_width = floor($scale*$img_width); //Obtiene el nuevo tama�o al resize calculado
					$new_height = floor($scale*$img_height); //Obtiene el nuevo tama�o al resize calculado
		
					$new_img = imagecreatetruecolor($new_width, $new_height); //thumbnail creado

					//TRANSPARENTE
					imagealphablending($new_img, false);
				    imagesavealpha($new_img, true);
				    // Paint the watermark image with a transparent color to remove the default opaque black.
				    // If we don't do this the black shows through later colours.
				    imagefill($new_img,0,0,imagecolorallocatealpha($new_img, 0,0,0,127));
					
					imagecopyresampled($new_img, $img, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height);
	
					//Ahora le sacamos una sub-imagen de exactos pixels
					$new_x = ($img_ancho/2)-($new_width/2);
					$new_y = ($img_alto/2)-($new_height/2);
						
					$res = imagecreatetruecolor ($img_ancho, $img_alto);
					//$blanco=imagecolorallocate ($res, 255, 255, 255);
					//imagefill ($res, 1, 1, $blanco);

					//TRANSPARENTE
					imagealphablending($res, false);
				    imagesavealpha($res, true);
				    // Paint the watermark image with a transparent color to remove the default opaque black.
				    // If we don't do this the black shows through later colours.
				    imagefill($res,0,0,imagecolorallocatealpha($res, 0,0,0,127));
					 
					//imagecopy($res, $new_img, 0, 0, $new_x, $new_y, $foto_ancho, $foto_alto);
					imagecopy($res, $new_img, $new_x, $new_y, 0, 0, $new_width, $new_height);
		
					//Genera fisicamente la imagen procesada antes
					//imagejpeg($res,$img_destino); //Output image to browser or file
					imagepng($res,$img_destino); //Output image to browser or file
		
					imagedestroy($new_img); //Destroy an image (liberando memoria)
					imagedestroy($res); //Destroy an image (liberando memoria)
					}	
	
				imagedestroy($img); //Destroy an image (liberando memoria)
				}


	}
}
?>