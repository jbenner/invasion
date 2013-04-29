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
        $gameId = $this->get('request')->request->get('gameId');

        $game = $this->getDoctrine()
                ->getRepository("PensiveInvasionBundle:Game")
                ->findOneById($gameId);

        $networks = $this->getDoctrine()
                ->getRepository("PensiveInvasionBundle:Network")
                ->findAll();

        $em = $this->getDoctrine()->getEntityManager();

        $game->incrementTurncount();

        $em->persist($game);
        $em->flush();

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

    public function turnAction()
    {
        $gameId = $this->get('request')->request->get('gameId');

        $game = $this->getDoctrine()
                ->getRepository("PensiveInvasionBundle:Game")
                ->findOneById($gameId);

        $players = $game->getPlayers();

        $playerObject = [];

        for ($i = 0; $i < count($players); $i++) {
            $player = [
                'id' => $players[$i]->getId(),
                'name' => $players[$i]->getName(),
                'networks' => $players[$i]->getNetworks(),
                'servers' => $players[$i]->getServers(),
                'nodes' => $players[$i]->getNodes(),
            ];

            array_push($playerObject, $player);
        }

        $playerObject = json_encode($playerObject);

        $r = new Response();
        $r->setContent($playerObject);
        return $r;
    }
}
