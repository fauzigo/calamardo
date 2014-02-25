<?php
/**
 * Clase html para el manejo de formas html de facil
 *
 */

class html{
    
    
    /**
     * input a funtion to create inputs of diferents types acording to params
     *       an easy way to write a lot od those
     *
     * @param text $type type of input
     * @param text $name name of the input
     * @param text $value value of th input
     * @param int $size size of the input
     * @param int $legnth maxlegnth of the input
     * @param text $id id of the imput
     * @param boolean $readonly if the input is readonly
     * @param boolean $disabled if the input is desabled
     * @param text $style if any style
     * @param int $tabindex if any order for indexing
     * @param text $class some extra class
     *
     * @return text the formed input
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    
    public static function input($type='text',$name,$value=null,$size=null,$length=null,$id=null,
                                  $readonly=false,$disabled=false,$style=null,$tabindex=null,$class=null,$script=null){
        
        if($type != "radio" || $type != "select" || $type != "button" ){
            $type = " type='$type'";
            $name = (!is_null($name))? " name='$name' ":"";
            $value = (!is_null($value))? " value='$value' ":"";
            $size = (!is_null($size))? " size='$size' ":"";
            $id = (!is_null($id))? " id='$id' ":"";
            $length = (!is_null($length))? " length='$length' ":"";
            $readonly = ($readonly)? " readonly='readonly' ": "";
            $disabled = ($disabled)? " disabled='disabled' ": "";
            $style = (!is_null($style))? " style='$style' ":"";
            $tabindex = (!is_null($tabindex) || $tabindex > 0)? " tabindex='$tabindex' ":"";
            $script = (!is_null($script))? " script='$script' ":"";
            //$length = (!is_null($value))? " length='$length' ":"";
            return "<input". $type .$name . $id . $size . $length . $readonly . $disabled . $style . $tabindex ."/>";
        }else{
            return null;
        }
        
    }
    
    /**
     * inputFromArray same as before but arguments have to come on an array
     *                  order wont be a proble, just fill the array 
     *
     * @param Array $array array with the params of the input
     *
     * @return text the final formed input type
     *
     * No validation added, so it wont work well on  radios, selects, butons,and other
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    public static function inputFromArray($array){   
    
        $input = "<input";
        $id = '';
        foreach($array as $key => $value){
            if($key == "label"){
                $label = $value;
                continue;
            }
            /*if($key == "id"){
                $id = $value;
            }*/
            
            $id = ($key == "id")? $value : $id;
            
            $input .=  " $key=\"$value\" ";
            
