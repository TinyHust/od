<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class Nbdesigner_DebugTool {
    /**
     * Before use log() enable config log in wp-config.php in root folder
     * If can't modified wp-config.php use function wirite_log() or manual_write_debug()
     * @param type $data
     */
    static private $_path = NBDESIGNER_PLUGIN_DIR;
    public function __construct($path = ''){
        if($path != ''){
            self::$_path = $path;
        }else{
            self::$_path = NBDESIGNER_PLUGIN_DIR;
        }        
    }
    public static function log($data){
        if(NBDESIGNER_MODE_DEBUG === 'dev'){
            ob_start();
            var_dump($data);
            error_log(ob_get_clean());
        }else{
            return FALSE;
        }
    }
    public static function wirite_log($data){
        if(NBDESIGNER_MODE_DEBUG === 'dev'){
            error_reporting( E_ALL );
            ini_set('log_errors', 1);
            ini_set('error_log', self::$_path . 'debug.log');           
            error_log(basename(__FILE__) . ': Start debug.');
            ob_start();
            var_dump($data);
            error_log(ob_get_clean());            
            error_log(basename(__FILE__) . ': End debug.');
        }else{
            return FALSE;
        }        
    }
    public static function manual_write_debug($data){
        $path = self::$_path . 'debug.txt';
        $data = print_r($data, true);
        if (NBDESIGNER_MODE_DEBUG === 'dev') {
            if (!$fp = fopen($path, 'w')) {
                return FALSE;
            }
            flock($fp, LOCK_EX);
            fwrite($fp, $data);
            flock($fp, LOCK_UN);
            fclose($fp);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public static function manual_write_debug2($data){
        $data = print_r($data, true);
        $path = self::$_path . 'debug.txt';    
        file_put_contents($path, $data);
    }
    public static function console_log($data){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';        
    }
    public static function theme_check_hook(){
        //TODO
    }
    public static function migrate_domain(){
        //TODO
    }
}