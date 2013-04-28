<?php

namespace Pensive\InvasionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Game
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="game")
     */
    private $players;

    /**
     * @var integer
     *
     * @ORM\Column(name="turn", type="integer")
     */
    private $turn;

    /**
     * @var integer
     *
     * @ORM\Column(name="turncount", type="integer")
     */
    private $turncount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime")
     */
    private $startTime;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getPlayers()
    {
        $playerIndex = [];

        foreach ($this->players as $player) {
            array_push($playerIndex, $player);
        }

        return $playerIndex;
    }

    /**
     * Set turn
     *
     * @param integer $turn
     * @return Game
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;

        return $this;
    }

    /**
     * Get turn
     *
     * @return integer
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Set turncount
     *
     * @param integer $turncount
     * @return Game
     */
    public function setTurncount($turncount)
    {
        $this->turncount = $turncount;

        return $this;
    }

    /**
     * Get turncount
     *
     * @return integer
     */
    public function getTurncount()
    {
        return $this->turncount;
    }

    public function incrementTurncount()
    {
        ++$this->turncount;

        return $this;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Game
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }
}