            //echo htmlentities ($input).'<br>';
        }
        
        
        $input .= "/>";
        
        $input = (isset($label))? html::createLabel($id,$label).$input : $input;
        
        return $input;
        
    }
    
    
    /**
     * tableFromArray same as before but arguments have to come on as an array
     *                  order wont be a problem, just fill the array 
     *
     * @param Array $array array with the params of the table
     * @param String $tBody body of the tables, ej. <tr><td>....</td></tr>
     *
     * @return text the final formed table tag
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    public static function tableFromArray($array,$tBody){   
    
        $table = "<table";
        
        foreach($array as $key => $value){            
            $table .=  " $key=\"$value\" ";
        }

        $table .= "/>";
        
        $table .= $tBody."</table>";
        
        return $table;
        
    }
    
    
    
    
    /**
     * thFromArray createa table row with parameter given on an array
     *                  
     *
     * @param Array $array array with the params of the row
     * @param String $tBody body of the tables, ej. <tr><td>....</td></tr>
     *
     * @return text the final formed table tag
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    public static function thFromArray($array,$tBody){
    
        $table = "<th";
        
        foreach($array as $key => $value){            
            $table .=  " $key=\"$value\" ";
        }

        $table .= ">";
        
        $table .= $tBody."</th>";
        
        return $table;
        
    }
    
    
    /**
     * trowFromArray createa table row with parameter given on an array
     *                  
     *
     * @param Array $array array with the params of the row
     * @param String $tBody body of the tables, ej. <tr><td>....</td></tr>
     *
     * @return text the final formed table tag
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    public static function trowFromArray($array,$tBody){   
    
        $table = "<tr";
        
        foreach($array as $key => $value){            
            $table .=  " $key=\"$value\" ";
        }

        $table .= "/>";
        
        $table .= $tBody."</tr>";
        
        return $table;
        
    }
    
    
    
    /**
     * tcolFromArray create a table row with parameter given on an array
     *                  
     *
     * @param Array $array array with the params of the column
     * @param String $tBody body of the column, ej. <div><p>....</div></p>
     *
     * @return text the final formed table tag
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    public static function tcolFromArray($array,$tBody){   
    
        $table = "<td";
        
        foreach($array as $key => $value){            
            $table .=  " $key=\"$value\" ";
        }

        $table .= "/>";
        
        $table .= $tBody."</td>";
        
        return $table;
        
    }
    
    
    /**
     * divFromArray create a div row with parameter given on an array
     *                  
     *
     * @param Array $array array with the params of the div
     * @param String $tBody body of the div, ej. <table><p>....</table></p>
     *
     * @return text the final formed table tag
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    public static function divFromArray($array,$dBody){   
    
        $form = "<div";
        
        foreach($array as $key => $value){            
            $form .=  " $key=\"$value\" ";
        }
        
        $form .= ">".$dBody."</div>";
        
        return $form;
        
    }
	
	
	/**
	 * h1FromArray  create a h1 tag, params must be given as array
	 * 
	 * @param Array $array the h1 params
	 * @param String $hBody
	 * 
	 * @return text the formed h1
	 * 
	 * @author Fauzi Gomez
	 * @copyright GPL
	 * @version 1.0
	 */
	 
	 public static function h1FromArray($array,$hBody){
	 	
		$h1 = "<h1";

        foreach($array as $key => $value){            
            $h1 .=  " $key=\"$value\" ";
        }
        
        $h1 .= ">".$hBody."</h1>";

        return $h1;

	 }
	 
	 
	 
	 /**
	 * hFromArray  create a h* tag, params must be given as array, * is the h class
	 * 
	 * @param Array $array the h* params
	 * @param String $hBody
	 * 
	 * @return text the formed h*
	 * 
	 * @author Fauzi Gomez
	 * @copyright GPL
	 * @version 1.0
	 */
	 
	 public static function hFromArray($type,$array,$hBody){
	 	
		$h = "<h".$type;

        foreach($array as $key => $value){            
            $h .=  " $key=\"$value\" ";
        }
        
        $h .= ">".$hBody."</h1>";

        return $h;

	 }
	 
	 
	 
	 /**
	 * liFromArray  create a li tag, params must be given as array
	 * 
	 * @param Array $array the h1 params
	 * @param String $hBody
	 * 
	 * @return text the formed li
	 * 
	 * @author Fauzi Gomez
	 * @copyright GPL
	 * @version 1.0
	 */
	 
	 public static function liFromArray($array,$lBody){
	 	
		$li = "<li";

        foreach($array as $key => $value){            
            $li .=  " $key=\"$value\" ";
        }
        
        $li .= ">".$lBody."</li>";

        return $li;

	 }
	 
	 
	 /**
	 * ulFromArray  create a ul tag, params must be given as array
	 * 
	 * @param Array $array the ul params
	 * @param String $ulBody
	 * 
	 * @return text the formed ul
	 * 
	 * @author Fauzi Gomez
	 * @copyright GPL
	 * @version 1.0
	 */
	 
	 public static function ulFromArray($array,$ulBody){
	 	
		$ul = "<ul";

        foreach($array as $key => $value){            
            $ul .=  " $key=\"$value\" ";
        }
        
        $ul .= ">".$ulBody."</ul>";

        return $ul;

	 }
    
    
    /**
     * formFromArray create a form row with parameter given on an array
     *                  
     *
     * @param Array $array array with the params of the div
     * @param String $tBody body of the div, ej. <table><p>....</table></p>
     *
     * @return text the final formed table tag
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    public static function formFromArray($array,$dBody){   
    
        $form = "<form";
        
        foreach($array as $key => $value){            
            $form .=  " $key=\"$value\" ";
        }
        
        $form .= ">".$dBody."</form>";
        
        return $form;
        
    }
    
    
    /**
     * radio    create a radio butom from arguments
     *
     * @param array $array elements of the radio, only the value is used in case the array has keys
     * @param text $name name of the input
     * @param text $checked the checked one if neded
     * @param int $legnth maxlegnth of the input
     * @param text $id id of the input
     * @param boolean $disabled if the input is desabled
     * @param text $script if any ex. onfocus()
     *
     * @return text the formed input
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    
    public static function radio($array,$name,$id=null,$checked=null,
                                  $disabled=false,$script=null){
        
        $output = "";
        
        $c="";
        
        if(is_numeric($checked))
            $chequeado = 0;
            
        $forLabeling=0;
        
        $type = " type='radio'";
        $name = (!is_null($name))? " name='$name' ":"";
        //$label = (!is_null($label))? "<label for='$id'>$label</label>":"";
        //$id = (!is_null($id))? " id='$id' ":"";
        $disabled = ($disabled)? " disabled='disabled' ": "";
        $script = (!is_null($script))? " $script ":"";
        //$length = (!is_null($value))? " length='$length' ":"";
        
        foreach($array as $key=>$value){
            $output .= "<input".$type;
            if(is_numeric($checked) && $checked == $chequeado){
                $c = " checked ";
            }
            if(is_string($checked) && $checked == $value){
                $c = " checked ";
            }
            $output .= $name."id='$id$forLabeling'".$disabled.$script.$c."value='$value'";
            $output .= "/> <label for='$id$forLabeling'>$key</label>";
            if(is_numeric($checked))
                $chequeado++;
            $forLabeling++;
        }
        
        return $output;
    }
    
    
    /**
     * select    create a select input from arguments
     *
     * @param array $array elements of the select, only the value is used in case the array has keys
     *                      key must be the text and the value must be value 
     * @param text $name name of the input
     * @param text $selected the selected one if neded
     * @param text $id id of the imput
     * @param int $size size of the select
     * @param boolean $multiple if it's multiple
     * @param boolean $disabled if the input is desabled
     * @param text $script if any ex. onfocus()
     *
     * @return text the formed input
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    
    public static function select($array,$name,$selected=null,$size=1,$multiple=null,
                                  $disabled=false,$id=null,$script=null){
        
        $output;
        $c="";
        
        if(is_numeric($selected))
            $chequeado = 0;
        
        //$type = " type='select'";
        $name = (!is_null($name))? " name='$name' ":"";
        $id = (!is_null($id))? " id='$id' ":"";
        $size = (!is_null($size))? " size='$size' ":"";
        $multiple = (!is_null($multiple))? " multiple ":"";
        $disabled = ($disabled)? " disabled='disabled' ": "";
        $script = (!is_null($script))? " $script ":"";
        //$length = (!is_null($value))? " length='$length' ":"";
        
        $output = "<select $name $id $multiple $disabled $script $size>";
        foreach($array as $key=>$value){
            $output .= "<option ";
            if(is_numeric($selected) && $selected == $chequeado){
                $c = " selected ";
            }
            if(is_string($selected) && ($selected == $value || $selected == $key)){
                $c = " selected ";
            }
            $output .= " value='$value' $c >";
            $output .= $key;
            $output .= "</option>";
            if(is_numeric($selected))
                $chequeado++;
        }
        
        $output .= "</select>";
        
        return $output;
    }
    
    /**
     * select    create a button from arguments
     *
     * @param text $type type of button button,reset or submit 
     * @param text $name name of the input
     * @param text $value the value
     * @param text $class if some
     * @param boolean $disabled if the input is desabled
     * @param text $script if any ex. onfocus()
     *
     * @return text the formed input
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    public static function button($type='button',$name,$value=null,$disabled=false,$class=null,$script=null){
        $output;
        $disabled = ($disabled)? " disabled=disabled ":"";
        $class = ($class)? " class=$class ":"";
        $output = "<input type='$type' name='$name' value='$value' $disabled $class $script >";
        return $output;
    }
    
    
    /**
     * checkbox    create a checkbox from arguments
     *
     * @param text $name name of the input
     * @param text $value the value
     * @param text $checked the checked one if neded
     * @param int $label if it has a label
     * @param text $id id of the imput
     * @param boolean $disabled if the input is desabled
     * @param text $script if any ex. onfocus()
     *
     * @return text the formed input
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    
    public static function checkbox($name,$value=null,$id=null,$label=null,$checked=false,
                                  $disabled=false,$script=null){
        
        $output;
        
        if(is_numeric($checked))
            $chequeado = 0;
        
        $type = " type='checkbox'";
        $name = (!is_null($name))? " name='$name' ":"";
        $label = (!is_null($label))? "<label for='$id'>$label</label>":"";
        $id = (!is_null($id))? " id='$id' ":"";
        $disabled = ($disabled)? " disabled='disabled' ": "";
        $script = (!is_null($script))? $script :"";
        //$length = (!is_null($value))? " length='$length' ":"";
        
        $output = "<input $type ";
        $output .= $name.$id.$disabled.$script.$checked." value='$value'";
        $output .= "/>$label";
            
        
        return $output;
    }
    
    /**
     * checkboxFromArray same as before but arguments have to come on an array
     *                  order wont be a proble, just fill the array 
     *
     * @param Array $array array with the params of the input
     *
     * @return text the final formed input type
     *
     * No validation aded, so it wont work well on  radios, selects, butons,and other
     *
     * @author  Fauzi Gomez
     * @copyright GPL
     * @version 1.0
     */
    public static function checkboxFromArray($array){
        
        $input = "<input type=\"checkbox\" ";
        foreach($array as $key => $value){
            if($key == "label"){
                $label = $value;
                continue;
            }
            
            $id = ($key == "id")? $value : $id;
            
            $input .=  " $key=\"$value\" ";
        }
        
        
        $input .= "/>";
        
        $input = ($label)? html::createLabel($id,$label.$input) : $input;
        
        return $input;
        
    }
    
    
	
	/**
	 * createLabel function create a label 
	 * 
	 * @param text $id id the label is for
	 * @param text $value the label
	 * 
	 * @return text the formed label
	 * 
	 * @author Fauzi Gomez
	 * @version 1.0
	 */
    public static function createLabel($id,$value){
        return "<label for=\"$id\">$value</label>";
    }
    
    
    /**
     * lintTo    create a href from arguments
     *
     * @param text $href the link to
     * @param text $text the value
     * @param text $title some estra info
     * @param text $class if some
     * @param text $script if any ex. onfocus()
     *
     * @return text the formed link
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
    
    public static function lintTo($href,$text,$title=null,$class=null,$script=null){
        
        $output = "<a href='$href' class='$class' title='$title' $script>$text</a>";
        
        return $output;
    }
	
	
	/**
     * linkFromArray    create a href from arguments
     *
     * @param Array $arreglo the vars
     *
     * @return text the formed link
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
         
    public static function linkFromArray($array,$text=''){
        
		$output = "<a";
        
        foreach($array as $key => $value){            
            $output .=  " $key=\"$value\" ";
        }
        
        $output .= ">".$text."</a>";
        
        return $output;
    }
	
	
	
	/**
     * spanText    create a span from arguments
     *
     * @param text $text the value
     * @param text $id some extra info
     * @param text $class if some
     * @param text $script if any ex. onfocus()
     *
     * @return text the formed span
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
    
    public static function spanText($text,$id=null,$class=null,$script=null){
        
        $output = "<span class='$class' id='$id' $script>$text</span>";
        
        return $output;
    }
	
	/**
     * spanFromArray    create a span from arguments
     *
     * @param array $array the params
     * @param text $text the span text
     *
     * @return text the formed span
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
    
    public static function spanFromArray($array,$text){
    			
    	$output = "<span";
        
        foreach($array as $key => $value){            
            $output .=  " $key=\"$value\" ";
        }
        
        $output .= ">".$text."</span>";
        
        return $output;
    	
    }
	
	
	/**
     * legendFromArray    create a legend from arguments
     *
     * @param array $array the params
     * @param text $text the legend text
     *
     * @return text the formed legend tag
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
    
    public static function legendFromArray($array,$text){
    			
    	$output = "<legend";
        
        foreach($array as $key => $value){            
            $output .=  " $key=\"$value\" ";
        }
        
        $output .= ">".$text."</legend>";
        
        return $output;
    	
        
    }
	
	
	/**
     * fieldsetFromArray    create a fielset tag from arguments
     *
     * @param array $array the params
     * @param text $text the fieldset text
     *
     * @return text the formed fieldset tag
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
    
    public static function fieldsetFromArray($array,$text){
    			
    	$output = "<fieldset";
        
        foreach($array as $key => $value){            
            $output .=  " $key=\"$value\" ";
        }
        
        $output .= ">".$text."</fieldset>";
        
        return $output;
    	
        
    }
	
	
	
	/**
	 * buttonFromArray create a button tag HTML5
	 * 
	 * @param array array with values
	 * 
	 * 
	 * @return buton tag
	 * 
	 * @author FG
	 * @since 1.0
	 * 
	 */
	 public static function buttonFromArray($array,$text){
    			
    	$output = "<button";
        
        foreach($array as $key => $value){            
            $output .=  " $key=\"$value\" ";
        }
        
        $output .= ">".$text."</button>";
        
        return $output;
    	
        
    }
	 
	 
	
    
    
    /**
	 * createMeta function create html's doc meta
	 *
     *
     * @param array $meta array with meta to the index
     *
     * @return text the html meta
     *
     * @author Fauzi Gomez
     * @version 1.0
     */
    public static function createMeta ($meta){
        if(!is_null($meta)){
            $metaTmp="";
            foreach($meta as $line){
                $metaTmp .= "<meta ";
                foreach($line as $key => $value){
                    $metaTmp .= "$key='$value'";
                }
                $metaTmp .= ">";
            }
        }else{
            $metaTmp="";
        }
        return $metaTmp;
    }
    
    /**
     * createHtml create html tag
	 * 
     * @param array $html array with meta to the index
     *
     * @return text the html meta
     *
     * @author Fauzi Gomez
     * @version 1.0
     */
    public static function createHtml($html){
        $htmlTmp="";
        $htmlTmp .= "<html ";
        foreach($html as $key => $value){
            $htmlTmp .= "$key='$value' ";
        }
        $htmlTmp .= ">";
        
        return $htmlTmp;
    }
    
    
    /**
     * createLink to create links tags
     *
     * @param array $link array with meta to the index
     *
     * @return text the html meta
     *
     * @author Fauzi Gomez
     * @version 1.0
     */
    public static function createLink($link){
        if(!is_null($link)){
            $linkTmp="";
            foreach($link as $line){
                $linkTmp .= "<link ";
                foreach($line as $key => $value){
                    $linkTmp .= "$key='$value'";
                }
                $linkTmp .= ">";
            }
        }else{
            $linkTmp="";
        }
        return $linkTmp;
    }
    
    
    /**
     * insert a blank image (must be tiny) usefull to trigger ajax or other JS functions
     *
     * @param varchar $func JS function to call onload (Without the ())
     * @param link $base link base for the images if needed
	 * @param mixed $param params needed
     *
     * @return varchar the html img with onload function
     *
     * @autor Fauzi Gomez
     * @version 1.0
     */
    
    public static function blankImage($func,$base = null,$param = null){
        $output = "";
		if (!is_null($param)){
			//$p1 = preg_split(',', $param);
			//$p2 = preg_replace(',','', $param);
			//foreach ($p1 as $key => $value) {
				//$param .= "'".$value."'";
			//}
		}
		$base = (!is_null($base))? $base : 'images/blank.jpg';
        $param = (!is_null($param))? $param : '';
        $output = "<img src=\"".$base."\" onload=\"".$func."(".$param.")\" >";
		//echo htmlentities($output);
        return $output;
    }
    
    
    
    /**
     * insert a image (must be tiny) for Ajax on load events
     *
     * @param link $base link base for the images if needed
     * @param varchar $alt alternative text
     *
     * @return varchar the html img with onload function
     *
     * @autor Fauzi Gomez
     * @version 1.0
     */
    
    public static function insertImage($base,$alt = null,$func = null){
        $output = "";
        
        $output = (!is_null($func))? " onload='$func()' ":"";

        $output = "<img alt='$alt' src='$base' $output >";
        return $output;
    }
	
	
	
    
    
    /**
     * head create the head of a document
	 * 
	 * Not really working
     *
     */
    
    public static function createHead($html,$meta=null,$base=null,$title,$link=null,$script=null,$extra=null){
        //$output='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        //echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $output = "";
        $htmlTmp="";
        $htmlTmp .= "<html ";
        foreach($html as $key => $value){
            $htmlTmp .= "$key='$value'";
        }
        $htmlTmp .= ">";
        
        $headTmp="<head>";
        
        $base = (!is_null($base))? "<base href='$base'>":"";
        
        //$output .= $base;
        
        if(!is_null($meta)){
            $metaTmp="";
            foreach($meta as $line){
                $metaTmp .= "<meta ";
                foreach($line as $key => $value){
                    $metaTmp .= "$key='$value'";
                }
                $metaTmp .= ">";
            }
        }else{
            $metaTmp="";
        }
        
        $title = "<title>$title</title>";
        
        if(!is_null($link)){
            $linkTmp="";
            foreach($link as $line){
                $linkTmp .= "<link ";
                foreach($line as $key => $value){
                    $linkTmp .= "$key='$value'";
                }
                $linkTmp .= ">";
            }
        }else{
            $linkTmp="";
        }
        
        if(!is_null($script)){
            $scriptTmp="";
            foreach($script as $line){
                $scriptTmp .= "<script ";
                foreach($line as $key => $value){
                    $scriptTmp .= "$key='$value'";
                }
                $scriptTmp .= ">";
            }
        }else{
            $scriptTmp="";
        }
        $output .= $htmlTmp.$headTmp.$base.$metaTmp.$title.$linkTmp.$scriptTmp.$extra;
        
        $output .= "</head>";
        
        return $output;
        
    }
    
}