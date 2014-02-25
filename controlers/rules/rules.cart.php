<?php
    
    
    
    function formatPermit($perm){
        
        $output = '';
        
        switch ($perm){
            case 'allow':
                $output = 'rule-perm-allow';
                break;
            case 'deny':
                $output = 'rule-perm-deny';
                break;
            default:
                break;
        }
        
        return $output;
    }
?>