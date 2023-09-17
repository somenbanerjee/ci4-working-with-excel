<?= $this->extend('layouts/master'); ?>

<?= $this->section('main-content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="download/excel" class="btn btn-sm btn-outline-secondary">
                <span data-feather="download"></span>
                Download as Excel
            </a>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Designation</th>
                <th scope="col">Experience</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($employees) > 0) {
                $slNo = 1;
                foreach ($employees as $employee) {
            ?>
                    <tr>
                        <th scope="row"><?= $slNo; ?></th>
                        <td><?= $employee['name'] ?></td>
                        <td><?= $employee['email'] ?></td>
                        <td><?= $employee['designation'] ?></td>
                        <td><?= $employee['experience'] ?></td>
                    </tr>
                <?php
                    $slNo++;
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" class="text-center">No data found</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</main>

<?= $this->endSection(); ?>