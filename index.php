<?php
include_once "./inc/header.php";
session_start();
?>


<main>
    <section">
        <div class="container">
            <div class="col-lg-5 mx-auto">
                <div class="card">
                    <div class="card-header">
                        Add Todo
                    </div>
                    <div class="card-body">
                        <form action="./controller/StoreData.php" method="POST">
                            <input value="<?= $_SESSION['old_data']['title'] ?? null ?>" name="title" type="text" class="form-control <?= isset($_SESSION['form_errors']['title_error']) ? 'is-invalid' : null ?>" placeholder="Enter Todo">
                            <span class="text-danger"><?= $_SESSION['form_errors']['title_error'] ?? null ?></span>

                            <textarea name="detail" class="form-control mt-3 <?= isset($_SESSION['form_errors']['detail_error']) ? 'is-invalid' : null ?>" id="" placeholder="Add Details"><?= $_SESSION['old_data']['detail'] ?? null ?></textarea>
                            <span class="text-danger"><?= $_SESSION['form_errors']['detail_error'] ?? null ?></span>

                            <input name="date" type="date" class="form-control mt-3 <?= isset($_SESSION['form_errors']['date_error']) ? 'is-invalid' : null ?>">
                            <span class="text-danger"><?= $_SESSION['form_errors']['date_error'] ?? null ?></span>
                            <button type="submit" class="btn w-100 d-block btn-dark mt-3">Add Todo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
</main>

<?php
include_once "./inc/footer.php";
session_unset();
?>