<?php

class htmlElement{
    private string $tagName;
    private array|null $atribute;
    private array|null $content;
    private bool $isEmpy;


    /**
     * @param string $tagName
     * Nombre de etiqueta HTML
     * @param array|null $atribute
     * Array asociativo de atributos
     * @param array|null $content
     * Contenido de la etiqueta
     * @param bool $isEmpy
     * Indica si es una etiqueta vacia
     */
    public function __construct(string $tagName, array|null $atribute=null, array|null $content=null, bool $isEmpy=true)
    {
        $this->tagName = $tagName;
        $this->atribute = $atribute;
        $this->content = $isEmpy?null:$content;
        $this->isEmpy = $isEmpy;
    }

    /**
     * Devuelve el tagName del elemento HTML
     * @return string
     */
    public function getTagName(){
        return $this->tagName;
    }

    /**
     * Devuelve el atribute del elemento HTML
     * @return array|null
     */
    public function getAtribute(){
        return $this->atribute;
    }

    /**
     * Devuelve el content del elemento HTML
     * @return array|null
     */
    public function getContent(){
        return $this->content;
    }

    /**
     * Devuelve isEmpy del elemento HTML
     *  @return bool
     */    
    public function getIsEmpy(){
        return $this->isEmpy;
    }

    /**
     * Declara el contenido del elemento HTML
     * @param array|string|htmlElement $content
     */
    public function addContent(array|string|htmlElement $content){
        $this->content[] = $content;
    }

    /**
     * Declara los atributos del elemento HTML
     * @param string $atributeName
     * Nombre del atributo
     * @param string $atributeWorth
     * Valor del atributo
     */
    public function addAtribute(string $atributeName, string $atributeWorth){
        $this->atribute[$atributeName]=$atributeWorth;
    }

    /**
     * Elimina el atributo seleccionado del elemento HTML
     * @param string $atributeName
     * Nombre del atributo a eliminar
     */
    public function removeAtribute(string $atributeName){
        unset($this->atribute[$atributeName]);
    }


    /**
     * Compara el tagName de la etiqueta HTML
     * @param htmlElement $element
     * Etiqueta a comparar
     * @return bool true si son iguales
     */
    public function isSameTag(htmlElement $element){
        return $this->tagName==$element->tagName;
    }

    /**
     * Escribe el codigo HTML de la etiqueta
     * @return string
     */
    public function getHtml(){
        return "<".$this->tagName.$this->whiteAtribute.">".$this->whiteContent().$this->whiteCloseTag();
    }

    /**
     * Escribe la parte del codigo HTML referente a los atributos
     * @return string
     */
    private function whiteAtribute(){
        $whiteAtribute=" ";
        foreach($this->atribute as $key =>$value){
            $whiteAtribute .= $value==null?"":$key . '="' . $value . '" ';
        }
        return rtrim($whiteAtribute);
    }

    /**
     * Escribe la parte del codigo HTML referente al contenido
     * @return string
     */
    private function whiteContent(){'"'.
        $whiteContent = "";
        if($this->content==null)return $whiteContent;
        foreach($this->content as $value){
            if(is_object($value)){
                if(get_class($value)=="htmlElement") $whiteContent .= $value->getHTML();
            }else{
                $whiteContent .= $value;
            }
        }
        return $whiteContent;
    }

    /**
     * Escribe el cierre de etiqueta del atributo HTML
     * @return string
     */
    private function whiteCloseTag(){
        return $this->isEmpy?"":"</".$this->tagName.">";
    }
}