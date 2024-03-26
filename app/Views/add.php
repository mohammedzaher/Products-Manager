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
            <h1 class="page-header"> <?php echo $title; ?> </h1>
          </div>
          <div class="page-btn-container">
            <button @click.prevent="saveProduct" class="btn btn-primary m-3">Save</button>
            <a href="/" class="btn btn-danger m-3">Cancel</a>
          </div>
        </div>
        <hr class="m-1">
      </div>
    </header>

    <main>
      <div class="container">
        <div class="col-md-12 py-5">
          <form>
            <div class="col-md-5 mb-3">
              <div class="row">
                <label for="sku" class="col-md-4 col-form-label-lg p-1 px-3">SKU</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="sku" required>
                </div>
              </div>
            </div>

            <div class="col-md-5 mb-3">
              <div class="row">
                <label for="name" class="col-md-4 col-form-label-lg p-1 px-3">Name</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="name" required>
                </div>
              </div>
            </div>

            <div class="col-md-5 mb-3">
              <div class="row">
                <label for="price" class="col-md-4 col-form-label-lg p-1 px-3">Price ($)</label>
                <div class="col-md-8">
                  <input type="number" class="form-control" id="price" required>
                </div>
              </div>
            </div>

            <div class="col-md-5 mb-3">
              <div class="row">
                <label for="productType" class="col-md-5 col-form-label-lg p-1 px-3"> Type Switcher </label>
                <div class="col-md-7">
                  <select id="productType" class="form-select" @change="changeType">
                    <option selected disabled>Type Switcher</option>
                    <option v-for="type in types" :key="type.id">{{type.name}}</option>
                  </select>
                  <div class="text-center pt-1">
                    {{productTypeFeedback}}
                  </div>
                </div>

              </div>
            </div>

            <div v-if="productType === 'Book'">
              <div class="col-md-5 mb-3">
                <div class="row">
                  <label for="weight" class="col-md-4 col-form-label-lg p-1 px-3">Weight (KG)</label>
                  <div class="col-md-8">
                    <input type="number" class="form-control" id="weight" required>
                  </div>
                </div>
              </div>
              <div class="col-md-5 mb-3">
                <p class="text-center">Please, provide weight in KG.</p>
              </div>
            </div>
            <div v-if="productType === 'DVD'">
              <div class="col-md-5 mb-3">
                <div class="row">
                  <label for="size" class="col-md-4 col-form-label-lg p-1 px-3">Size (MB)</label>
                  <div class="col-md-8">
                    <input type="number" class="form-control" id="size" required>
                  </div>
                </div>
              </div>
              <div class="col-md-5 mb-3">
                <p class="text-center">Please, provide size in MB.</p>
              </div>
            </div>
            <div v-if="productType === 'Furniture'">

              <div class="col-md-5 mb-3">
                <div class="row">
                  <label for="height" class="col-md-4 col-form-label-lg p-1 px-3">Height (CM)</label>
                  <div class="col-md-8">
                    <input type="number" class="form-control" id="height" required>
                  </div>
                </div>
              </div>

              <div class="col-md-5 mb-3">
                <div class="row">
                  <label for="width" class="col-md-4 col-form-label-lg p-1 px-3">Width (CM)</label>
                  <div class="col-md-8">
                    <input type="number" class="form-control" id="width" required>
                  </div>
                </div>
              </div>

              <div class="col-md-5 mb-3">
                <div class="row">
                  <label for="length" class="col-md-4 col-form-label-lg p-1 px-3">Length (CM)</label>
                  <div class="col-md-8">
                    <input type="number" class="form-control" id="length" required>
                  </div>
                </div>
              </div>

              <div class="col-md-5 mb-3">
                <p class="text-center">Please, provide dimensions in HxWxL format.</p>
              </div>
            </div>
          </form>
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
        types: <?= json_encode($data["types"]) ?>,
        productsDetails: {},
        productType: "",
        productTypeFeedback: ""
      }
    },
    methods: {
      changeType() {
        let typeSwitcher = document.querySelector("#productType");
        this.productType = typeSwitcher.options[typeSwitcher.selectedIndex].value;

        typeSwitcher.classList.remove("is-invalid");
        this.productTypeFeedback = "";
      },
      validate(data) {
        for (let key in data) {
          if (data[key] === "") {
            if (key === "type") {
              let typeSwitcher = document.querySelector("#productType");
              typeSwitcher.classList.add("is-invalid");
              this.productTypeFeedback = "Please, select product type.";
            }
          }
        }

        return (document.querySelectorAll(".is-invalid").length === 0);
      },
      saveProduct() {
        console.log('save product');
        let sku = document.querySelector('#sku').value;
        let name = document.querySelector('#name').value;
        let price = document.querySelector('#price').value;
        let productType = this.productType;
        let size, weight, height, width, length;

        if (productType === 'Book') {
          weight = document.querySelector('#weight').value;
        } else if (productType === 'DVD') {
          size = document.querySelector('#size').value;
        } else if (productType === 'Furniture') {
          height = document.querySelector("#height").value;
          width = document.querySelector("#width").value;
          length = document.querySelector("#length").value;
        }

        let body = {
          sku: sku,
          name: name,
          price: price,
          type: productType,
          size: size,
          weight: weight,
          height: height,
          width: width,
          length: length
        };

        this.validate(body);

        fetch(window.location.origin + '/product', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(body)
        }).then(response => response.json())

        // window.location.href = window.location.origin;
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