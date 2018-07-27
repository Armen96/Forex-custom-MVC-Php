<?php

namespace Core\ImplimentFace;

interface Rendering {
 
    public function renderView($pagePath,$page,array $params);
    
    public function renderNotFound($path,array $params);
    
    public function renderLoginView($pagePath,$page,array $param);
}