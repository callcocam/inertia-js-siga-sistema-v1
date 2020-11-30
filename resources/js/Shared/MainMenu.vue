<template>
    <div>
        <div class="mb-4">
            <inertia-link class="flex items-center group py-3" :href="route('dashboard')">
                <icon name="dashboard" class="w-4 h-4 mr-2"
                      :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"/>
                <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
            </inertia-link>

            <inertia-link class="flex items-center group py-3" :href="route('tenants.index')">
                <icon name="cog" class="w-4 h-4 mr-2"
                      :class="route().current('tenants.index') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"/>
                <div :class="route().current('tenants.index') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Tenants</div>
            </inertia-link>

            <inertia-link class="flex items-center group py-3" :href="route('users.index')">
                <icon name="users" class="w-4 h-4 mr-2"
                      :class="route().current('users.index') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"/>
                <div :class="route().current('users.index') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Users</div>
            </inertia-link>

        </div>
    </div>
</template>

<script>
    import Icon from '@/Shared/Icon'

    export default {
        components: {
            Icon,
        },
        props: {
            url: String,
        },
        methods: {
            isUrl(...urls) {
                if (urls[0] === '') {
                    return this.url === ''
                }

                return urls.filter(url => this.url.startsWith(url)).length
            },
        },
    }
</script>
