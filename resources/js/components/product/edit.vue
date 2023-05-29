<template>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Create Product</h5>
        </div>
        <div class="card-body">
            <form class="row">
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">

                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="slug">Slug<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">Description<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" placeholder="Description" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success">Store</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>

</script>
<style scoped>

</style>
