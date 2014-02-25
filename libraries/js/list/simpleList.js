/**
 * @author fauzinated
 * 
 * Class node creates a node for Simple List use
 * 
 * @version 0.1
 * 
 * @since 0.1
 * 
 */


var node = function (obj,type,ref){
	
	
	//object to be listed (this project must be the json containing the las change)
	this.obj  = obj;
	
	//type of change made, acl, rule, basic, etc (For tab handling)
	this.type = type;
	
	//reference to the change mad
	this.ref = ref;
	
	//links 
	this.prev = null; 
	this.next = null;
	
};

// Add methods like this.  All Person objects will be able to invoke this
node.prototype.speak = function(){
    //document.writeln("Howdy, my name is " + this.name);
};

node.prototype.setNext = function(prox){
	this.next = prox;
};


node.prototype.setPrev = function(prev){
	this.prev = prev;
};

node.prototype.getNext = function(){
	return this.next;
};


node.prototype.equals = function(x)
{
  var p;
  for(p in this) {
      if(typeof(x[p])=='undefined') {return false;}
  }

  for(p in this) {
      if (this[p]) {
          switch(typeof(this[p])) {
              case 'object':
                  if (!this[p].equals(x[p])) { return false; } break;
              case 'function':
                  if (typeof(x[p])=='undefined' ||
                      (p != 'equals' && this[p].toString() != x[p].toString()))
                      return false;
                  break;
              default:
                  if (this[p] != x[p]) { return false; }
          }
      } else {
          if (x[p])
              return false;
      }
  }

  for(p in x) {
      if(typeof(this[p])=='undefined') {return false;}
  }

  return true;
};




/**
 * 
 * simple List creates nodes links
 * 
 * 
 */

var simpleList = function(){
	
	this.first;
	this.last;
	
};


simpleList.prototype.addLast = function(nodo){
	
	//nodo = new node(name);
        
        if(!this.first){
            this.first = nodo;
            this.last = nodo;
        }else{
        	nodo.setPrev(this.last);
            this.last.setNext(nodo);
            this.last = nodo;
        }
        //return this;
        
};


/**
 * funcion que cuenta cuantos nodos hay en la lista
 *
 * @param
 * @return int cantidad de nodos
 */
simpleList.prototype.countList = function(){
	
	cant = 0;
	
	nodo = this.first;
	
	//return this.legth;
	while (nodo){
	    cant++;
	    nodo = nodo.getNext();
	    
	    //just in case
	    if(cant >= 500) break;
	}
	
	return cant;
};
