<template>
  <q-btn
    no-caps
    rounded
    :flat="flat"
    :dense="dense"
    :type="type"
    :label="$t(label)"
    :class="[width, ...margin]"
    :size="size ? size : $q.screen.lt.md? 'md' : 'lg'"
    :icon-right="iconRight"
    :icon="icon"
    :color="color"
    :text-color=" textColor ? textColor : 'grey-5'"
    :to="to"
  />
</template>

<script>
export default {
  props: {
    label: { type: String, required: false },
    type: { type: String, required: false, default: 'submit' },
    width: { type: String, required: false },
    margin: { type: Array, required: false },
    dense: { type: Boolean, required: false, default: false },
    flat: { type: Boolean, required: false, default: false },
    color: { type: String, required: false, default: 'green' },
    textColor: { type: String, required: false, default: 'grey-5' },
    iconRight: { type: String, required: false },
    icon: { type: String, required: false },
    size: { type: String, required: false },
    to: { type: String, required: false }
  }
}
</script>
