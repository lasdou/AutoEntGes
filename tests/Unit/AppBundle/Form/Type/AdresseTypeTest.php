<?php
// tests/AppBundle/Form/Type/TestedTypeTest.php
namespace Tests\Unit\AppBundle\Form\Type;

use AppBundle\Entity\Adresse;
use AppBundle\Entity\Civilite;
use AppBundle\Entity\Pays;
use AppBundle\Entity\Ville;
use AppBundle\Form\AdresseType;
use Symfony\Component\Form\Test\TypeTestCase;

class AdresseTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $paysFrance = new Pays();
        $paysFrance->setNom('titi');
        $villeTest = new Ville();
        $villeTest->setNom('titi');
        $villeTest->setCodePostal('12345');
        $villeTest->setPays($paysFrance);
        $civiliteTest = new Civilite();
        $civiliteTest->setNom('titi');

        $formData = array(
            'type' => Adresse::TYPE_PRINCIPALE,
            'civilite' => $civiliteTest,
            'nom' => 'toto',
            'prenom' => 'titi',
            'raison_sociale' => 'ma raison sociale',
            'adresse_ligne_1' => 'ligne 1',
            'adresse_ligne_2' => 'ligne 2',
            'ville' => $villeTest
        );

        $objectToCompare = new Adresse();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(AdresseType::class, $objectToCompare);

        $object = new Adresse();
        $object->setType($formData['type']);
        $object->setCivilite($formData['civilite']);
        $object->setNom($formData['nom']);
        $object->setPrenom($formData['prenom']);
        $object->setRaisonSociale($formData['raison_sociale']);
        $object->setAdresseLigne1($formData['adresse_ligne_1']);
        $object->setAdresseLigne2($formData['adresse_ligne_2']);
        $object->setVille($formData['ville']);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}