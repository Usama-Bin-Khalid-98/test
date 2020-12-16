<?php
if(!function_exists('createDirecrtory')) {
    function createDirecrtory($request)
    {

        $path = public_path($request['path']);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0775, true, true);
            $createFile = fopen($path.'index.php', 'w');
            return true;
        }
        return false;
    }
}
