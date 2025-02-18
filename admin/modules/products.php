<!-- Header -->
<div
  class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
  <div class="w-full mb-1">
    <div class="mb-4">
      <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">All Products</h1>
    </div>
    <div class="sm:flex">
      <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
        <form class="lg:pr-3" action="#" method="GET">
          <label for="products-search" class="sr-only">Search</label>
          <div class="relative mt-1 lg:w-64 xl:w-96">
            <input type="text" name="email" id="products-search"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Search for products">
          </div>
        </form>
      </div>
      <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
        <button type="button" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal"
          class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
              clip-rule="evenodd"></path>
          </svg>
          Add product
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Table Product List -->
<div class="flex flex-col">
  <div class="overflow-x-auto">
    <div class="inline-block min-w-full align-middle">
      <div class="overflow-hidden shadow" id="users_table">
        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
          <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
              <th scope="col" class="p-4">
                <div class="flex items-center">
                  <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox"
                    class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                  <label for="checkbox-all" class="sr-only">checkbox</label>
                </div>
              </th>
              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Nama Produk
              </th>
              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Harga
              </th>
              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Stok
              </th>
              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Dibuat oleh
              </th>
              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Status
              </th>
              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
            <?php
            $products = getAllItems('products');
            foreach ($products as $product) {
              ?>
              <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                <td class="w-4 p-4">
                  <div class="flex items-center">
                    <input id="checkbox-{{ .id }}" aria-describedby="checkbox-1" type="checkbox"
                      class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-{{ .id }}" class="sr-only">checkbox</label>
                  </div>
                </td>
                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <?= $product['product_name'] ?>
                </td>
                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Rp <?= number_format($product['price'], 2, ',', '.') ?>
                </td>

                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <?= $product['stock'] ?>
                </td>
                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <?php
                  $user_id = getUsernameById($product['created_by']);
                  $userdata = mysqli_fetch_array($user_id);
                  ?>
                  <?= $userdata['username'] ?> (<?= $userdata['role_as'] ? 'Admin' : 'Kasir' ?>)
                </td>
                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer" <?= $product['is_approved'] ? 'checked' : '' ?>
                      <?= $userdata['role_as'] != 1 ? 'disabled' : '' ?> data-product-id="<?= $product['id'] ?>"
                      id="product_status">
                    <div
                      class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Aktif</span>
                  </label>
                </td>

                <td class="p-4 space-x-2 whitespace-nowrap">
                  <button type="button" data-modal-target="edit-user-modal" data-modal-toggle="edit-user-modal"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                      <path fill-rule="evenodd"
                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                        clip-rule="evenodd"></path>
                    </svg>
                    Edit product
                  </button>
                  <button type="button" value="<?= $user['id'] ?>"
                    class="delete_btn inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                    </svg>
                    Delete product
                  </button>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Edit Product Modal -->
<div
  class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
  id="edit-user-modal">
  <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
        <h3 class="text-xl font-semibold dark:text-white">
          Edit user
        </h3>
        <button type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
          data-modal-toggle="edit-user-modal">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-6 space-y-6">
        <form action="./adminCode.php" method="post">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
              <label for="username"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
              <input type="text" name="username" id="username"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="user123" required>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                Role</label>
              <select id="role" name="role"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
                <option selected value="" disabled>Pilih Role</option>
                <option value="0">Kasir</option>
                <option value="1">Admin</option>
              </select>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input type="password" name="password" id="password"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="********" required>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="password2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                Password</label>
              <input type="password" name="password2" id="password2"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="********" required>
            </div>
          </div>
      </div>
      <!-- Modal footer -->
      <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
        <button
          class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
          type="submit" name="update_btn">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Add Product Modal -->
<div
  class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
  id="add-product-modal">
  <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
        <h3 class="text-xl font-semibold dark:text-white">
          Add new product
        </h3>
        <button type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
          data-modal-toggle="add-product-modal">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-6 space-y-6">
        <form action="./adminCode.php" method="post">
          <input type="hidden" name="created_by" value="<?= $_SESSION['auth_user']['user_id'] ?>">
          <input type="hidden" name="is_approved" value='<?= $_SESSION['role_as'] ?>'>
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-12 sm:col-span-6">
              <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                Produk</label>
              <input type="text" name="product_name" id="product_name"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Nasi bandeng" required>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
              <input type="number" name="price" id="price"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="3000" required>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
              <input type="number" name="stock" id="stock"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="0" required <?= $userdata['role_as'] == 1 ? 'disabled' : '' ?>>
            </div>
          </div>
      </div>
      <!-- Modal footer -->
      <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
        <button
          class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
          type="submit" name="addProduct_btn">Add product</button>
      </div>
      </form>
    </div>
  </div>
</div>