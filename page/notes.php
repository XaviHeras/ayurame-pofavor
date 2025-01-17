<?php
include '../controllers/NotesController.php';
$notesController = new NotesController();

$notes = $notesController->getNotes();

if (isset($_GET['id'], $_GET['to'])) {
    $notesController->highlightNote($_GET['id'], $_GET['to']);
    header('Location: ' . '/page/notes.php');
}

?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ayurame pofavor</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style>
        .no-color {
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row" style="padding: 40px 0">
        <a href="note.php?m=create" class="btn btn-block btn-lg btn-success">create</a>
    </div>
    <div class="row">
        <table class="table table-hover table-striped" id="notes">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Title</th>
                <th class="hidden">Tags</th>
                <th>Message</th>
                <th>Date</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($notes as $note): ?>
                <tr>
                    <td>
                        <a href="?id=<?= $note['id'] ?>&to=<?= ($note['starred'] === '0') ? '1' : '0' ?>" class="no-color">
                            <span class="glyphicon glyphicon-star<?= ($note['starred'] === '0') ? '-empty' : '' ?>"></span>
                        </a>
                    </td>
                    <td>
                        <a href="note.php?id=<?= $note['id'] ?>&m=view" class="no-color">
                            <?= $note['title'] ?>
                        </a>
                    </td>
                    <td class="hidden">
                        <a href="note.php?id=<?= $note['id'] ?>&m=view" class="no-color">
                            <?= implode(',', json_decode($note['tags'], true)['tags']) ?>
                        </a>
                    </td>
                    <td>
                        <a href="note.php?id=<?= $note['id'] ?>&m=view" class="no-color">
                            <?= substr($note['message'], 0, 200) ?>
                        </a>
                    </td>
                    <td>
                        <?= date('d-m-Y H:i', strtotime($note['tms'])) ?>
                    </td>
                    <td>
                        <ul style="list-style: none">
                            <li>
                                <a href="note.php?id=<?= $note['id'] ?>&m=edit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                            </li>
                            <li>
                                <a href="note.php?id=<?= $note['id'] ?>&m=delete">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#notes').DataTable({
            "ordering": false,
	    "stateSave": true,
            "info": false,
            "scrollCollapse": true,
            "paging": false,
            "scrollY": '75vh',
            "columnDefs": [
                {
                    "targets": [2],
                    "visible": false,
                    "searchable": true
                }
            ],
        });
    });
</script>
</body>
</html>
