<?php

class htmlElement{
    private string $tagName;
    private array $atribute;
    private array $content;
    private bool $isEmpty;

    static $totalhtmlElement = 0;
    static $ids = [];
    const EMPTY_TAGS = ["br","hr","img","input"];

    /**
     * @param string $tagName
     * Nombre de etiqueta HTML
     * @param array $atribute
     * Array asociativo de atributos
     * @param array|htmlElement $content
     * Contenido de la etiqueta
     * @param bool $isEmpty
     * Indica si es una etiqueta vacia
     */
    public function __construct(string $tagName, array $atribute=[], array $content=[]){
        ++self::$totalhtmlElement;
        $tagName = strtolower($tagName);
        $this->tagName = $tagName;
        foreach($atribute as $key=>$value){
            $this->addAtribute($key,$value);
        }
        $this->content = $this->validateisEmpty($tagName)?[]:$content;
        $this->isEmpty = $this->validateisEmpty($tagName);
    }

    public function __clone(){
        return new htmlElement($this->tagName,$this->atribute,$this->content);
    }

    /**
     * Valida si el tagName pertenece a una etiqueta vacia
     * @param string $nameTagTexted
     * Nombre del tag a validar
     * @return bool
     * True si pertenece a una etiqueta vacia
     */
    private function validateisEmpty($nameTagTexted){
        return in_array($nameTagTexted,self::EMPTY_TAGS);
    }

    /**
     * Devuelve el tagName del elemento HTML
     * @return string
     */
    public function getTagName(){
        return $this->tagName;
    }

    /**
     * Devuelve el array atributos del elemento HTML
     * @param string $atributeName
     * Devolvera solo el valor del atributo seleccionado
     * @return array|string
     */
    public function getAtribute($atributeName=""){
        if($atributeName=="")return $this->atribute;
        foreach($this->atribute as $key=>$value){
            if($key==$atributeName)return $value;
        }
    }

    /**
     * Devuelve el content del elemento HTML
     * @return array|htmlElement
     */
    public function getContent(){
        return $this->content;
    }

    /**
     * Devuelve isEmpty del elemento HTML
     *  @return bool
     */    
    public function getisEmpty(){
        return $this->isEmpty;
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
        if(strtolower($atributeName)=="id"){
            array_push(self::$ids,$atributeWorth);
        }
        $this->atribute[strtolower($atributeName)]=strtolower($atributeWorth);
    }

    /**
     * Elimina el atributo seleccionado del elemento HTML
     * @param string $atributeName
     * Nombre del atributo a eliminar
     */
    public function removeAtribute(string $atributeName){
        $atributeName = strtolower($atributeName);
        if($atributeName=="id"){
            unset(self::$ids[$this->getAtribute("id")]);
        }
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
        return "<".$this->tagName.$this->whiteAtribute().">".$this->whiteContent().$this->whiteCloseTag();
    }

    /**
     * Escribe la parte del codigo HTML referente a los atributos
     * @return string
     */
    private function whiteAtribute(){
        $whiteAtribute=" ";
        if(is_array($this->atribute)){
            foreach($this->atribute as $key =>$value){
            $whiteAtribute .= $value==null?"":$key . '="' . $value . '" ';
            }
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
            if(is_object($value) && get_class($value)=="htmlElement"){
                $whiteContent .= $value->getHTML();
            }
            elseif(is_string($value)){
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
        return $this->isEmpty?"":"</".$this->tagName.">";
    }
}


$parrafOriginal1 = new htmlElement("p",["class"=>"centrado"]);
$parrafOriginal1->addAtribute("id","parrafo1");
$parrafOriginal2 = new htmlElement("p",["class"=>"centrado"]);
$parrafOriginal2->addAtribute("id","parrafo2");
$parrafOriginal3 = new htmlElement("p",["class"=>"centrado"]);
$parrafOriginal3->addAtribute("id","parrafo3");
$parrafOriginal4 = new htmlElement("p",["id"=>"parrafo4","class"=>"centrado"]);
print_r(htmlElement::$ids);
$parrafOriginal3->removeAtribute("id");
print_r(htmlElement::$ids);