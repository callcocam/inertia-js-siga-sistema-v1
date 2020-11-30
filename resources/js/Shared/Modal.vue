<template>
    <div v-show="show"
        :id="id"
        class="fixed top-0 inset-x-0 px-4 pt-6 z-50 sm:px-0 sm:flex sm:items-top sm:justify-center"
        style="display: block;" :class="maxWidth"
    >
        <div v-show="show" class="fixed inset-0 transform transition-all" @click="close()">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div v-show="show" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full">
            <slot></slot>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Modal",
        props:{
            id:String,
            maxWidth:String,
        },
        data(){
            return {
                model:true,
                show:true,
            }
        },
        methods:{
            close(){
                this.show = false
                this.$emit('close')
            }
        }
    }
</script>

<style scoped>

</style>
