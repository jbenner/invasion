<?php

namespace Pensive\InvasionBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PensiveInvasionBundle:Default:index.html.twig');
    }

    public function gameAction($gameId)
    {
        $game = $this->getDoctrine()
                ->getRepository("PensiveInvasionBundle:Game")
                ->findOneById($gameId);

        return $this->render('PensiveInvasionBundle:Default:game.html.twig',
            [
                'game' => $game,
            ]);
    }

    public function setupAction()
    {
        $gameId = 1;

        $game = $this->getDoctrine()
                ->getRepository("PensiveInvasionBundle:Game")
                ->findOneById($gameId);

        $networks = $this->getDoctrine()
                ->getRepository("PensiveInvasionBundle:Network")
                ->findAll();

        // $em = $this->getDoctrine()->getEntityManager();

        // $game->incrementTurncount();

        // $em->persist($game);
        // $em->flush();

        $networkObject = [];

        for ($i = 0; $i < count($networks); $i++) {
            $network = [
                'id' => $networks[$i]->getId(),
                'name' => $networks[$i]->getName(),
                'size' => $networks[$i]->getSize(),
                'location' => $networks[$i]->getLocation(),
                'value' => $networks[$i]->getValue()
            ];

            array_push($networkObject, $network);
        }

        $networkObject = json_encode($networkObject);

        $r = new Response();
        $r->setContent($networkObject);
        return $r;
    }
}
