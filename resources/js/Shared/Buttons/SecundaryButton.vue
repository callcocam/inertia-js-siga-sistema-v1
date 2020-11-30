<template>
      <button :type="type" @click="$emit('click')" :disabled="loading" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
        <div v-if="loading" class="btn-spinner mr-2" />
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: "SecundaryButton",
        props: {
            loading: Boolean,
            type: {
                type: String,
                default:"button"
            },
        },
    }
</script>

<style scoped>

</style>
