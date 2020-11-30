<template>
    <Form :row="row" :form="form" @submit="update">
        <template slot="header">
            <h1 class="font-bold text-3xl">
                <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('tenants.index')">Tenant
                </inertia-link>
                <span class="text-indigo-400 font-medium">/</span>
                {{ form.name }}
            </h1>
        </template>
        <template slot="message_delete">
            <trashed-message v-if="row.deleted_at" class="mb-6 w-full" @restore="modal = !modal">
                {{ __('Tenant is deleted')}}
                <confirmation-modal v-if="modal && row.deleted_at" id="restore" maXWidth="xl" @close="modal=false">
                    <div slot="title">
                        {{ __('Restore tenant') }}
                    </div>

                    <div slot="content">
                        {{ __('Are you sure you want to restore this user?') }}
                    </div>
                    <div slot="footer">
                        <d-button  @click="modal = !modal" type="button">{{ __('Nevermind')}}</d-button>
                        <s-button :loading="sending" @click="restore" type="button">{{ __('Restore Item')}}</s-button>
                    </div>
                </confirmation-modal>
            </trashed-message>
        </template>
        <template slot="default">
            <text-input v-model="form.name" :error="errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
            <text-input v-model="form.domain" :error="errors.domain" class="pr-6 pb-8 w-full lg:w-1/2" label="Dominio" />
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
            <button v-if="!row.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button"
                    @click="modal = !modal">Delete
            </button>
            <loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">Update</loading-button>
            <confirmation-modal v-if="modal && !row.deleted_at" id="delete" maXWidth="xl" @close="modal=false">
                <div slot="title">
                    {{ __('Delete Team') }}
                </div>

                <div slot="content">
                    {{ __('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.') }}
                </div>
                <div slot="footer">
                    <d-button  @click="modal = !modal" type="button">{{ __('Nevermind')}}</d-button>
                    <s-button :loading="sending" @click="destroy" type="button">{{ __('Delete Item')}}</s-button>
                </div>
            </confirmation-modal>
        </template>
    </Form>
</template>
<script>
    import Form from '@/Shared/Form'
    import Layout from '@/Shared/Layout'
    import Actions from "@/Shared/Actions";
    export default {
        name: "Create",
        layout: Layout,
        components: {Form},
        extends:Actions,
        created() {
            this.form = this.row
        }
    }
</script>

<style scoped>

</style>
