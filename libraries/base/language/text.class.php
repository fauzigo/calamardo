<?php
/**
 * Clase para el manejo de textos
 *
 * @package Language
 * @subpackage base
 * @since 1.0
 */

class text
{
    protected static $string=array();
    
    /**
    * Translates a string into the current language.
    *
    * Examples:
    * <script>alert(Joomla.JText._('<?php echo JText::_("JDEFAULT", array("script"=>true));?>'));</script>
    * will generate an alert message containing 'Default'
    * <?php echo JText::_("JDEFAULT");?> it will generate a 'Default' string
    *
    * @param   string   $string                The string to translate.
    * @param   mixed    $jsSafe                Boolean: Make the result javascript safe. array an array of option as described in the JText::sprintf function
    * @param   boolean  $interpretBackSlashes  To interpret backslashes (\\=\, \n=carriage return, \t=tabulation)
    * @param   boolean  $script                To indicate that the string will be push in the javascript language store
    *
    * @return  string  The translated string or the key is $script is true
    * @since   11.1
    *
    */
   public static function _($string, $jsSafe = false, $interpretBackSlashes = true, $script = false)
   {
           $lang = functions::getLanguage();
           if (is_array($jsSafe)) {
                   if (array_key_exists('interpretBackSlashes', $jsSafe)) {
                           $interpretBackSlashes = (boolean) $jsSafe['interpretBackSlashes'];
                   }
                   if (array_key_exists('script', $jsSafe)) {
                           $script = (boolean) $jsSafe['script'];
                   }
                   if (array_key_exists('jsSafe', $jsSafe)) {
                           $jsSafe = (boolean) $jsSafe['jsSafe'];
                   }
                   else {
                           $jsSafe = false;
                   }
           }
           if ($script) {
                   self::$strings[$string] = $lang->_($string, $jsSafe, $interpretBackSlashes);
                   return $string;
           }
           else {
                   return $lang->_($string, $jsSafe, $interpretBackSlashes);
           }
   }
   
    /**
     * Passes a string thru an sprintf
     *
     * @access      public
     * @param       format The format string
     * @param       mixed Mixed number of arguments for the sprintf function
     * @since       1.0
     */
    public static  function sprintf($string)
    {
            $lang =& functions::getLanguage();
            $args = func_get_args();
            if (count($args) > 0) {
                    $args[0] = $lang->_($args[0]);
                    return call_user_func_array('sprintf', $args);
            }
            return '';
    }

    
    /**
    * Passes a string thru an printf
    *
    * @access      public
    * @param       format The format string
    * @param       mixed Mixed number of arguments for the sprintf function
    * @since       1.5
    */
   function printf($string)
   {
           $lang =& functions::getLanguage();
           $args = func_get_args();
           if (count($args) > 0) {
                   $args[0] = $lang->_($args[0]);
                   return call_user_func_array('printf', $args);
           }
           return '';
   }


}

?>