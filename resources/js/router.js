import {createRouter, createWebHistory} from "vue-router";

import MainPageComponent from "./components/MainPageComponent";
import GrammarComponent from "./components/GrammarComponent";
import IrregularVerbsComponent from "./components/IrregularVerbsComponent";
import AdminComponent from "./components/AdminComponent";
import LessonsComponent from "./components/LessonsComponent";
import AddLessonsComponent from "./components/AddLessonsComponent";
import UpdateLessonsComponent from "./components/UpdateLessonsComponent";


export default createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/grammar', name: "grammar", component: GrammarComponent},
        {path: '/word', name: "word", component: MainPageComponent, alias: '/'},
        {path: '/irregular_verbs', name: "irregular_verbs", component: IrregularVerbsComponent},
        {path: '/admin', name: 'admin', component: AdminComponent},
        {path: '/lessons/:id', name: 'lessons', component: LessonsComponent},
        {path: '/lessons_add', name: 'lessonsAdd', component: AddLessonsComponent},
        {path: '/lessons_edit/:id', name: 'editLessons', component: UpdateLessonsComponent}
    ]
})
