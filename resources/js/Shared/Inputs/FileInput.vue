<template>
    <div>{{errors}}
        <div class="flex w-full mt-2 mx-auto items-center justify-center" v-if="photoPreview">
            <img :src="photoPreview" :alt="photoName" class="rounded-full h-20 w-20 object-cover">
        </div>
        <label v-if="label" class="form-label">{{ label }}:</label>
        <div class="form-input p-0" :class="{ error: errors.length }">
            <input ref="file" type="file" :accept="accept" class="hidden" @change="change">
            <div v-if="!value" class="p-2">
                <button type="button"
                        class="px-4 py-1 bg-gray-500 hover:bg-gray-700 rounded-sm text-xs font-medium text-white"
                        @click="browse">
                    Browse
                </button>
            </div>
            <div v-else class="flex items-center justify-between p-2">
                <div class="flex-1 pr-1">{{ value.name }} <span class="text-gray-500 text-xs">({{ filesize(value.size) }})</span>
                </div>
                <button type="button"
                        class="px-4 py-1 bg-gray-500 hover:bg-gray-700 rounded-sm text-xs font-medium text-white"
                        @click="remove">
                    Remove
                </button>
            </div>
        </div>
        <div v-if="errors.length" class="form-error">{{ errors[0] }}</div>
    </div>
</template>
<script>
    export default {
        props: {
            previewUrl: String,
            value: File,
            label: String,
            accept: String,
            errors: {
                type: Array,
                default: () => [],
            },
        },
        data(){
            return {
                photoName: null,
                photoPreview: null,
            }
        },
        watch: {
            value(value) {
                if (!value) {
                    this.$refs.file.value = ''
                }
            },
        },
        created() {
            this.photoPreview = this.previewUrl
        },
        methods: {
            filesize(size) {
                var i = Math.floor(Math.log(size) / Math.log(1024))
                return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
            },
            browse() {
                this.$refs.file.click()
            },
            change(e) {
                this.photoName = e.target.files[0].name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);

                this.$emit('input', e.target.files[0])
            },
            remove() {
                this.photoPreview = this.previewUrl;
                this.$emit('input', null)
            },
        },
    }
</script>
