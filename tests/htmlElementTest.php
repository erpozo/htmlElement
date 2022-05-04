<?php
use PHPUnit\Framework\TestCase;

final class htmlElementTest extends TestCase{
    
    function DPhtmlElementTest(){
        $p = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],["Este parrafo tiene texto"]);
        return [
            "br"=>[
                '<br>',
                'br',
                [],
                [],
            ],
            "ParrafitoSimple" =>[
                '<p class="texto" id="parrafo1">Este parrafo tiene texto</p>',
                'p',
                [
                    "class"=>"texto",
                    "id"=>"parrafo1"
                ],
                ["Este parrafo tiene texto"]
            ],
            "DIV con Parrafazda" =>[
                '<div id="divcentrado"><p class="texto" id="parrafo1">Este parrafo tiene texto</p></div>',
                "div",
                ["id"=>"divcentrado"],
                [$p]
            ]
        ];
    }

    /**
     * @dataProvider DPhtmlElementTest
     */
    public function testToHTML($htmlText,$tagname,$atributes,$content){
        $tagObject = new htmlElement($tagname,$atributes,$content);
        $this->assertEquals($htmlText,$tagObject->gethtml());
    }

    public function testaddContent(){
        $p = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],[]);
        $p->addContent("Este parrafo tiene texto");
        $div1 = new htmlElement("div",["id"=>"divcentrado"],[]);
        $div1->addContent($p);
        $div1->addContent($p);
        $resultado1='<div id="divcentrado"><p class="texto" id="parrafo1">Este parrafo tiene texto</p><p class="texto" id="parrafo1">Este parrafo tiene texto</p></div>';
        $this->assertEquals($resultado1,$div1->getHtml());
    }

    public function testaddAtribute(){
        $div1 = new htmlElement("div",[],[]);
        $div1->addAtribute("id","divcentrado");
        $resultado1='<div id="divcentrado"></div>';
        $this->assertEquals($resultado1,$div1->getHtml());
    }
    
    public function testremoveAttribute(){
        $p = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],["Este parrafo tiene texto"]);
        $p->removeAtribute("class");
        $resultado1='<p id="parrafo1">Este parrafo tiene texto</p>';
        $this->assertEquals($resultado1,$p->getHtml());
    }
    
    public function testisSameTag(){
        $p1 = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],["Este parrafo tiene texto"]);
        $p2 = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],["Este parrafo tiene texto"]);
        $this->assertTrue($p1->isSameTag($p2));
    }

    public function testcloneElement(){
        $parrafOriginal = new htmlElement("p",["id"=>"parrafo1","class"=>"centrado"]);
        $parrafoClonado = clone $parrafOriginal;
        $parrafoClonado->addContent("Este si tiene texto");
        $resultado = $parrafOriginal->getHtml().$parrafoClonado->getHtml();
        $esperado = '<p id="parrafo1" class="centrado"></p><p class="centrado">Este si tiene texto</p>';
        $this->assertEquals($esperado,$resultado);
    }
}