document.addEventListener('DOMContentLoaded', function () {
    var actionBtn = document.getElementById('action-btn');
    var productsBtn = document.getElementById('products-btn');
    var ordersBtn = document.getElementById('orders-btn');
    var usersBtn = document.getElementById('users-btn');
    var modal = document.getElementById('myModal');
    var closeBtn = document.getElementsByClassName('close')[0];
    var decreaseBtn = document.getElementById('decrease-btn');
    var increaseBtn = document.getElementById('increase-btn');
    var quantityInput = document.getElementById('quantity');
    var productModalContent = document.getElementById('product-modal-content');
    var orderModalContent = document.getElementById('order-modal-content');
    var userModalContent = document.getElementById('user-modal-content');

    productsBtn.addEventListener('click', function () {
        actionBtn.style.display = 'block';
        actionBtn.textContent = 'Add Product';
        productModalContent.style.display = 'block';
        orderModalContent.style.display = 'none';
        userModalContent.style.display = 'none';
    });

    ordersBtn.addEventListener('click', function () {
        actionBtn.style.display = 'block';
        actionBtn.textContent = 'Add Order';
        productModalContent.style.display = 'none';
        orderModalContent.style.display = 'block';
        userModalContent.style.display = 'none';
    });

    usersBtn.addEventListener('click', function () {
        actionBtn.style.display = 'block';
        actionBtn.textContent = 'Add User';
        productModalContent.style.display = 'none';
        orderModalContent.style.display = 'none';
        userModalContent.style.display = 'block';
    });

    actionBtn.addEventListener('click', function () {
        modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    decreaseBtn.addEventListener('click', function () {
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    increaseBtn.addEventListener('click', function () {
        var currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    });

    // Form validation
    document.querySelector("form").onsubmit = function (event) {
        let valid = true;
        let errorMessage = '';

        // Validate product id
        const pid = document.getElementById("pid").value;
        if (pid.trim() === '') {
            errorMessage += 'Product ID is required.\n';
            valid = false;
        }

        // Validate product name
        const pname = document.getElementById("pname").value;
        if (pname.trim() === '') {
            errorMessage += 'Product Name is required.\n';
            valid = false;
        }

        // Validate description
        const description = document.getElementById("description").value;
        if (description.trim() === '') {
            errorMessage += 'Description is required.\n';
            valid = false;
        }

        // Validate product color
        const pcolor = document.getElementById("pcolor").value;
        if (pcolor.trim() === '') {
            errorMessage += 'Product Color is required.\n';
            valid = false;
        }

        // Validate product size
        const psize = document.getElementById("psize").value;
        if (psize.trim() === '') {
            errorMessage += 'Product Size is required.\n';
            valid = false;
        }

        // Validate quantity
        const quantity = document.getElementById("quantity").value;
        if (!/^\d+$/.test(quantity) || parseInt(quantity) <= 0) {
            errorMessage += 'Quantity must be a positive number.\n';
            valid = false;
        }

        // Validate unit price
        const unitPrice = document.getElementById("unit_price").value;
        if (!/^\d+(\.\d{1,2})?$/.test(unitPrice) || parseFloat(unitPrice) <= 0) {
            errorMessage += 'Unit Price must be a positive number with up to 2 decimal places.\n';
            valid = false;
        }

        // Validate category
        const category = document.querySelector('input[name="category"]:checked');
        if (!category) {
            errorMessage += 'Category is required.\n';
            valid = false;
        }

        // Validate image upload
        const imageUpload = document.getElementById("image_upload").files;
        if (imageUpload.length === 0) {
            errorMessage += 'At least one image is required.\n';
            valid = false;
        }

        if (!valid) {
            alert(errorMessage);
            event.preventDefault(); // Prevent form submission if validation fails
        }

        return valid; // Allow form submission if valid
    };
});

function increaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
}

function decreaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}
