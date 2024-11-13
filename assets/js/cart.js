document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartItemsContainer = document.querySelector('.cart-items');
    const cartTotal = document.querySelector('.cart-total');

    // Agregar producto al carrito
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-product-id');
            fetch('/ProyectoF/public/api/cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=add&product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.status);
                updateCartView();
            });
        });
    });

    // Actualizar vista del carrito
    function updateCartView() {
        fetch('/ProyectoF/public/api/cart_view.php')
            .then(response => response.text())
            .then(html => {
                cartItemsContainer.innerHTML = html;
                updateCartTotal();
            });
    }

    // Actualizar total del carrito
    function updateCartTotal() {
        // Obtener el total y actualizar el DOM aquí
    }
});
