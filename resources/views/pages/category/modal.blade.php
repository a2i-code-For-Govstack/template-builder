<!-- Button trigger modal -->

<style>
    .modal {
        pointer-events: none;
    };

    .modal-dialog {
        pointer-events: all;
    };
    .modal { overflow-y: auto };
</style>
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" enctype="multipart/form" id="exampleModal">
        @csrf

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errmsg my-2">

                    </div>
                    <div class="form-group">

                        <label for="name">Category Name : </label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name"><br>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_category" data-bs-dismiss="modal">Save
                        Category</button>
                </div>
            </div>
        </div>

    </form>

</div>
