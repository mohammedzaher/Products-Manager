export default {
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
};
