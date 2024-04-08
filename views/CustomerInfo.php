<div class="pt-3">
    <div class="container mt-5" style="width : 30%;">
        <div class="p-1">
            <h1 class="mb-1">Add new product</h1>
            <form action="<?= DOM ?>index/buy" method="post" class="form-horizontal">
                <div>
                    <label for="fullName" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name">
                </div>
                <div>
                    <label class="form-label">Date</label>
                    <input type="tel" name="phone" class="form-control" placeholder="Enter number phone">
                </div>
                <div>
                    <label for="email" class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" placeholder="Enter location">
                </div>
                <div class="text-center flex mt-1">
                    <a href="<?= DOM ?>index/card" class="btn btn-dark me-5">Back</a>
                    <button name="buy" class="btn btn-primary ms-5">Enter</button>
                </div>
            </form>
        </div>
    </div>
</div>