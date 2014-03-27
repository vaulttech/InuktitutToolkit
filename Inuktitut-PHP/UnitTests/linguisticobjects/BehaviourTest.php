<?php

require_once 'linguisticobjects/Behaviour.php';
require_once 'linguisticobjects/Action.php';
require_once 'linguisticobjects/ActionFactory.php';

/**
 * Test class for Behaviour.
 * Generated by PHPUnit on 2011-02-03 at 13:40:52.
 */
class BehaviourTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Behaviour
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Behaviour('','','');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
    
    public function test___construct() {
    	$behaviour = new Behaviour('q','s-i(ng)','iq');
    	$actionOnStem = $behaviour->actionOnStem();
    	$actionVV = $behaviour->actionVV();
    	$this->assertEquals(Action::DELETION,$actionOnStem->type(),"");
    	$this->assertEquals(Action::INSERTION,$actionVV->type(),"");
    }
    
    public function test_applyOnStem () {
    	$behaviour = new Behaviour('q','s-i(ng)','u');
    	$res = $behaviour->applyOnStem('namaaq');
    	$att = 'namaangu';
    	$this->assertEquals($att,$res,"");
    	
    	$behaviour = new Behaviour('V','n-i(ng)','innaq');
    	$res = $behaviour->applyOnStem('qaujisaqtau');
    	$att = 'qaujisaqtaunginnaq';
    	$this->assertEquals($att,$res,"");
    	
    	$behaviour = new Behaviour('q','s-decap','it');
    	$res = $behaviour->applyOnStem('namaaq');
    	$att = 'namaat';
    	$this->assertEquals($att,$res,"");
    	
    	$context = 'V';
		$form = 'k';
		$actions = 'n-n-allV'; // pas d'action1 ; pas d'action2 si radical en 2 voyelles ; allV si radical en 1 voyelle
		$behaviour = new Behaviour($context,$actions,$form);
		$res = $behaviour->applyOnStem('ataata');
		$att = 'ataataak';
		$this->assertEquals($att,$res,"");
		$res = $behaviour->applyOnStem('atau');
		$att = 'atauk';
		$this->assertEquals($att,$res,"");
    	
    	$context = 'q';
		$form = 'k';
		$actions = 's-n-allV'; // pas d'action1 ; pas d'action2 si radical en 2 voyelles ; allV si radical en 1 voyelle
		$behaviour = new Behaviour($context,$actions,$form);
		$res = $behaviour->applyOnStem('namaaq');
		$att = 'namaak';
		$this->assertEquals($att,$res,"");
		$res = $behaviour->applyOnStem('namaq');
		$att = 'namaak';
		$this->assertEquals($att,$res,"");
    }
    
    public function test_makeBehaviours() {
    	// usiq;1;sv;vn;t;;;;;usiq usiq;n i(jj);i(jj) -;n-i(jj) i(jj);;s si(jj);i(jj) -;;s si(jj);i(jj) -;* * qusiq;s son n;i(jj) - -;custom;;;;;;;;
    	$forms = 'usiq usiq';
    	$actions = 'n-i(jj) i(jj)';
    	$context = 'V';
    	$behaviours = Behaviour::makeBehaviours($context,$actions,$forms);
    	$att = 2;
    	$this->assertEquals($att,count($behaviours),"");
    	$comp1 = $behaviours[0];
    	$comp2 = $behaviours[1];
    	$this->assertEquals(Action::NEUTRAL,$comp1->actionOnStem()->type(),"");
    	$this->assertEquals(Action::INSERTION,$comp1->actionVV()->type(),"");
    	$this->assertEquals(Action::INSERTION,$comp2->actionOnStem()->type(),"");
    	$this->assertEquals(null,$comp2->actionVV(),"");
    }
    
    public function test_makeBehaviours_cas2() {
    	// morpheme;type;case;number;perPoss;numbPoss;V-form;V-action1;V-action2;t-form;t-action1;t-action2;k-form;k-action1;k-action2;q-form;q-action1;q-action2;condPrec;sources
		// k;tn;nom;d;;;;allV;x;;iallV(i);;;sallV;x;;sallV;x;;H2
		$context = 'V';
		$forms = 'k';
		$actions = 'n-n-allV'; // pas d'action1 ; pas d'action2 si radical en 2 voyelles ; allV si radical en 1 voyelle
		$behaviours = Behaviour::makeBehaviours($context,$actions,$forms);
    	$att = 1;
    	$this->assertEquals($att,count($behaviours),"");
    	$comp1 = $behaviours[0];
    	$this->assertEquals(Action::NEUTRAL,$comp1->actionOnStem()->type(),"");
    	$this->assertEquals(Action::NEUTRAL,$comp1->actionVV()->type(),"");
    	$this->assertEquals(Action::VOWELLENGTHENING,$comp1->actionNotVV()->type(),"");
		
		
//		$context = 't';
//		$forms = 'k';
//		$actions = 'i(i)-n-allV'; // insérer 'i' ; pas d'action2 si radical en 2 voyelles ; allV si radical en 1 voyelle
//		
//		$context = 'k';
//		$forms = 'k';
//		$actions = 's-n-allV'; // supprimer le 'k' ; par d'action2 si radical en 2 voyelles ; allV si radical en 1 voyelle 
    }
}
?>