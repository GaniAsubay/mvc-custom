<?php
$sortType = ((!empty($_GET['sortType'])) && $_GET['sortType'] == 'desc') ? 'asc' : 'desc';
?>
<a href="/task/create" class="btn btn-primary">Create new Task</a>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col"><a href="<?= updateQueryBySorting(['sort' => 'name', 'sortType' => $sortType])?>">Name</a></th>
        <th scope="col">Description</th>
        <th scope="col"><a href="<?= updateQueryBySorting(['sort' => 'email', 'sortType' => $sortType])?>">Email</a></th>
        <th scope="col"><a href="<?= updateQueryBySorting(['sort' => 'status', 'sortType' => $sortType])?>">Status</a></th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($models as $task): ?>
        <tr>
            <td><?= $task->id ?></td>
            <td><?= $task->name ?></td>
            <td><?= mb_strimwidth($task->description, 0, 30, "...") ?></td>
            <td><?= $task->email ?></td>
            <td><?= $task->getStatusText()  ?></td>
            <td>
                <?php if (!$isGuest): ?>
                    <a href="/task/edit?id=<?= $task->id ?>" class="btn btn-primary">Edit</a>
                    <a href="/task/approved?id=<?= $task->id ?>" class="btn btn-success">Approved</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php for ($i = 1; $i < $paginationPageCount; $i++): ?>
            <li class="page-item"><a class="page-link" href="<?= updateQueryBySorting(['page' => $i]) ?>"><?= $i ?></a></li>
        <?php endfor; ?>
    </ul>
</nav>
