<?php
include '../controllers/NotesController.php';
include '../models/Note.php';

$notesController = new NotesController();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST)) {
    if (isset($_POST['edit'])) {
        $_POST['tags'] = json_encode(array('tags' => explode(',', trim($_POST['tags']))));
        $note = new Note($_POST);
        $notesController->updateNote($note);
        header('Location: ' . '/page/note.php?id=' . $_GET['id'] . '&m=view');
        die();
    } elseif (isset($_POST['create'])) {
        $_POST['tags'] = json_encode(array('tags' => explode(',', trim($_POST['tags']))));
        $note = new Note($_POST);
        $notesController->createNote($note);
        header('Location: ' . '/page/notes.php');
        die();
    }
}

$state = '';
switch ($_GET['m']) {
    case 'view':
        $note = new Note($notesController->getNote($_GET['id']));
        $state = 'view';
        break;
    case 'edit':
        $note = new Note($notesController->getNote($_GET['id']));
        $state = 'edit';
        break;
    case 'delete':
        $notesController->deleteNote($_GET['id']);
        header('Location: ' . '/page/notes.php');
        break;
    case 'create':
        $state = 'create';
        break;
}

?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ayurame pofavor</title>
    <style type="text/css" href="../css/bootstrap.css"></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=itf24gv2xqokshsi48ieqnufzgx7wjj4x1n177v2t2elwyh4"></script>
    <script>
        tinymce.init({
            selector: '#message',
            plugins: "codesample, table, autolink, contextmenu, hr, lists, print, textcolor, paste",
            menubar: '',
            toolbar: 'formatselect paste | undo redo | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist | numlist bullist | bold italic forecolor backcolor | hr | table | codesample | print',
            codesample_content_css: "http://ayurame.pofavor/css/prism.css",
            codesample_languages: [
                {text: 'HTML/XML', value: 'markup'},
                {text: "XML", value: "xml"},
                {text: "HTML", value: "html"},
                {text: "SVG", value: "svg"},
                {text: "CSS", value: "css"},
                {text: "Clike", value: "clike"},
                {text: "Javascript", value: "javascript"},
                {text: "apacheconf", value: "apacheconf"},
                {text: "bash", value: "bash"},
                {text: "C++", value: "cpp"},
                {text: "ruby", value: "ruby"},
                {text: "diff", value: "diff"},
                {text: "docker", value: "docker"},
                {text: "http", value: "http"},
                {text: "ini", value: "ini"},
                {text: "java", value: "java"},
                {text: "JSON", value: "json"},
                {text: "latex", value: "latex"},
                {text: "less", value: "less"},
                {text: "markdown", value: "markdown"},
                {text: "nginx", value: "nginx"},
                {text: "PHP", value: "php"},
                {text: "python", value: "python"},
                {text: "sass", value: "sass"},
                {text: "scss", value: "scss"},
                {text: "smarty", value: "smarty"},
                {text: "SQL", value: "sql"},
                {text: "twig", value: "twig"},
                {text: "TypeScript", value: "typescript"},
                {text: "YAML", value: "yaml"}
            ],
            paste_data_images: true,
            paste_filter_drop: true,
            <?= ($state === 'view') ? 'readonly: 1' : ''?>
        });
    </script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <div class="row" style="padding: 40px 0">
        <a href="notes.php" class="btn btn-block btn-lg btn-primary">back</a>
    </div>

    <div class="row">
        <form method="post" action="">
            <input type="hidden" value="<?= ($state !== 'create') ? $note->getId() : '' ?>" id="id" name="id">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="<?= ($state !== 'create') ? $note->getTitle() : '' ?>" <?= ($state === 'view') ? 'readonly' : '' ?>>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" id="tags" name="tags" class="form-control" value="<?= ($state !== 'create') ? $note->printTags() : '' ?>" <?= ($state === 'view') ? 'readonly' : '' ?>>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message"
                          class="form-control" <?= ($state === 'view') ? 'readonly' : '' ?> rows="20"><?= ($state !== 'create') ? trim($note->getMessage()) : '' ?></textarea>
            </div>

            <?php if ($state !== 'view'): ?>
                <div class="form-group">
                    <input type="submit" name="<?= $state ?>" class="btn btn-block btn-success btn-lg" id="<?= $state ?>" value="<?= $state ?>">
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
</body>
</html>
