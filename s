 <?php if (in_array($product['id'], $favoriteProductIds)): ?>
     <form action="/public/removefromfavorites" method="POST" class="favorite-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
         <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
         <button type="submit" class="btn btn-danger mt-2 favorite-btn">
             <i class="fa fa-heart"></i>
         </button>
     </form>
 <?php else: ?>
     <form action="/public/addtofavorites" method="POST" class="favorite-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
         <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
         <button type="submit" class="btn btn-outline-danger mt-2 favorite-btn">
             <i class="fa-regular fa-heart"></i>
         </button>
     </form>
 <?php endif; ?>