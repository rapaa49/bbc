<?php
$f = "c:/bbc_project/resources/views/cart.blade.php";
$c = file_get_contents($f);

$oldRemove = "function removeItem(key) {
            
            postJson('{{ route('cart.remove') }}', { key })
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    updateCartCountBadge();
                    window.location.reload();
                })
                .catch(() => window.location.reload());
        }";

$newRemove = "function removeItem(key) {
            // Optimistically remove from UI
            const input = document.getElementById('qty-' + key);
            if (input) {
                const card = input.closest('.cart-item-card');
                if (card) {
                    card.remove();
                    updateCartDOM();
                }
            }

            postJson('{{ route('cart.remove') }}', { key })
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then((data) => {
                    updateCartCountBadge();
                    if (data && data.count === 0) {
                        window.location.reload(); // Reload to show empty state if 0 items left
                    }
                })
                .catch(() => window.location.reload());
        }";

$c = str_replace($oldRemove, $newRemove, $c);

$oldClear = "function clearCart() {
            
            postJson('{{ route('cart.clear') }}')
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    updateCartCountBadge();
                    window.location.reload();
                })
                .catch(() => window.location.reload());
        }";

$newClear = "function clearCart() {
            postJson('{{ route('cart.clear') }}')
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    window.location.reload(); // Since everything is gone, we let it reload to show empty state.
                })
                .catch(() => window.location.reload());
        }";

$c = str_replace($oldClear, $newClear, $c);

file_put_contents($f, $c);
echo "Done replacing";
