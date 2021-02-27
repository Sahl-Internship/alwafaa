<template>
  <q-input
    :type="type === 'password' && isPwd ? 'text' : type"
    :label="label"
    :outlined="outlined"
    :dense="dense"
    :borderless="borderless"
    :value="value"
    :color="color"
    @input="value => $emit('input', value)"
    :error="error"
    :error-message="errorMessage"
  >
    <template v-if="prependIconName" v-slot:prepend>
      <q-icon
        :name="prependIconName"
        :color="prependIconColor"
        :size="prependIconSize"
      />
    </template>

    <template v-if="appendIconName" v-slot:append>
      <q-icon
        v-if="type !== 'password'"
        :name="appendIconName"
        :color="appendIconColor"
        :size="appendIconSize"
      />
       <q-icon
        v-else
        :name="!isPwd ? appendIconName : 'mdi-eye'"
        class="cursor-pointer"
        @click="isPwd = !isPwd"
      />
    </template>
  </q-input>
</template>

<script>
export default {
  data () {
    return {
      isPwd: false
    }
  },
  props: {
    type: { type: String, required: true, default: 'text' },
    label: { type: String, required: true, default: '' },
    outlined: { type: Boolean, required: false, default: false },
    dense: { type: Boolean, required: false, default: false },
    borderless: { type: Boolean, required: false, default: false },
    color: { type: String, required: false },
    value: { type: String, required: false },
    error: { type: Boolean, required: false },
    errorMessage: { type: String, required: false },
    prependIconName: { type: String, required: false },
    prependIconColor: { type: String, required: false },
    prependIconSize: { type: String, required: false },
    appendIconName: { type: String, required: false },
    appendIconColor: { type: String, required: false },
    appendIconSize: { type: String, required: false }
  }
}
</script>
