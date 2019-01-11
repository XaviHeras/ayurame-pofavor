<?php
/**
 * Created by PhpStorm.
 * User: xavi
 * Date: 3/01/19
 * Time: 12:10
 */

class Note
{
    /** @var integer */
    private $id;
    /** @var integer */
    private $starred;
    /** @var string */
    private $title;
    /** @var string */
    private $message;
    /** @var DateTime */
    private $tms;
    /** @var array */
    private $tags;

    /**
     * Note constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->id = isset($params['id']) ? $params['id'] : null;
        $this->starred = isset($params['starred']) ? $params['starred'] : null;
        $this->title = isset($params['title']) ? $params['title'] : null;
        $this->message = isset($params['message']) ? $params['message'] : null;
        $this->tags = isset($params['tags']) ? json_decode($params['tags'], true) : array();
        $this->tms = isset($params['tms']) ? $params['tms'] : null;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getStarred()
    {
        return $this->starred;
    }

    /**
     * @param int $starred
     */
    public function setStarred($starred)
    {
        $this->starred = $starred;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function printTags()
    {
        if (isset($this->tags['tags'])) {
            return implode(',', $this->tags['tags']);
        }
        return '';
    }

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return DateTime
     */
    public function getTms()
    {
        return $this->tms;
    }

    /**
     * @param DateTime $tms
     */
    public function setTms($tms)
    {
        $this->tms = $tms;
    }

}