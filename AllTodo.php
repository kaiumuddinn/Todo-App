<?php
session_start();
include_once "./inc/header.php";

include "./database/env.php";
$query = "SELECT * FROM todos ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$todos = mysqli_fetch_all($result, 1);

?>

<style>
    .todo {
        height: 400px;
        overflow: auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;

        &:hover .overlay {
            display: block;
            opacity: 1;
            transform: translateY(0px);
            margin-bottom: 5px;
        }
    }

    .overlay {
        opacity: 1;
        transform: translateY(-60px);
        margin-bottom: -45px;
        transition: 0.3s;
    }

    .overlay a {
        color: white;
        font-size: 20px;
        background-color: #ccc;
        padding: 5px 20px;
        display: block;
        border-radius: 5px;
    }

    .addTodo {
        background-color: #ececec;
        height: 400px;
        border-radius: 10px;
    }

    .addTodo a {
        text-decoration: none;
        font-size: 100px;
        color: #000;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .deleteAll a {
        text-decoration: none;
        font-size: 20px;
        padding: 10px 15px;
        display: inline-block;
        color: white;
        background-color: #e83714;
        border-radius: 5px;
    }
</style>

<main>
    <section">
        <div class="container pb-4">
            <div class="deleteAll my-2 text-end">
                <a href="./controller/DeleteTodo.php?deleteAll">Clear All</a>
            </div>
            <div class="row gy-4">

                <?php
                foreach ($todos as $index => $todo) {
                ?>

                    <div class="col-lg-4">
                        <div class="todo">
                            <div class="overlay">
                                <div class="icons d-flex justify-content-between gap-2">
                                    <a class="edit w-100 text-center bg-info" href="#"><i class="bi bi-pencil"></i></a>
                                    <a class="view w-100 text-center bg-black" href="#"><i class="bi bi-eye"></i></a>
                                    <a class="delete w-100 text-center bg-danger" href="./controller/DeleteTodo.php?id= <?= $todo['id'] ?> "><i class="bi bi-trash"></i></a>
                                </div>
                            </div>

                            <div class="row justify-content-between align-items-center">
                                <div class="col-8">
                                    <h4><?= ++$index ?>. <?= $todo['title'] ?></h4>
                                </div>
                                <div class="col-4 text-end">
                                    <span><strong><?= $todo['data'] ?></strong></span>
                                </div>
                            </div>
                            <p class="detail py-3"><?= $todo['details'] ?></p>
                        </div>
                    </div>

                <?php
                }
                ?>




                <div class="col-lg-4">
                    <div class="addTodo">
                        <a href="./index.php">+</a>
                    </div>
                </div>
            </div>
        </div>
        </section>
</main>

<?php
include_once "./inc/footer.php";
?>



<script>
    let colors = [
        "#FDF2B3", "#D1EAED", "#FFDADA", "#c1b2f2", "#DCEDC8", "#C8E6C9", "#B3E5FC", "#edbb9a"
    ];
    let boxes = document.querySelectorAll(".todo");

    boxes.forEach((box, index) => {
        box.style.backgroundColor = colors[index % colors.length];
    });
</script>

<?php
if (isset($_SESSION['success'])) { ?>
    <script>
        Toast.fire({
            icon: "success",
            title: `<?= $_SESSION['success'] ?>`
        });
    </script>
<?php
}
if (isset($_SESSION['deleted'])) {
?>

    <script>
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your task has been deleted.",
                    icon: "success"
                });
            }
        });
    </script>


<?php
}
session_unset();
?>