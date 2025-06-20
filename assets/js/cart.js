function addToCart(dishId, dishName, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    // Проверяем, есть ли уже блюдо в корзине
    let existing = cart.find(item => item.dishId === dishId);
    if (existing) {
        existing.quantity = (existing.quantity || 1) + 1;
    } else {
        cart.push({ dishId, dishName, price, quantity: 1 });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    alert(`Добавлено в корзину: ${dishName}`);
}

function showCart() {
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    let html = '';
    let total = 0;

    if (cartItems.length === 0) {
        html = '<p>Корзина пуста</p>';
    } else {
        cartItems.forEach(item => {
            let itemTotal = item.price * item.quantity;
            html += `<div>${item.dishName} x${item.quantity} - $${itemTotal.toFixed(2)}</div>`;
            total += itemTotal;
        });
    }

    document.getElementById('cart-items').innerHTML = html;
    document.getElementById('cart-total').textContent = total.toFixed(2);
}
