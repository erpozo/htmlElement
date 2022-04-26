<?php

class htmlElement{
    private string $tagName;
    private array|null $atribute;
    private array|null $content;
    private bool $isEmpy;

    public function __construct(string $tagName, array|null $atribute=null, array|null $content=null, bool $isEmpy=false)
    {
        $this->tagName = $tagName;
        $this->atribute = $atribute;
        $this->content = $content;
        $this->isEmpy = $isEmpy;
    }
    public function getTagName(){
        return $this->tagName;
    }
    public function getAtribute(){
        return $this->atribute;
    }
    public function getContent(){
        return $this->content;
    }
    public function getIsEmpy(){
        return $this->isEmpy;
    }
    public function addAtribute(string $atributeName, string $atributeWorth){
        $this->atribute[$atributeName]=$atributeWorth;
    }
    public function removeAttibute(string $atributeName){
        $this->atribute[$atributeName]=null;
    }
    public function isSameTag(htmlElement $element){
        return $this->tagName==$element->tagName;
    }
    public function getHtml(){

    }
}