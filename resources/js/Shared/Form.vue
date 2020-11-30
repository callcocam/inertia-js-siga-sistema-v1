<template>
    <div>
        <div class="mb-8 flex justify-start max-w-3xl">
            <slot name="header"/>
        </div>
        <slot name="message_delete"/>
        <div class="bg-white rounded shadow overflow-hidden max-w-full">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <slot/>
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                    <slot name="actions"></slot>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Form",
        props: {
            errors: Object,
            row: Object,
            form: Object,
            action: String,
        },
        data() {
            return {
                sending: false
            }
        },
        methods: {
            __(val) {
                return val;
            },
            submit() {
                this.$emit('submit', this.form)
            },
            destroy() {
                console.log("aqui")
            },
            restore() {
                console.log("aqui")
            },
        },

    }
</script>

<style scoped>

</style>
