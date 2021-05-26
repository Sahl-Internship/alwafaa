<template>
  <q-select
    :label="label"
    :dense="dense"
    :outlined="outlined"
    :borderless="borderless"
    :value="value"
    :color="color"
    :bg-color="bgColor"
    :options="options"
    @input="value => $emit('input', value)"
    :error="error"
    :error-message="errorMessage"
  >
    <template v-if="prependIconName || flag" v-slot:prepend>
      <flag v-if="flag" :iso="flag" class="flag-icon-circle" />
      <q-icon
        v-else
        :name="prependIconName"
        :color="prependIconColor"
        :size="prependIconSize"
      />
    </template>

    <template v-if="appendIconName" v-slot:append>
      <q-icon
        :name="appendIconName"
        :color="appendIconColor"
        :size="appendIconSize"
      />
    </template>
  </q-select>
</template>

<script>
export default {
  data () {
    return {
      isPwd: false
    }
  },
  props: {
    options: { type: Array, required: true },
    label: { type: String, required: false, default: '' },
    outlined: { type: Boolean, required: false, default: false },
    dense: { type: Boolean, required: false, default: false },
    borderless: { type: Boolean, required: false, default: false },
    color: { type: String, required: false },
    bgColor: { type: String, required: false },
    value: { type: String, required: false },
    error: { type: Boolean, required: false },
    errorMessage: { type: String, required: false },
    prependIconName: { type: String, required: false },
    prependIconColor: { type: String, required: false },
    prependIconSize: { type: String, required: false },
    appendIconName: { type: String, required: false },
    appendIconColor: { type: String, required: false },
    appendIconSize: { type: String, required: false },
    flag: { type: String, required: false }
  }
}
</script>

<style lang="scss" scoped>
.flag-icon-circle {
  border-radius: 30px;
}
</style>
