<?php
/**
 * Clase nodo para el manejo de listas
 *
 */

class node {
    
    //object a ser listado
    public $object;
    
    //siguente de la cadena
    public $siguiente;
    
    public function __construct($object = null)
    {
        $this->object = $object;
        $this->siguiente = null;
    }
    
    /**
     * Funcion que clona un nodo
     *
     * @param nodo $nodo Nodo a clonar
     * @return nodo Nodo clonado
     */
    static public function clone_node($nodo){
        
        $tal = new node();
        $tal = $nodo;
        return $tal;
    }
    
    /**
     * Funcion que retorna un object (nodo)
     *
     * @return Object object del nodo
     *
     */
    public function get_object(){
        return @$this->object;
    }
    
    /**
     * Funcion que retorna el siguiente nodo (enlace)
     *
     * @return Object Enlace al siguiente
     */
    public function get_next(){
        return @$this->siguiente;
    }
    
    /**
     * Funcion que asigna un object al nodo
     *
     * @param Object $object parametro a asignar a la variable object
     * @return void
     */
    public function set_object($object){
        $this->object = $object;
    }
    
    /**
     * Funcion que asigna un siguetne al nodo
     *
     * @param Object $object object a enlazar
     * @return void
     */
    public function set_next($siguiente){
        $this->siguiente = $siguiente;
    }
    
}
?>