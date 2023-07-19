<?php defined('BASEPATH') OR exit('No direct script access allowed.');
 require_once APPPATH . 'libraries/array_config_writer/class-array-config-writer.php';
class Config_Writer {
        /**
     * Get instance of the config writer
     * 
     * @param string $file Absolute path to config file , default to the main config file
     * @param string $variable_name The name of varible(array) that holds items 
     * @return \Array_Config_Writer
     */
    public function gcw( $file = null , $variable_name = 'config' )
    {
        if(!$file)
        {
            $file = APPPATH.'config/site.php';
            
        }
        return new Array_Config_Writer( $file , $variable_name );
    }
} 
?>