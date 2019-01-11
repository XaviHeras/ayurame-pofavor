<?php

class NotesController
{
    /** @var PDO */
    private $con;

    public function __construct()
    {
        $settings = array(
            'host' => 'localhost',
            'dbname' => 'squidtechs',
            'user' => 'xavi',
            'password' => 'xavi',
        );

        $this->con = new PDO('mysql:host=' . $settings['host'] . ';dbname=' . $settings['dbname'], $settings['user'], $settings['password'], array(PDO::ATTR_PERSISTENT => true));
    }

    public function getNotes()
    {
        return $this->con->query('SELECT * FROM note ORDER BY starred DESC');
    }

    public function getNote($id)
    {
        $getNote = $this->con->prepare('SELECT * FROM note WHERE id = :id');
        $getNote->execute(array(
            'id' => $id
        ));
        return $getNote->fetch();
    }

    public function deleteNote($id)
    {
        $getNote = $this->con->prepare('DELETE FROM note WHERE id = :id');
        $getNote->execute(array(
            'id' => $id
        ));
    }

    public function createNote(Note $note)
    {
        $createNote = $this->con->prepare('INSERT INTO note (title, message, tags) VALUES (:title, :message, :tags)');
        $createNote->execute(array(
            'title' => $note->getTitle(),
            'message' => $note->getMessage(),
            'tags' => json_encode($note->getTags())
        ));
    }

    public function updateNote(Note $note)
    {
        $updateNote = $this->con->prepare('UPDATE note SET title = :title, message = :message, tags = :tags WHERE id = :id');
        $updateNote->execute(array(
            'id' => $note->getId(),
            'title' => $note->getTitle(),
            'message' => $note->getMessage(),
            'tags' => json_encode($note->getTags())
        ));
    }

    public function highlightNote($id, $to)
    {
        $updateStar = $this->con->prepare('UPDATE note SET starred = :starred WHERE id = :id');
        $updateStar->execute(array(
            'starred' => $to,
            'id' => $id
        ));
    }

}