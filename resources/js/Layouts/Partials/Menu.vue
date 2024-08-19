<template>
    <div class="navigation">
        <ul>
            <li class="titre">
                <a href="#">
                    <span class="icon">
                        <i><img src="images/METFP.png" alt="" style="width: 50px; height:50px; border-radius: 25px;"></i>
                    </span>
                    <span class="title mt-2" style="font-weight: 500;font-size: 20px;"> Mon App</span>
                </a>
            </li>
            <li :class=" { 'hovered' : $page.component.startsWith('Employer/')}">
                <Link :href="route('employer')">
                    <span class="icon">
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="title"> Employé</span>
                </Link>
            </li>
            <li class="sub-btn btn1" :class=" { 'hovered' : $page.component.startsWith('Departement/')}" @click="openEditModale">
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-building"></i>
                    </span>
                    <span class="title"> Departement</span>
                    <i class="fa fa-angle-right dropdown" aria-hidden="true"></i>
                </a>
                <ul class="sub-menu">
                    
                    <li>
                        <Link :href="route('direction')">
                        <i :class=" { 'lienActiver' : $page.component.startsWith('Departement/Direction')}" class="far fa-circle nav-icon"></i>
                        <p :class=" { 'lienActiver' : $page.component.startsWith('Departement/Direction')}"> Direction</p>
                    </Link>
                </li>
                    <li>
                        <Link :href="route('service')">
                            <i :class=" { 'lienActiver' : $page.component.startsWith('Departement/Service')}" class="far fa-circle nav-icon"></i>
                            <p :class=" { 'lienActiver' : $page.component.startsWith('Departement/Service')}"> Service</p>
                        </Link>
                        </li>
                    <li>
                        <Link :href="route('fonction')">
                            <i :class=" { 'lienActiver' : $page.component.startsWith('Departement/Fonction')}"  class="far fa-circle nav-icon"></i>
                            <p :class=" { 'lienActiver' : $page.component.startsWith('Departement/Fonction')}" > Fonction</p>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('poste')">
                            <i :class=" { 'lienActiver' : $page.component.startsWith('Departement/Poste')}"  class="far fa-circle nav-icon"></i>
                            <p :class=" { 'lienActiver' : $page.component.startsWith('Departement/Poste')}" > Poste</p>
                        </Link>
                    </li>
                </ul>
            </li>
            <li class="sub-btn btn1" :class=" { 'hovered' : $page.component.startsWith('Grade/')}">
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-bookmark" aria-hidden="true"></i>
                    </span>
                    <span class="title"> Grade</span>
                    <i class="fa fa-angle-right dropdown" aria-hidden="true"></i>
                </a>
                <ul class="sub-menu">
                    
                    <li>
                        <Link :href="route('grade')">
                        <i :class=" { 'lienActiver' : $page.component.startsWith('Grade/Gradee')}" class="far fa-circle nav-icon"></i>
                        <p :class=" { 'lienActiver' : $page.component.startsWith('Grade/Gradee')}"> Grade</p>
                    </Link>
                </li>
                    <li>
                        <Link :href="route('corps')">
                            <i :class=" { 'lienActiver' : $page.component.startsWith('Grade/Corps')}" class="far fa-circle nav-icon"></i>
                            <p :class=" { 'lienActiver' : $page.component.startsWith('Grade/Corps')}"> Corps</p>
                        </Link>
                        </li>
                </ul>
            </li>
            <li class="sub-btn btn1" :class=" { 'hovered' : $page.component.startsWith('Competence/')}">
                <a href="#">
                    <span class="icon">
                        <i class="fa fa-tag" aria-hidden="true"></i>
                    </span>
                    <span class="title"> Compétences</span>
                    <i class="fa fa-angle-right dropdown" aria-hidden="true"></i>
                </a>
                <ul class="sub-menu">
                    
                    <li>
                        <Link :href="route('experience')">
                        <i :class=" { 'lienActiver' : $page.component.startsWith('Competence/Experience')}" class="far fa-circle nav-icon"></i>
                        <p :class=" { 'lienActiver' : $page.component.startsWith('Competence/Experience')}"> Expérience</p>
                    </Link>
                </li>
                    <li>
                        <Link :href="route('formation')">
                            <i :class=" { 'lienActiver' : $page.component.startsWith('Competence/Formation')}" class="far fa-circle nav-icon"></i>
                            <p :class=" { 'lienActiver' : $page.component.startsWith('Competence/Formation')}"> Formations</p>
                        </Link>
                        </li>
                </ul>
            </li>
            <li :class=" { 'hovered' : $page.component.startsWith('Evaluation/')}">
                <Link :href="route('evaluation')">
                    <span class="icon">
                        <i class="fas fa-signal"></i>
                    </span>
                    <span class="title"> Evaluation</span>
                </Link>
            </li>
            <li :class=" { 'hovered' : $page.component.startsWith('Promotion/')}">
                <Link :href="route('promotion')">
                    <span class="icon">
                        <i class="fas fa-flask"></i>
                    </span>
                    <span class="title"> Promotions</span>
                </Link>
            </li>
            <li :class=" { 'hovered' : $page.component.startsWith('Opportunite/')}">
                <Link :href="route('opportunite')">
                    <span class="icon">
                        <i class="fas fa-strikethrough"></i>
                    </span>
                    <span class="title"> Opportunités</span>
                </Link>
            </li>
            <li :class=" { 'hovered' : $page.component.startsWith('Candidature/')}">
                <Link :href="route('candidat')">
                    <span class="icon">
                        <i class="fas fa-archive"></i>
                    </span>
                    <span class="title"> Candidatures</span>
                </Link>
            </li>
            <li>
                <Link href="/logout" method="post">
                    <span class="icon">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>
                    <span class="title"> Déconnexion</span>
                </Link>
            </li>
        </ul>


    </div>

 

</template>
<script setup>
//import Card from "../../Pages/Card.vue";
import { ref } from "vue";
import Card from "./Card.vue"

const showModal = ref(false);
const modalClosed = ()=>{
           showModal.value = false
       }
    
const openEditModal = ()=>{
           showModal.value = true
    
}
</script>