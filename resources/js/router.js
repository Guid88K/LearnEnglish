import {createRouter, createWebHistory} from "vue-router";

import MainPageComponent from "./components/MainPageComponent";
import GrammarComponent from "./components/GrammarComponent";
import IrregularVerbsComponent from "./components/IrregularVerbsComponent";
import AdminComponent from "./components/AdminComponent";

export default createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/grammar', name: "grammar", component: GrammarComponent},
        {path: '/word', name: "word", component: MainPageComponent,alias:'/'},
        {path: '/irregular_verbs', name: "irregular_verbs", component: IrregularVerbsComponent},
        {path: '/admin', name: 'admin', component: AdminComponent}
    ]
})
