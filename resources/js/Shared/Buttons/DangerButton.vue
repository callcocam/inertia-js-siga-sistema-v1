<template>
    <button :type="type"  @click="$emit('click')" :disabled="loading" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
        <div v-if="loading" class="btn-spinner mr-2" />
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: "DangerButton",
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
