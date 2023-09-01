import { createApp } from 'vue'
import './style.css'
import '@formkit/themes/genesis'

import { plugin, defaultConfig } from '@formkit/vue'
import App from './App.vue'
import config from './../formkit.config'

createApp(App).use(plugin, defaultConfig(config)).mount('#app')

