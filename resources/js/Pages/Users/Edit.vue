<template>
    <div>
        <Form :row="row" :form="form" @submit="upload">
            <template slot="header">
                <h1 class="font-bold text-3xl">
                    <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('users.index')">{{
                        __('Photo')}}
                    </inertia-link>
                    <span class="text-indigo-400 font-medium">/</span>
                    {{ form.name }}
                </h1>
            </template>
            <template slot="default">
                <file-input v-model="file" :previewUrl="row.photo" :error="errors.photo" class="pr-6 pb-8 w-full" type="file"
                            accept="image/*" label="Photo"/>
            </template>
            <template slot="actions">
                <loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">{{ __('Update Photo')}}
                </loading-button>
            </template>
        </Form>
        <section-border />
        <Form :row="row" :form="form" @submit="update">
            <template slot="header">
                <h1 class="font-bold text-3xl">
                    <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('users.index')">{{
                        __('User Info')}}
                    </inertia-link>
                    <span class="text-indigo-400 font-medium">/</span>
                    {{ form.name }}
                </h1>
            </template>
            <template slot="default">
                <text-input v-model="form.name" :error="errors.name" class="pr-6 pb-8 w-full"
                            label="First name"/>
                <text-input v-if="form.phone" v-model="form.phone" :error="errors.phone" class="pr-6 pb-8 w-full lg:w-1/2"
                            label="Phone"/>
                <text-input v-if="form.phone" v-model="form.document" :error="errors.document" class="pr-6 pb-8 w-full lg:w-1/2"
                            label="Document"/>
                <select-input v-model="form.status" :error="errors.status" class="pr-6 pb-8 w-full"
                              label="Status">
                    <option value="published">{{ __('Yes')}}</option>
                    <option value="draft">{{ __('No') }}</option>
                </select-input>
                <select-input v-if="form.owner" v-model="form.owner" :error="errors.owner" class="pr-6 pb-8 w-full lg:w-1/2"
                              label="Owner">
                    <option :value="true">Yes</option>
                    <option :value="false">No</option>
                </select-input>
                <textarea-input v-model="form.description" :error="errors.description" class="pr-6 pb-8 w-full"
                            label="Description"/>
            </template>
            <template slot="actions">
                <loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">{{ __('Update Info')}}
                </loading-button>
            </template>
        </Form>
        <section-border />
        <Form :row="row" :form="form" @submit="update">
            <template slot="header">
                <h1 class="font-bold text-3xl">
                    <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('users.index')">{{
                        __('User Access')}}
                    </inertia-link>
                    <span class="text-indigo-400 font-medium">/</span>
                    {{ form.name }}
                </h1>
            </template>
            <template slot="message_delete">
                <restore-button :show="row.deleted_at" @restore="restore()">
                    {{ __('User is deleted')}}
                </restore-button>
            </template>
            <template slot="default">
                <text-input v-model="form.email" :error="errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email"/>
                <text-input v-model="form.password" :error="errors.password" class="pr-6 pb-8 w-full lg:w-1/2"
                            type="password" autocomplete="new-password" label="Password"/>
            </template>
            <template slot="actions">
                <delete-button :show="row.deleted_at" @destroy="destroy()">{{ __('Delete')}}</delete-button>
                <loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">{{ __('Update Access')}}
                </loading-button>
            </template>
        </Form>
    </div>
</template>
<script>
    import Layout from '@/Shared/Layout'
    import Form from '@/Shared/Form'
    import Actions from "@/Shared/Actions";

    export default {
        metaInfo() {
            return {
                title: this.form.name,
            }
        },
        name: "Create",
        layout: Layout,
        components: {Form},
        extends: Actions,
        created() {
            this.form = this.row
        }
    }
</script>
