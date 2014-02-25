<?php

//include("../../core/listas/listas.class.php");
/**
*
*/
class td {
        
    var $column = "";
    var $col = "";
    var $arguments = Array();
    
    public function get_td(){
        return $this->column;
    }
    
    public function __construct(){
        
    }
    
    public function td1 ($arg,$data){
        $this->col = $data;
        $this->column = "<td";
        $this->arguments = $arg;
        foreach($arg as $key => $value){            
            $this->column .=  " $key=\"$value\" ";
        }
         
        $this->column .= ">".$this->col."</td>";
    }
    
    public function td2 ($arg){
        $this->col = $arg[0];
        $this->column = "<td";
        $this->arguments = array_slice($arg,1); //[1];
        $tal = array_slice($arg,1); //$arg[1];
        $tal = $tal[0];
        foreach($tal as $key => $value){            
            $this->column .=  " $key=\"$value\" ";
            //echo "s".$key."s";
        }
         
        $this->column .= ">".$this->col."</td>";
        //echo $this->col;
    }
    
    public function print_td(){
        echo $this->column;
    }
}



/**
 *
 *
 *
 */

class l_td extends simpleList {
    var $columns;
    var $cant = 0;
    var $col = "";
    
    public function __construct(){
        $this->columns = new simpleList();
    }
    
    public function add_col1($col,$data){
        $t = new td();
        $t->td1($col,$data);
        $this->columns = $this->add_last($t);
    }
    
    public function add_col($data){
        $t = new td();
        $t->td2($data);
        $this->columns = $this->add_last($t);
    }
    
	/**
	 * function p_td prepare a td to be added to a tr
	 */
    public function p_td(){
        $p = $this->first;
        while($p){
            $i1 = $p->get_object();
            /*
            echo "<br><br>";
            echo htmlentities($i1->get_td());
            echo "<br><br>";
            */
            $this->col .= $i1->get_td();
            $p = $p->get_next();
        }
        $this->count_tds();
    }
    
    public function count_tds(){
        $p = $this->first;
        $tmp = 0;
        while($p){
            $p = $p::get_next();
            $tmp++;
        }
        $cant = $tmp;
        //return $tmp;
    }
    
    public function get_count_tds(){
        return $this->cant;
    }
    
    public function get_tds(){
        return $this->col;
    }
}




/**
*
*/
class tr {
    
    var $row = "";
    
    var $rows = 0;
    
    var $cols;
    
    var $arguments = array();
    
    public function get_tr (){
        return $this->row;
    }
    
    public function __construct(){
        
    }
	
	public function tr ($arg){
		//var_dump($arg);
		//print_r($arg);
		//exec('echo ')
        $c = $arg[0];
		//var_dump($c);
		$this->cols = $c->get_tds();
		//echo htmlentities($this->cols);
        $this->row = "<tr";
        //$this->arguments = $arg;
        $this->arguments = array_slice($arg,1); //[1];
        $tal = array_slice($arg,1); //$arg[1];
        $tal = $tal[0];
        foreach($tal as $key => $value){            
            $this->row .=  " $key=\"$value\" ";
            $this->rows++;
        }
        $this->row .= ">" . $this->cols . "</tr>";
		//echo htmlentities($this->row);
        //echo $this->col;
    }
    
    public function tr1 ($arg,$tds){
        
        if(is_object($tds)){
            if (get_class($tds) == "l_td"){
                $this->cols = $tds->get_tds();
            }elseif (get_class($tds) == "td"){
                $this->cols = $tds->get_td();
            }elseif(is_array($tds)){
                $i1 = new l_td();
                foreach($tds as $td){
                    $n1 = new td($td);
                    $i1->add_col2($td);
                }
                $this->cols = $tds->get_tds();
            }else{
                $this->cols = $tds;
            }
        }else{
            //echo htmlentities($tds);
            $this->cols = $tds;
        }
        
        
        $this->row = "<tr";
        $this->arguments = $arg;
        foreach($arg as $key => $value){
            $this->row .=  " $key=\"$value\" ";
            $this->rows++;
        }
        $this->row .= ">" . $this->cols . "</tr>";
        //echo "<br>tal" . htmlentities($this->row) . "tal<br>";
    }
    
    public function print_tr(){
        echo $this->row;
    }
}



/**
 *
 *
 *
 *
 *
 *
 */

 class l_tr extends simpleList {
    var $content;
    var $cant = 0;
    var $row = "";
    
    public function __construct(){
        $this->content = new simpleList();
    }
    
    public function add_row1($arg,$columnas){
        $t = new tr();
        $t->tr1($arg,$columnas);
        $this->content = $this->add_last($t);
    }
	
	public function add_row($data){
        $t = new tr();
        $t->tr($data);
        $this->content = $this->add_last($t);
    }
    
	/**
	 * p_tr function that prepares the rows to be added to the table
	 * 
	 * @param 
	 * 
	 * @return 
	 * 
	 */
    public function p_tr(){
        $p = $this->first;
        $out = "";
        while($p){
            
            $i1 = $p->get_object();
            $this->row .= $i1->get_tr();
            $p = $p->get_next();
            
        }
		$this->count_trs();
        //return $out;
    }
    
    public function count_trs(){
        $p = $this->first;
        $tmp = 0;
        while($p){
            $i1 = $p->get_object();
            $i2 = $i1->get_tr();
            $p = $p->get_next();
            $tmp++;
        }
        $cant = $tmp;
        //return $tmp;
    }
    
    public function get_count_trs(){
        return $this->cant;
    }
    
    public function get_trs(){
        return $this->row;
    }
}


/**
 *
 *
 *
 */

class table {
    
    var $table = "";
    
    var $rows;
    
    var $content;
    
    var $arguments = Array();
    
    public function get_tr (){
        return $this->table;
    }
    
    public function __construct(){
        
    }
    
    public function p_table ($arg,$trs){
        
        if (get_class($trs) == "l_tr"){
            $this->content = $trs->get_trs();
        }elseif (get_class($trs) == "tr"){
            $this->content = $trs->get_tr();
        }elseif(is_array($trs)){
            $i1 = new l_tr();
            foreach($trs as $tr){
                //$n1 = new tr($tr);
                //$i1->add_col2($tr);
            }
            $this->content = $trs->get_trs();
        }
        
        $this->table = "<table";
        $this->arguments = $arg;
        foreach($arg as $key => $value){
            $this->table .=  " $key=\"$value\" ";
        }
        
        $this->table .= ">" . $this->content . "</table>";
		//echo S3S.htmlentities($this->table).S3S;
    }
    
    public function print_table(){
        echo $this->table;
    }
	
	public function get_table(){
		return $this->table;
	}
	
}

?>