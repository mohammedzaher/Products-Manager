<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title><?= $data['title']?></title>
</head>

<body>

  <div id="app">

    <header>
      <div class="container">
        <div class="d-flex flex-row justify-content-between col-md-12 p-3 pb-1">
          <div>
            <h1 class="page-header"> <?php echo $title ?> </h1>
          </div>
          <div class="page-btn-container">
            <a href="/addproduct" class="btn btn-primary m-3"> ADD </a>
            <button type="button" @click.prevent="deleteProducts" class="btn btn-danger m-3" id="delete-product-btn">
              MASS DELETE </button>
          </div>
        </div>
        <hr class="m-1">
      </div>
    </header>
    <main>
      <div class="container">
        <div class="d-flex flex-wrap col-m d-12">
          <div class="row">
            <div v-for="product in products" :key="product.id" class="col-md-6 col-lg-3 mt-4 mb-4">
              <div class="product-card">
                <div class="card text-center border-black pb-5">
                  <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-start mb-2">
                      <input class="delete-checkbox" :id="product.id" type="checkbox" value="">
                    </div>
                    <div> {{ product.sku }} </div>
                    <div> {{ product.name }} </div>
                    <div> {{ product.price }} $ </div>
                    <div> {{ product.details }} </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <footer id="footer">
      <div class="container">
        <hr class="m-1 mb-4">
        <p class="text-center"> Scandiweb Test Assignment </p>
      </div>
    </footer>
  </div>


  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

  <script type="module">
  let app = Vue.createApp({
    data() {
      return {
        products: <?= json_encode($data["products"]) ?>
      }
    },
    methods: {
      deleteProducts() {
        let productsToDelete = []
        document.querySelectorAll('.delete-checkbox').forEach((checkbox) => {
          if (checkbox.checked) {
            productsToDelete.push(checkbox)
          }
        })

        productsToDelete.forEach((product) => {
          console.log(window.location.origin + "/deleteProduct")
          fetch(window.location.origin + "/deleteProduct", {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              id: product.id,
              type: this.products[product.id].type
            })
          }).then(response => response.json())

          delete this.products[product.id]
        })
      }
    }
  })
  app.mount('#app')
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>