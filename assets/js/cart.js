// Добавить блюдо в корзину
function addToCart(dishId, dishName, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let existing = cart.find(item => item.dishId === dishId);

    if (existing) {
        existing.quantity += 1;
    } else {
        cart.push({ dishId, dishName, price, quantity: 1 });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    alert(`Добавлено в корзину: ${dishName}`);
    showCart(); // Обновляем отображение корзины, если она открыта
}

// Показать содержимое корзины
function showCart() {
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    let html = '';
    let total = 0;

    if (cartItems.length === 0) {
        html = '<p>Корзина пуста</p>';
    } else {
        cartItems.forEach(item => {
            const itemTotal = item.price * item.quantity;
            html += `
                <div class="flex justify-between items-center border-b py-2">
                    <div>
                        <div class="font-medium">${item.dishName}</div>
                        <div class="text-sm text-gray-500">${item.quantity} x ${item.price.toFixed(2)} €</div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="font-semibold">${itemTotal.toFixed(2)} €</div>
                        <button onclick="removeFromCart(${item.dishId})" class="text-red-600 hover:text-red-800 font-bold px-2 py-1 rounded border border-red-600 hover:border-red-800 transition">
                            Удалить
                        </button>
                    </div>
                </div>
            `;
            total += itemTotal;
        });
    }

    document.getElementById('cart-items').innerHTML = html;
    document.getElementById('cart-total').textContent = total.toFixed(2);
}

// Удалить блюдо из корзины по ID
function removeFromCart(dishId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.dishId !== dishId);
    localStorage.setItem('cart', JSON.stringify(cart));
    showCart();
}
