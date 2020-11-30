<template>
    <button v-if="!show" class="text-red-600 hover:underline" tabindex="-1" type="button"
            @click="modal = !modal"> <slot></slot>
        <confirmation-modal v-if="modal && !show" id="delete" maXWidth="xl" @close="modal=false">
            <div slot="title">
                {{ __('Delete Item') }}
            </div>
            <div slot="content">
                {{ __('Are you sure you want to delete this user?') }}
            </div>
            <div slot="footer">
                <d-button @click="modal = !modal" type="button">{{ __('Nevermind')}}</d-button>
                <s-button :loading="sending" @click="$emit('destroy')" type="button">{{ __('Delete Item')}}</s-button>
            </div>
        </confirmation-modal>
    </button>
</template>
<script>
    export default {
        name: "Delete",
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
