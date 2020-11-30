<template>
    <Form :row="row" :form="form" @submit="create">
        <template slot="header">
            <h1 class="font-bold text-3xl">
                <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('tenants.index')">Tenant
                </inertia-link>
                <span class="text-indigo-400 font-medium">/</span>
                Create
            </h1>
        </template>
        <template slot="default" v-if="form">
            <text-input v-model="form.name" :error="errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Name"/>
            <text-input v-model="form.domain" :error="errors.domain" class="pr-6 pb-8 w-full lg:w-1/2" label="Dominio"/>
            <select-input v-model="form.prefix" :error="errors.prefix" class="pr-6 pb-8 w-full lg:w-1/2" label="Prefix">
                <option value="landlord">Landlord</option>
                <option value="admin">Tenant</option>
            </select-input>
            <select-input v-model="form.database" :error="errors.database" class="pr-6 pb-8 w-full lg:w-1/2" label="Database">
                <option value="landlord">Landlord</option>
                <option value="tenants">Tenant</option>
            </select-input>
            <select-input multiple="true" v-model="form.middleware" :error="errors.middleware" class="pr-6 pb-8 w-full lg:w-1/2" label="Middleware">
                <option value="tenant">Tenant</option>
                <option value="landlord">Landlord</option>
                <option value="web">Web</option>
                <option value="api">Api</option>
            </select-input>
            <select-input v-model="form.status" :error="errors.owner" class="pr-6 pb-8 w-full lg:w-1/2" label="Status">
                <option value="published">Publicado</option>
                <option value="draft">Rascunho</option>
            </select-input>
        </template>
        <template slot="actions">
            <loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">Update</loading-button>
        </template>
    </Form>
</template>
<script>
    import Form from '@/Shared/Form'
    import Layout from '@/Shared/Layout'
    import Actions from "@/Shared/Actions";
    import Modal from "../../Shared/Modal";

    export default {
        name: "Create",
        layout: Layout,
        components: {Modal, Form},
        remember: 'form',
        extends: Actions
    }
</script>

<style scoped>

</style>
