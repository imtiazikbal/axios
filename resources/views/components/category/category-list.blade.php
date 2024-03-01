<div class="container mt-4">
    <div class="row justify-content-between">
        <div class="align-customers-center col">
            <h5 class="fw-bold">Category Table</h5>
        </div>
        <div class="align-customers-center col">
            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn  px-4 btn-success">Create
                New</button>
        </div>
    </div>
</div>
<hr />

<div class="container">
    <div class="row">



    </div>
</div>
<hr />

<div class="container">

    <div class="row">
        <div class="col-md-12 p-2 col-sm-12 col-lg-12">
            <div class="shadow-sm bg-white rounded-3 p-2">
                <table class="table" id="myTable">
                    <thead>
                        <tr class="bg-light">
                            <th>Name</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>


        <div class="col-md-2 p-2">
            <div class="">
                <button onclick="handlePrevious()" id="previousButton" class="btn btn-sm btn-success">Previous</button>
                <button onclick="handleNext()" id="nextButton" class="btn btn-sm mx-1 btn-success">Next</button>
            </div>
        </div>

    </div>
</div>

<script>
    getList()
    async function getList() {

        try {
            showLoader();
            const response = await axios.get('/categories');
            updateTable(response)
        } catch (error) {
            console.error('Error fetching customer data:', error);
        } finally {
            hideLoader();
        }

    }

    // Function to update the table with customer data
    function updateTable(data) {
        const tableList = document.getElementById("tableList");

        // Check if there are no customers to display
        if (!data.data.length) {
            tableList.innerHTML = '<tr><td colspan="4" class="text-center">No customers found.</td></tr>';
            return;
        }

        // Build the rows HTML string
        const rowsHtml = data.data.map(category => {
            return `<tr>
                    <td>${category.name}</td>
                    <td>
                        <button data-id="${category.id}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${category.id}" id="deleteID" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>`;
        }).join('');

        // Update the table with the new rows
        tableList.innerHTML = rowsHtml;


    }


    // Function to delete a customer
    async function deletecustomer(id) {


        try {
            showLoader()
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    axios.delete(`category/delete/${id}`).then(function(r) {
                        getList();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        )
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                    )
                }
            })

        } catch (error) {
            console.error('Error deleting customer:', error)
        } finally {
            hideLoader();
        }

    }


    // Attach event listeners to dynamically created buttons
    document.getElementById('tableList').addEventListener('click', function(event) {
        const target = event.target

        if (target.classList.contains('deleteBtn')) {
            const customerId = target.getAttribute('data-id')
            deletecustomer(customerId)
        }

        if (target.classList.contains('editBtn')) {
            const customerId = target.getAttribute('data-id')
            fillUpUpdateForm(customerId)
        }
    })

    // Initial list fetch
    getList()
</script>
