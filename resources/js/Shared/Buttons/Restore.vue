<template>
    <trashed-message v-if="show" class="mb-6 w-full" @restore="modal = !modal">
       <slot></slot>
        <confirmation-modal v-if="modal && show" id="restore" maXWidth="xl" @close="modal=false">
            <div slot="title">
                {{ __('Restore tenant') }}
            </div>

            <div slot="content">
                {{ __('Are you sure you want to restore this user?') }}
            </div>
            <div slot="footer">
                <d-button @click="modal = !modal" type="button">{{ __('Nevermind')}}</d-button>
                <s-button :loading="sending" @click="$emit('restore')" type="button">{{ __('Restore Item')}}</s-button>
            </div>
        </confirmation-modal>
    </trashed-message>
</template>
<script>
    export default {
        name: "Restore",
        props: {
            show: {
                type: [String, Boolean],
                default: false
            }
        },
        data() {
            return {
                modal: false,
                sending: false,
            }
        },
        methods: {
            __(val) {
                return val;
            }
        }

    }
</script>
