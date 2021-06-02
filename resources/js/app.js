import { createApp } from 'vue';
import App from './components/App.vue'
import router from "./router";

/* import SecondApp from './components/ExampleComponent.vue'
createApp(SecondApp).mount("#second") */

createApp(App).use(router).mount("#app")
