<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Media;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Medias extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 70;
    }

    public function load(ObjectManager $manager)
    {
        $mediaTypes = $manager->getRepository('AppBundle:MediaType')->findAll();
        $genders    = $manager->getRepository('AppBundle:Gender')->findAll();
        $mediaType  = $mediaTypes[array_rand($mediaTypes)];
        $gender     = $genders[array_rand($mediaTypes)];

        $JohnRambo = new Media();
        $JohnRambo->setMediaType($mediaType);
        $JohnRambo->setGender($gender);
        $JohnRambo->setTitle('John Rambo Vuelta al infierno');
        $JohnRambo->setYear(2008);
        $JohnRambo->setPlot(
                'El ex boina verde John Rambo (Stallone) lleva una solitaria
                y apacible vida en la jungla del norte de Tailandia, pescando y cazando cobras para venderlas.
                Todo cambia cuando un grupo de misioneros católicos le proponen que les sirva de guía hasta
                la frontera con Birmania para suministrar medicinas y alimentos a los refugiados asediados por
                el ejército birmano, que ha hecho de la tortura y el asesinato una práctica habitual.
                En estas circunstancias, Rambo no tendrá más remedio que volver a tomar partido.'
        );
        $JohnRambo->setImg('kveo-RamboVueltaAlInfierno.jpg');
        $JohnRambo->setTrailer('https://www.youtube.com/watch?v=9h-JRKMSOOA');
        $manager->persist($JohnRambo);


        $theWalkingDead = new Media();
        $theWalkingDead->setMediaType($mediaType);
        $theWalkingDead->setGender($gender);
        $theWalkingDead->setTitle('The Walking Dead');
        $theWalkingDead->setYear(2010);
        $theWalkingDead->setSeason(6);
        $theWalkingDead->setPlot(
            'The Walking Dead" está ambientada en un futuro apocalíptico con la Tierra devastada por el
            efecto de un cataclismo, que ha provocado la mutación en zombies de la mayor parte de los habitantes
            del planeta. La trama sigue a un grupo de humanos supervivientes, comandados por el policía
            Rick Grimes encargado de buscar un lugar seguro en el que poder vivir. La serie, explora las
            dificultades de los protagonistas para sobrevivir en un mundo poblado por el horror, así como
            las relaciones personales que se establecen entre ellos, en ocasiones también una amenaza
            para su supervivencia.'
        );
        $theWalkingDead->setImg('kveo-walkingDead.jpg');
        $theWalkingDead->setTrailer('https://www.youtube.com/watch?v=R1v0uFms68U');
        $manager->persist($theWalkingDead);


        $fringe = new Media();
        $fringe->setMediaType($mediaType);
        $fringe->setGender($gender);
        $fringe->setTitle('Fringe (Al límite)');
        $fringe->setYear(2008);
        $fringe->setSeason(5);
        $fringe->setPlot(
            'Cuando el vuelo 627 aterriza con todo el pasaje y la tripulación muerta, la Agente del
            FBI Olivia Dunham es llamada para inverstigar los hechos. Todos los muertos parecen haberse
            "derretido" fruto de un agente contagioso por el aire. Todo apunta a un acto terrorista, pero
            poco a poco se darán cuenta de que hay cosas que están por encima del terrorismo e incluso por encima
            de la propia imaginación. ¿Que pasaría si la ciencia llegara a evolucionar hasta tal punto que no
            pudieramos controlarla?'
        );
        $fringe->setImg('kveo-fringe.jpg');
        $fringe->setTrailer('https://www.youtube.com/watch?v=29bSzbqZ3xE');
        $manager->persist($fringe);


        $apellidosVascos = new Media();
        $apellidosVascos->setMediaType($mediaType);
        $apellidosVascos->setGender($gender);
        $apellidosVascos->setTitle('8 Apellidos Vascos');
        $apellidosVascos->setYear(2014);
        $apellidosVascos->setPlot(
            'Rafa (Dani Rovira) es un joven señorito andaluz que no ha tenido que salir jamás de su Sevilla natal
            para conseguir lo único que le importa en la vida: el fino, la gomina y las mujeres. Hasta que un día
            todo cambia cuando aparece la primera mujer que se resiste a sus encantos: Amaia (Clara Lago), una vasca.
            Decidido a conquistarla, Rafa viaja hasta un pueblo de la Euskadi profunda, donde para que Amaia le
            haga algo de caso deberá hacerse pasar por vasco. Rafa pasará entonces a llamarse Antxon,
            nombre euskera al que decide además acompañar de unos cuantos apellidos vascos: Arguiñano, Igartiburu,
            Erentxun, Gabilondo, Urdangarin, Otegi, Zubizarreta y… Clemente.'
        );
        $apellidosVascos->setImg('kveo-apellidosVascos.jpg');
        $apellidosVascos->setTrailer('https://www.youtube.com/watch?v=YfopzNHLp4o');
        $manager->persist($apellidosVascos);

        $manager->flush();
    }
}