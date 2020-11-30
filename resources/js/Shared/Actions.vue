<script>


    const objectToFormData = window.objectToFormData
    export default {
        name: "Actions",
        props: {
            errors: Object,
            row: Object,
        },
        remember: 'form',
        data() {
            return {
                file: null,
                store_url: null,
                update_url: null,
                destroy_url: null,
                restore_url: null,
                upload_url: null,
                download_url: null,
                sending: false,
                modal: false,
                form: {},
            }
        },
        methods: {
            __(val) {
                return val;
            },
            create() {
                this.$inertia.post(this.route(this.$page.store_url), this.form, {
                    onStart: () => this.sending = true,
                    onFinish: () => this.sending = false
                })

            },
            update() {
                this.form.id = this.row.id;
                this.$inertia.put(this.route(this.$page.update_url, this.row.id), this.form, {
                    onStart: () => this.sending = true,
                    onFinish: () => this.sending = false
                })
            },
            upload() {
                var data = new FormData()
                data.append('id', this.row.id)
                data.append('photo', this.file)
                this.$inertia.post(this.route(this.$page.upload_url), data, {
                    onStart: () => this.sending = true,
                    onFinish: () => this.sending = false,
                    onSuccess: (response) => {
                        console.log(response)
                        if (Object.keys(this.$page.errors).length === 0) {
                            this.form = this.row
                            this.form.password = null
                            this.file = null
                        }
                    },
                })
            },
            destroy() {
                this.modal = false
                this.$inertia.delete(this.route(this.$page.destroy_url, this.row.id))
            },
            restore() {
                this.modal = false
                this.$inertia.delete(this.route(this.$page.restore_url, this.row.id))
            },
        },
    }
</script>

<style scoped>

</style>
