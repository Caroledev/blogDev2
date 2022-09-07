<?php
    function cleanInput($input){
        return htmlspecialchars(strip_tags(trim($input)));
    }
    
    function get_file_extension($file) {
        return substr(strrchr($file,'.'),1);
    }
?>