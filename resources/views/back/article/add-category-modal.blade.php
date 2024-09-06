<!-- Modal -->
<div class="modal fade" id="add-category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Categoy</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name')
                            is-invalid
                        @enderror" value="{{ old('name')}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Close</button>
                <button type="button" onclick="addCategory()" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    function addCategory() {
        // alert("helloo")
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "http://127.0.0.1:8000/api/categories",
            dataType: "json",
            data: {
                'name': $("#name").val()
            },
            success: function(response) {
                // Misalkan modal kamu memiliki id "myModal"
                $("#name").val('')
                $("#close").click()

                $.notify({
                    message: response.message,
                    icon: "fa fa-bell"

                }, {
                    type: response.status,
                    placement: {
                        from: "top",
                        align: "center",
                    },
                    // time: 1000,
                    // showProgressbar: true,
                    progress: 10,
                    // delay: 0,
                });
            },
            error: function(xhr, ajaxOptions, throwError) {
                alert(xhr.status + "\n" + xhr.response + "\n" + throwError)
            }

        });

    }
    $(document).ready(function() {})
</script>