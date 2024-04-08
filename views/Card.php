<div class="content-header">
    <div class="container mt-5" style="width: 70%">
        <div>
            <h1 class="text-center">CARD</h1>
        </div>
        <div class="mb-3">
            <a href="<?= DOM ?>index" class="btn logButton">Add Product</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
            <tr>
                <th>Category</th>
                <th>Brand</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>final price</th>
                <th>Quantity</th>
                <th>Settings</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $key => $value) {
                ?>
                <tr>
                    <td>
                        <span><?= mb_substr($value['name_category'], 0, 15) ?></span>
                    </td>
                    <td>
                        <span><?= mb_substr($value['name_brand'], 0, 15) ?></span>
                    </td>
                    <td>
                        <span><?= mb_substr($value['name'], 0, 80) ?></span>
                    </td>
                    <td>
                        <span><?= mb_substr($value['description'], 0, 18) . '...' ?></span>
                    </td>
                    <td style="width: 150px ;">
                        <img src="<?= "'../../../public/uploads/products/" . $value['name_category'] . "/" . $value['image'] ?>"
                             class="tableImgProduct">
                    </td>
                    <td>
                        <span><?= $value['price'] ?> AMD</span>
                    </td>
                    <td>
                        <span class="finalPrice"><?= $_SESSION['card'][$key]['quantity'] * $value['price'] ?> AMD</span>
                    </td>
                    <td>
                        <div class="quantity">
                            <button class="btn btn-secondary" onclick="decrease_btn(this)">-</button>
                            <input type="text" class=" mx-2 text-center" id="quantity-input"
                                   value="<?= $_SESSION['card'][$key]['quantity'] ?>" data-id="<?= $key ?>">
                            <button class="btn btn-secondary" onclick="increase_btn(this)">+</button>
                        </div>
                    </td>
                    <td style="width: 40px;">
                        <div class="">
                            <a href="<?= DOM . 'index/deleteInCard?id=' . $value['id'] ?> "
                               class="btn btn-danger mb-3 ms-2">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php

            }
            ?>
            </tbody>
        </table>
        <div>
            <form action="<?= DOM ?>index/buyInCard" method="post" enctype="multipart/form-data"
                  class="form-horizontal flex justify-content-center">
                <button name="buyInCard" class="btn btn-success mb-3 ms-2" style="width: 10%"> BUY</button>
            </form>
        </div>
    </div>
    <?php
    ?>
</div>
