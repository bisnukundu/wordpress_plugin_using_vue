import { createApp } from "vue";
import "./style.css";
import "@formkit/themes/genesis";

import { plugin, defaultConfig } from "@formkit/vue";
import App from "./App.vue";
import config from "./../formkit.config";

createApp(App).use(plugin, defaultConfig(config)).mount("#app1");
createApp(App).use(plugin, defaultConfig(config)).mount("#app2");
createApp(App).use(plugin, defaultConfig(config)).mount("#app3");
createApp(App).use(plugin, defaultConfig(config)).mount("#app4");
createApp(App).use(plugin, defaultConfig(config)).mount("#app5");
createApp(App).use(plugin, defaultConfig(config)).mount("#app6");
createApp(App).use(plugin, defaultConfig(config)).mount("#app7");
createApp(App).use(plugin, defaultConfig(config)).mount("#app8");
createApp(App).use(plugin, defaultConfig(config)).mount("#app9");
createApp(App).use(plugin, defaultConfig(config)).mount("#app10");
