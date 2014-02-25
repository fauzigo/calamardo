<?php
/**
 * Clase para el manejo de listas de objetos, suponemos que el objeto a listar podra ser de cualquier clase
 *
 * @package list
 *
 * @versio 1.0
 *
 * @copyright traefacil 2011, Fauzi Gomez
 *
 **/


require (dirname(__FILE__).DS."node.class.php");

class simpleList {
    
    //si es el first de la lista
    public $first;
    
    //si es el final de la lista
    public $last;
    
    
    /**
     * Constructor de la clase, inicializa todos los parametros en null
     *
     */
    public function __construct()
    {
        $this->first = null;
        $this->last = null;
    }
    
    
    /**
     * Funcion que crea una lista nueva a partir de ona pasada por parametro
     *
     * @param lista $lista Lista a clonar
     * @return listaSimple lista clonada 
     *
     */
    static public function clone_list($lista){
        
        $tal = new simpleList();
        $tal = $lista;
        return $tal;
    }
    
    
    /**
     * funcion para agregar un nodo al fina de la lista
     *
     * @param Object $objeto objeto a agregar en la lista
     * @return boolean true si satisfactorio, false de lo contrario
     *
     */
    public function add_last($objeto)
    {
        $nodo = new node($objeto);
        
        if(!$this->first){
            $this->first = $nodo;
            $this->last = $nodo;
        }else{
            $last = $this->last;
            $last->set_next($nodo);
            $this->last = $nodo;
        }
        return $this;
    }
    
    /**
     * funcion que agrega un nodo al principio de la lista
     *
     * @param Object $objeto objeto a agregar
     * @return simpleList lista modificada
     *
     */
    public function add_first($objeto){
        
        $nodo = new node($objeto);
        
        if(!$this->first){
            $this->first = $nodo;
            $this->last = $nodo;
        }else{
            $nodo->set_next($this->first);
            $this->first = $nodo;
        }
        return $this;
    }
    
    
    
    
    /**
     * funcion que cuenta cuantos nodos hay en la lista
     *
     * @param
     * @return int cantidad de nodos
     */
    public function count_list(){
        $cant = 0;
        
        $node = $this->first;
        while ($node != NULL){
            $cant ++;
            $node = $node->get_next();
            if($cant >= 20000) break;
        }
        
        return $cant;
    }
    
    /**
     * funcion que agrega un objeto en una posicion dada
     *
     * @param int $posicion en que posicion agregar
     * @return void
     */
    public function add_pos($objeto,$posicion){
        $tamano = $this->count_list();
        
        if($posicion == 1){
            $this->add_first($objeto);
        }
        elseif($tamano <= $posicion){
            $this->add_last($objeto);
        }else{
            $cont = 1;
            $node = $this->first;
            while($cont < $posicion){
                $node = $node->get_next();
                $cont++;
            }
            $nuevo = new node($objeto);
            $nuevo->set_next($node->get_next());
            $node->set_next($nuevo);
        }
    }
    
}

?>