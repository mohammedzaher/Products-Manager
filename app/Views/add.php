<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title><?= $data['title']?></title>
  <style>
  [v-cloak] {
    display: none;
  }
  </style>
</head>

<body>
  <div id="app" v-cloak>
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

    <main style="min-height: 80vh;">
      <div class="container">
        <div class="col-md-12 py-5">
          <form id="product_form">

            <product-input v-for="(input, key) in product" :key="key" :name="input.name" :label="input.label"
              :type="input.type" :value="input.value" :feedback="input.feedback" @update-input-value="updateValue">
            </product-input>

            <div class="col-md-5 mb-3">
              <div class="row">
                <label for="productType" class="col-md-5 col-form-label-lg p-1 px-3"> Type Switcher </label>
                <div class="col-md-7">
                  <select id="productType" class="form-select" @change="changeType">
                    <option selected disabled>Type Switcher</option>
                    <option v-for="type in types" :key="type.id">{{type.name}}</option>
                  </select>
                  <div class="text-danger text-center pt-1">
                    {{productTypeFeedback}}
                  </div>
                </div>
              </div>
            </div>

            <div v-if="productType">
              <product-input v-for="(input, key) in productsDetails[productType].attributes" :key="key"
                :name="input.name" :label="input.label" :type="input.type" :value="input.value"
                :feedback="input.feedback" @update-input-value="updateValue">
              </product-input>
              <div class="col-md-5 mb-3">
                <p class="text-center">{{productsDetails[productType].description}}</p>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.4.21/vue.global.min.js"
    integrity="sha512-gEM2INjX66kRUIwrPiTBzAA6d48haC9kqrWZWjzrtnpCtBNxOXqXVFEeRDOeVC13pw4EOBrvlsJnNr2MXiQGvg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script type="module">
  let app = Vue.createApp({
    components: {
      'product-input': {
        name: 'productInput',
        props: ['name', 'label', 'type', 'value', 'feedback'],
        template: `
                <div class="col-md-5 mb-3">
                  <div class="row">
                    <label :for="name" class="col-md-4 col-form-label-lg p-1 px-3">{{label}}</label>
                    <div class="col-md-8">
                      <input :type="type" v-model="inputValue" class="form-control" :id="name" :placeholder="label" required>
                      <div class="text-danger text-center"> 
                        {{feedback}}
                      </div>
                    </div>
                  </div>
                </div>
      `,
        computed: {
          inputValue: {
            get() {
              return this.value;
            },
            set(value) {
              this.$emit('update-input-value', this.name, value);
            },
          },
        },
      }
    },
    data() {
      return {
        product: {
          sku: {
            name: "sku",
            label: "SKU",
            type: "text",
            value: "",
            feedback: ""
          },
          name: {
            name: "name",
            label: "Name",
            type: "text",
            value: "",
            feedback: ""
          },
          price: {
            name: "price",
            label: "Price ($)",
            type: "number",
            value: "",
            feedback: ""
          }
        },
        productsDetails: {
          Book: {
            attributes: {
              weight: {
                name: "weight",
                label: "Weight (KG)",
                type: "number",
                value: "",
                feedback: ""
              }
            },
            description: "Please, provide weight in KG"
          },
          DVD: {
            attributes: {
              size: {
                name: "size",
                label: "Size (MB)",
                type: "number",
                value: "",
                feedback: ""
              }
            },
            description: "Please, provide size in MB"
          },
          Furniture: {
            attributes: {
              height: {
                name: "height",
                label: "Height (CM)",
                type: "number",
                value: "",
                feedback: ""
              },
              width: {
                name: "width",
                label: "Width (CM)",
                type: "number",
                value: "",
                feedback: ""
              },
              length: {
                name: "length",
                label: "Length (CM)",
                type: "number",
                value: "",
                feedback: ""
              }
            },
            description: "Please, provide dimensions in HxWxL format"
          }
        },
        types: <?= json_encode($data["types"]) ?>,
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
      updateValue(inputId, value) {
        let product = this.product[inputId] ?? this.productsDetails[this.productType].attributes[inputId];
        product.value = value;
        let input = document.querySelector(`#${inputId}`);

        if (product.type === "number" && value === "") {
          input.classList.add("is-invalid");
          product.feedback = `Please, provide numeric ${inputId}.`;
        } else {
          input.classList.remove("is-invalid");
          product.feedback = "";
        }
      },
      validate(body) {
        for (let key in body) {
          if (body[key] === "") {
            if (key === "type") {
              let typeSwitcher = document.querySelector("#productType");
              typeSwitcher.classList.add("is-invalid");
              this.productTypeFeedback = "Please, select product type.";
            } else {
              let product = this.product[key] ?? this.productsDetails[this.productType].attributes[key];
              document.querySelector("#" + key).classList.add("is-invalid")

              if (product.type === "number") {
                product.feedback = `Please, provide numeric ${key}.`
              } else {
                product.feedback = "Please, submit required data"
              }
            }
          }
        }
        let numericInputs = ['price'];
        if (this.productType) {
          for (let input in this.productsDetails[this.productType].attributes) {
            numericInputs.push(input);
          }
        }
        numericInputs.forEach((input) => {
          if (body[input] <= 0 && body[input]) {
            let product = this.product[input] ?? this.productsDetails[this.productType].attributes[input];
            document.querySelector("#" + input).classList.add("is-invalid");
            product.feedback = `${product.label.split(' ')[0]} must be greater than 0`;
          }
        })


        return (document.querySelectorAll(".is-invalid").length === 0);
      },
      saveProduct() {
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

        if (this.validate(body)) {
          fetch(window.location.origin + '/product', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(body)
            }).then(response => response.json())
            .then(data => {
              if (data.message === "SKU Must be Unique for each product") {
                document.querySelector('#sku').classList.add("is-invalid");
                this.product.sku.feedback = data.message;
              } else if (data.message === "Price must be greater than 0") {
                document.querySelector('#price').classList.add("is-invalid");
                this.product.price.feedback = data.message;
              } else if (data.message === "SKU must be less than 255 characters") {
                document.querySelector('#sku').classList.add("is-invalid");
                this.product.sku.feedback = data.message;
              } else if (data.message === "Product Name must be less than 255 characters") {
                document.querySelector('#name').classList.add("is-invalid");
                this.product.name.feedback = data.message;
              } else {
                window.location.href = window.location.origin;
              }
            })
        }
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