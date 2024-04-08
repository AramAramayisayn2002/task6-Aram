<div class="content-header mt-5">
    <div class="container p-5" style="width: 90%">
        <div></div>
        <?php
        foreach ($data as $key => $value) {
            ?>
            <div class="row mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="card-title mb-1"><?= ($data[$key]['name_category']) ?></h1>
                        <h3 class="card-text mb-1"><?= ($data[$key]['name_brand']) ?></h3>
                        <p class="card-text mb-1"><?= ($data[$key]['price']) ?> AMD</p>
                        <p class="card-text "><?= ($data[$key]['description']) ?></p>
                        <p class="card-text"
                           style="color: red"><?= ($data[$key]['quantity'] == 0) ? 'Not available' : null; ?></p>
                    </div>
                    <div class="justify-content-center text-center">
                        <img src="'../../public/uploads/products/<?= $data[$key]['name_category'] . "/" . $data[$key]['image'] ?>"
                             id="deleteImgProduct">
                    </div>
                    <div class="justify-content-center text-center mt-2 mb-2">
                        <p class="btn btn-success" onclick="inCard(this)" data-id="<?= ($data[$key]['id']) ?>">IN
                            CARD</p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="row">
            <div class="card">
                <div class="card-body flex justify-content-around">
                    <a href="<?= DOM ?>?page=<?= ($_SESSION['thisPage'] > 1) ? $_SESSION['thisPage'] - 1 : $_SESSION['thisPage']; ?>"
                       class="btn btn-dark">Previous</a>
                    <a href="<?= DOM ?>?page=<?= ($_SESSION['thisPage'] < $_SESSION['limitPage']) ? $_SESSION['thisPage'] + 1 : $_SESSION['thisPage']; ?>"
                       class="btn btn-success">Next</a>
                </div>
            </div>
        </div>
    </div>
</div>