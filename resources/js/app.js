import Vue from 'vue'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress/src'
// require('alpine')

Vue.config.productionTip = false
Vue.mixin({ methods: { route: window.route } })
Vue.use(InertiaApp)
Vue.use(PortalVue)
Vue.use(VueMeta)

InertiaProgress.init()


import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/Buttons/LoadingButton'
import SelectInput from '@/Shared/Inputs/SelectInput'
import TextInput from '@/Shared/Inputs/TextInput'
import FileInput from '@/Shared/Inputs/FileInput'
import TrashedMessage from '@/Shared/TrashedMessage'
import Confirm from '@/Shared/Confirm'
import Modal from "@/Shared/Modal";
import DangerButton from "./Shared/Buttons/DangerButton";
import SecundaryButton from "@/Shared/Buttons/SecundaryButton";
import Delete from "@/Shared/Buttons/Delete";
import Restore from "@/Shared/Buttons/Restore";
import SectionBorder from "@/Shared/SectionBorder";
import TextareaInput from "./Shared/Inputs/TextareaInput";

Vue.component('b-loading', Layout)
Vue.component('loading-button', LoadingButton)
Vue.component('select-input', SelectInput)
Vue.component('textarea-input', TextareaInput)
Vue.component('text-input', TextInput)
Vue.component('file-input', FileInput)
Vue.component('trashed-message', TrashedMessage)
Vue.component('confirmation-modal', Confirm)
Vue.component('modal', Modal)
Vue.component('d-button', DangerButton)
Vue.component('s-button', SecundaryButton)
Vue.component('delete-button', Delete)
Vue.component('restore-button', Restore)
Vue.component('section-border', SectionBorder)

//helpers

window.__=(val)=>{
    return val
}

let app = document.getElementById('app')
new Vue({
  metaInfo: {
    titleTemplate: (title) => title ? `${title} - Ping CRM` : 'Ping CRM'
  },
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(app)
