<div class="modal fade" id="create-modal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Customer</h6>
            </div>
            <div class="modal-body">
                <form id="customer-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control mb-2" id="category-name">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="saveCategory()" id="save-btn" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function saveCategory() {
        const name = document.getElementById("category-name").value
        if (name === "") {
            alert("Please enter category name");
            return;
        }
        try {
            showLoader();
            closeModal('create-modal');
            const response = await axios.post('category', {
                name: name
            });
            getList()
            console.log(response);
            if (response.status === 200) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
                (async () => {
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message
                    })
                })()
            } else {
                alert("Request failed!");
            }
        } catch (error) {
            console.error('Error creating customer:', error);
            alert("An error occurred while saving the customer.");
        } finally {
            hideLoader();
        }
    }
</script>
