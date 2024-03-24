<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['title']?></title>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>

<body>
  <main>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8">

        <form action="/addproduct" method="POST">
          <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
              <h2 class="text-base font-semibold leading-7 text-gray-900">Add Product</h2>
              <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                  <label for="sku" class="block text-sm font-medium leading-6 text-gray-900">SKU</label>
                  <div class="mt-2">
                    <input type="text" name="sku" id="sku" autocomplete="sku"
                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                  <div class="mt-2">
                    <input type="text" name="name" id="name" autocomplete="name"
                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                  <div class="mt-2">
                    <input id="price" name="price" type="text" autocomplete="price"
                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                  <div class="mt-2">
                    <select id="type" name="type" autocomplete="type"
                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                      <option>DVD</option>
                      <option>Book</option>
                      <option>Furniture</option>
                    </select>
                  </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                  <label for="height" class="block text-sm font-medium leading-6 text-gray-900">Height</label>
                  <div class="mt-2">
                    <input type="text" name="height" id="height" autocomplete="height"
                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <label for="width" class="block text-sm font-medium leading-6 text-gray-900">Width</label>
                  <div class="mt-2">
                    <input type="text" name="width" id="width" autocomplete="width"
                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <label for="length" class="block text-sm font-medium leading-6 text-gray-900">Length</label>
                  <div class="mt-2">
                    <input type="text" name="length" id="length" autocomplete="length"
                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href='/' class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <button type="submit"
              class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
          </div>
        </form>

      </div>
    </div>
  </main>

</body>

</html>