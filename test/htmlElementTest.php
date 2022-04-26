<?php
use PHPUnit\Framework\TestCase;

final class htmlElementTest extends TestCase{
    
    function DPhtmlElementTest(){
        $p = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],["Este parrafo tiene texto"],false);
        return [
            "br"=>[
                '<br>',
                'br',
                [],
                [],
                true
            ],
            "ParrafitoSimple" =>[
                '<p class="texto" id="parrafo1">Este parrafo tiene texto</p>',
                'p',
                [
                    "class"=>"texto",
                    "id"=>"parrafo1"
                ],
                ["Este parrafo tiene texto"],
                false
            ],
            "DIV con Parrafazda" =>[
                '<div id="divcentrado"><p class="texto" id="parrafo1">Este parrafo tiene texto</p></div>',
                "div",
                ["id"=>"divcentrado"],
                [$p],
                false
            ]
        ];
    }

    /**
     * @dataProvider DPhtmlElementTest
     */
    public function testToHTML($htmlText,$tagname,$atributes,$content,$isEmpy){
        $tagObject = new htmlElement($tagname,$atributes,$content,$isEmpy);
        $this->assertEquals($htmlText,$tagObject->gethtml());
    }

    public function testaddContent(){
        $p = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],[],false);
        $p->addContent("Este parrafo tiene texto");
        $div1 = new htmlElement("div",["id"=>"divcentrado"],[],false);
        $div1->addContent($p);
        $div1->addContent($p);
        $resultado1='<div id="divcentrado"><p class="texto" id="parrafo1">Este parrafo tiene texto</p><p class="texto" id="parrafo1">Este parrafo tiene texto</p></div>';
        $this->assertEquals($resultado1,$div1->getHtml());
    }

    public function testaddAtribute(){
        $div1 = new htmlElement("div",[],[],false);
        $div1->addAtribute("id","divcentrado");
        $resultado1='<div id="divcentrado"></div>';
        $this->assertEquals($resultado1,$div1->getHtml());
    }
    
    public function testremoveAttribute(){
        $p = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],["Este parrafo tiene texto"],false);
        $p->removeAttibute("class");
        $resultado1='<p id="parrafo1">Este parrafo tiene texto</p>';
        $this->assertEquals($resultado1,$p->getHtml());
    }
    
    public function testisSameTag(){
        $p1 = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],["Este parrafo tiene texto"],false);
        $p2 = new htmlElement("p",["class"=>"texto","id"=>"parrafo1"],["Este parrafo tiene texto"],false);
        $this->assertTrue($p1->isSameTag($p2));
    }
}