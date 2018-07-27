<?php
    namespace Core;
    
    final Class Conf
    {
        
        const base_url = '';


        function __construct() {
            $this->base_url = "https://".$_SERVER['HTTP_HOST'];
        }
    }
    
?>