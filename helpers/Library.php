<?php
function require_controller($dir, $controller)
{
    require_once $dir . $controller . '.php';
}

function redirect($url)
{
    header('location:' . DOM . $url);
    return true;
}

function uploadFile($file, $category)
{
    $filename = $file['image']['name'];
    $array = [];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed = array('png', 'gif', 'jpeg', 'jpg', 'gfif', 'jfif');
    if (in_array($ext, $allowed)) {
        if ($_FILES['image']['size'] <= UPLOAD_IMAGE_SIZE) {
            $imgname = md5(date("Y-m-d H:i:s") . $filename) . '.' . $ext;
            $array['src'] = START_PAFF . 'products/'. $category . '/' . $imgname;
            $array['name'] = $imgname;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $array['src'])) {
                $array['msg'] = 'upload file';
            }
        }
    }
    return $array;
}

function deleteFile($filename, $folder = null)
{
    $path = START_PAFF . $folder . '/' . $filename;
    unlink($path);
}