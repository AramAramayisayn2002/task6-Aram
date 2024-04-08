<div class="pt-3">
    <div class="container mt-5" style="width : 30%;">
        <div class="p-1">
            <h1 class="mb-1">Add new product</h1>
            <form action="<?= DOM ?>admin/Dashboard/addProduct" method="post" enctype="multipart/form-data"
                  class="form-horizontal">
                <div>
                    <label class="form-label">Category</label>
                    <select type="text" name="category" class="form-select" required>
                        <option selected disabled></option>
                        <option>Smartphones</option>
                        <option>Notebooks</option>
                        <option>Tablets</option>
                        <option>Televisions</option>
                        <option>Gaming Consoles</option>
                        <option>Digital Cameras</option>
                        <option>Drones</option>
                        <option>Cleaning Appliances</option>
                        <option>Climate Control Devices</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Brand</label>
                    <select type="text" name="brand" class="form-select" required>
                        <option selected disabled></option>
                        <option>Apple</option>
                        <option>Samsung</option>
                        <option>Sony</option>
                        <option>LG</option>
                        <option>Microsoft</option>
                        <option>Google</option>
                        <option>Dell</option>
                        <option>HP</option>
                        <option>Canon</option>
                        <option>Panasonic</option>
                    </select>
                </div>
                <div>
                    <label for="fullName" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name">
                </div>
                <div>
                    <label for="email" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Enter description">
                </div>
                <div>
                    <label class="form-label">price</label>
                    <input type="number" name="price" class="form-control" placeholder="Enter price">
                </div>
                <div>
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" id="appointmentDate">
                </div>
                <div>
                    <label for="message" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" placeholder="image">
                </div>
                <div class="text-center flex mt-1">
                    <a href="<?= DOM ?>admin/Dashboard/product" class="btn btn-dark me-5">Back</a>
                    <button name="addProduct" class="btn btn-primary ms-5">Enter</button>
                </div>
            </form>
        </div>
    </div>
</div>