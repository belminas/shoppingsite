document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            showAlert('Product added to cart successfully!');
        });
    });
});

function showAlert(message, duration = 3000) {
    const alertBox = document.createElement('div');
    alertBox.textContent = message;
    alertBox.style.position = 'fixed';
    alertBox.style.left = '50%';
    alertBox.style.top = '20px';
    alertBox.style.transform = 'translateX(-50%)';
    alertBox.style.backgroundColor = 'green';
    alertBox.style.color = 'white';
    alertBox.style.padding = '10px';
    alertBox.style.borderRadius = '5px';
    alertBox.style.zIndex = '1000';
    document.body.appendChild(alertBox);

    setTimeout(() => {
        document.body.removeChild(alertBox);
    }, duration);
}

document.addEventListener('DOMContentLoaded', function () {
    const addToCartForm = document.getElementById('add-to-cart-form');
    const addToCartButton = addToCartForm.querySelector('.add-to-cart-btn');

    addToCartButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        const formData = new FormData(addToCartForm);
        const actionURL = addToCartForm.getAttribute('action');
        
        fetch(actionURL, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest', 
            },
            credentials: 'same-origin' 
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); 
            if(data.success) {
                alert('Product added to cart successfully');
            } else {
                alert('Failed to add the product to the cart');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});