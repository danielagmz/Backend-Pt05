<?php
require_once 'model/update_info.php';
/**
 * Sube una imagen de avatar al servidor y actualiza la ruta en la base de datos.
 *
 * @param array $avatar Información de la imagen de avatar subida, con los siguientes
 *                      índices:
 *
 *                      - name: nombre de la imagen
 *                      - type: tipo MIME de la imagen
 *                      - tmp_name: ruta temporal en el servidor donde se ha guardado
 *                                  la imagen
 *                      - error: cero si no hay errores, distinto de cero si hay
 *                              errores
 *                      - size: tamaño en bytes de la imagen
 *
 * @return string mensaje de respuesta 
 */
function upload_avatar($avatar)
{
    $id = $_SESSION['id'];
    $fileTmpPath = $avatar['tmp_name'];
    $fileName = $avatar['name'];
    $fileSize = $avatar['size'];
    $fileType = $avatar['type'];

    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fileType, $allowedFileTypes)) {
        http_response_code(400);
        echo '<div class="form-info form-info--error">Els formats acceptats són JPG, PNG i GIF</div>';
        return;
    }

    if ($fileSize > 2 * 1024 * 1024) {
        http_response_code(400);
        echo '<div class="form-info form-info--error">La imatge es massa gran. Máxim permitit: 2MB</div>';
        return;
    }

    $uploadFolder = 'uploads/';
    $newFileName = uniqid() . '-' . $fileName;
    $destination = $uploadFolder . $newFileName;

    if (!move_uploaded_file($fileTmpPath, $destination)) {
        http_response_code(500);
        echo '<div class="form-info form-info--error">Error al carregar l\'imatge</div>';
        return;
    }

    if (getOldImagespath($id) != '') {
                $oldavatar = getOldImagespath($id)['avatar'];
                //eliminar la imagen de la carpeta uploads
                if (file_exists($oldavatar)) {
                    unlink($oldavatar);
                }
    }
    if (update_avatar($id, $destination)) {
        http_response_code(200);
        echo '<div class="form-info form-info--success profile-info">L\'imatge s\'ha carregat correctament</div>';
        $_SESSION['avatar'] = $destination;
    } else {
        http_response_code(500);
        echo '<div class="form-info form-info--error">Error al carregar l\'imatge</div>';
    }
}

/**
 * Sube una imagen de banner al servidor y actualiza la ruta en la base de datos.
 *
 * @param array $banner Información de la imagen de banner subida, con los siguientes índices:
 *                      - tmp_name: path temporal de la imagen en el servidor.
 *                      - size: tamaño de la imagen en bytes.
 *                      - type: tipo MIME de la imagen.
 *                      - name: nombre de la imagen.
 *
 */
function upload_banner($banner)
{   
    if ($banner['size'] == 0) {
        echo '<div class="form-info form-info--error">No s\'ha carregat cap imatge</div>';
        return;
    }
    $id = $_SESSION['id'];
    $fileSize = $banner['size'];
    $fileType = $banner['type'];
    
    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fileType, $allowedFileTypes)) {
        http_response_code(400);
        echo '<div class="form-info form-info--error">Els formats acceptats són JPG, PNG i GIF</div>';
        return;
    }
    
    if ($fileSize > 2 * 1024 * 1024) {
        http_response_code(400);
        echo '<div class="form-info form-info--error">La imatge es massa gran. Máxim permitit: 2MB</div>';
        return;
    }

    $fileTmpPath = $banner['tmp_name'];
    $fileName = $banner['name'];

    $uploadFolder = 'uploads/';
    $newFileName = uniqid() . '-' . $fileName;
    $destination = $uploadFolder . $newFileName;

    if (!move_uploaded_file($fileTmpPath, $destination)) {
        http_response_code(500);
        echo '<div class="form-info form-info--error">Error al carregar l\'imatge</div>';
        return;
    }

    if (getOldImagespath($id) != '') {
        $oldBanner = getOldImagespath($id)['banner'];
        //eliminar la imagen de la carpeta uploads
        unlink($oldBanner);
    }
    if (update_banner($id, $destination)) {
        http_response_code(200);
        echo '<div class="form-info form-info--success profile-info">L\'imatge s\'ha carregat correctament</div>';
        $_SESSION['banner'] = $destination;
    } else {
        http_response_code(500);
        echo '<div class="form-info form-info--error">Error al carregar l\'imatge</div>';
    }
}
