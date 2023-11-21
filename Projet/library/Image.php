<?php
class Image{
    static public function imgFileChamp($dataImage){

            //$photoData = $_FILES['photo'];
            // traitement d image
            $fileName = $dataImage['name'];
            $fileSize = $dataImage['size'];
            $tempName = $dataImage['tmp_name'];
    
            $validImageExtension = ['jpg','jpeg','png'];
            $imageExtension = explode('.', $fileName); //[imageName, png]
            $imageExtension = strtolower(end($imageExtension));
            if(in_array($imageExtension, $validImageExtension)){
                
                if($fileSize < 9999999){
                    
                    $newImageName = uniqid();
                    $newImageName .= '.'.$imageExtension;
                    move_uploaded_file($tempName, 'photoJoueurs/'.$newImageName);
                    
                    //nouveau champ: $newImageName;
                    return $newImageName;
                    
                    
                 }
            }
            
    }
}
?>