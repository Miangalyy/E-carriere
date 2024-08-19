<template>
    <div class="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="width:100%;">
            <div class="container-fluid">
                <img src="images/METFP.png" class="mr-2" alt="" style="width: 60px; height: 60px; border-radius: 50%;">
              <a class="navbar-brand" href="#" style="font-weight: 500;color:#fff;">Mon App</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link ml-4" aria-current="page" :href="route('accueil')">Accueil</a>
                  </li>
                  <li class="nav-item" id="connecter">
                    <a class="nav-link ml-4" href="#">Se connecter</a>
                  </li>
                  <li class="nav-item" id="inscrire">
                    <a class="nav-link ml-4" href="#">S'inscrire</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ml-4" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Plus
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled ml-4" href="#" tabindex="-1" aria-disabled="true">Desactiver</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </div> 
    <div class="containerr" id="container">
        <div class="form-container sign-up">
            <form @submit.prevent="soumettreInscrire">
             <!----   <div class="social-icons">
                    <a class="icon" href="#" style="color: #000;"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a class="icon" href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a class="icon" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a class="icon" href="#"><i class="fa-brands fa-github"></i></a>
                </div>-->
                <div class="upload">
                    <img src="images/noprofil2.png" width="100" height="100" id="image-preview">
                    <div class="round">
                        <input :key="inputKey" type="file" @input="previewtImage($event)">
                        <i class="fas fa-camera" style="color: #fff;"></i>
                    </div>
                </div>
                <div style="margin-top: -20px;" class="text-center">
                    <span>Vous devez renseigner tous les champs.</span>
                    <input type="text" placeholder="Numero" v-model="formInscrire.numero" :class="{'is-invalid': formInscrire.errors.numero}" required>
                    <span v-if="formInscrire.errors.numero" class="invalid-feedback error">{{ formInscrire.errors.numero }}</span>
                    <input type="text" placeholder="Name" v-model="formInscrire.name" :class="{'is-invalid': formInscrire.errors.name}" required>
                    <span v-if="formInscrire.errors.name" class="invalid-feedback error">{{ formInscrire.errors.name }}</span>
                    <input type="email" placeholder="E-mail" v-model="formInscrire.email" required>
                    <input type="password" placeholder="Password" v-model="formInscrire.password" :class="{'is-invalid': formInscrire.errors.password}" required>
                    <span v-if="formInscrire.errors.password" class="invalid-feedback error">{{ formInscrire.errors.password }}</span>
                    <button type="submit">Sign Up</button>
                </div>
            </form>
        </div>
        <div class="form-container sign-in">
            <form @submit.prevent="soumettre">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a class="icon" href="#" style="color: #000;"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a class="icon" href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a class="icon" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a class="icon" href="#"><i class="fa-brands fa-github"></i></a>
                </div>
                <span>Ou utilisez votre mot de passe de messagerie</span>
                <input type="email" placeholder="E-mail" v-model="form.email" :class="{'is-invalid': form.errors.email}" required>
                <span v-if="form.errors.email" class="invalid-feedback error">{{ form.errors.email }}</span>
                <input type="password" placeholder="Password" v-model="form.password" :class="{'is-invalid': form.errors.password}" required>
                <span v-if="form.errors.password" class="invalid-feedback error">{{ form.errors.password }}</span>
                <a href="#">Mot de passe oublier?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome back!</h1>
                    <p>Inscrivez-vous avec vos informations personnelles pour utiliser toutes les fonctionnalités du site</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Inscrivez-vous avec vos informations personnelles pour utiliser toutes les fonctionnalités du site</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { useSwalError, useSwalSuccess } from '../Composables/alert';
import { ref } from 'vue';
    
const inputKey = ref(0);
 const form = useForm({
    email: "",
    password: "",

 })
 const formInscrire = useForm({
    name: "",
    email: "",
    password: "",
    numero: "",
    photo: "",
 })

 const soumettre = ()=>{
    form.post(route("login.post"), {
        onSuccess: (page)=> {

        },
        onError: (errors)=>{
            useSwalError("Une erreur s'est produite, veuillez ressayez plus tard!")
        }
    })
 }

 const soumettreInscrire = ()=>{
    formInscrire.post(route("login.create"), {
        onSuccess: (page)=>{
                useSwalSuccess(page.message ?? "Utilisateur ajouté avec succes ")
                formInscrire.reset()
                inputKey.value += 1
                //document.getElementById("image-preview").style.display = "none"
                var previewImagee = document.getElementById("image-preview")
                previewImagee.src = "images/noprofil2.png"
    
            },
        onError: (errors)=>{
            useSwalError(errors.message ?? "Une erreur s'est produite :)")
        }
    })
 }

 const previewtImage = (event)=>{
     if(event.target.files.length>0){
         formInscrire.photo = event.target.files[0]
         var src = URL.createObjectURL(event.target.files[0])
         var previewImagee = document.getElementById("image-preview")
         previewImagee.src = src
         previewImagee.style.display = "block"
     }
}
</script>
<script>
import AuthLayout from "../Layouts/AuthLayout.vue";
 export default{
    layout: AuthLayout
 }
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body{
    background-color: #c9d6ff;
    background: linear-gradient(to right, #e2e2e2, #c9d6ff);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}
#nav-bar{
    position: sticky;
    top: 0;
    z-index: 10;
    width: 100%;
}
.navbar{
    background-image: linear-gradient(to right, #5c6bc0, #512da8);
    padding: 0 !important;
    width: 100%;
}
.navbar-nav li{
    padding: 0 10px;
}
.navbar-nav li a{
    color: #fff !important;
    font-weight: 600;
}
.fa-align-justify{
    color: #fff;
    font-size: 30px !important;
}
.containerr{
    background: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 1000px;
    height: 600px;
    max-width: 100%;
    max-height: 1500px;
}
.containerr p{
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}
.containerr span{
    font-size: 12px;
}
.containerr a{
    font-size: 13px;
    color: #333;
    text-decoration: none;
    margin: 15px 0 10px ;
}
.containerr button{
    background: #512da8;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    letter-spacing: 0.5px;
    font-weight: 600;
    text-transform: uppercase;
    margin: 10px;
    cursor: pointer;
}
.containerr button.hidden{
    background: transparent;
    border-color: #fff;
}
.containerr form{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #fff;
    padding: 0 40px;
    height: 100%;
}
.containerr input{
    background: #eee;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
    border: none;
}

.form-container{
 position: absolute;
 top: 0;
 height: 100%;
 transition: all 0.6s ease-in-out;
}
.sign-in{
    left: 0;
    width: 50%;
    z-index: 2;
}
.containerr.activer .sign-in{
    transform: translateX(100%);
}
.sign-up{
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}
.containerr.activer .sign-up{
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}
@keyframes move{
    0%, 49.99%{
        opacity: 0;
        z-index: 1;
        
    }
    50%, 100%{
        opacity: 1;
        z-index: 5;
    }
}
.social-icons{
    margin: 20px 0;
}
.social-icons a{
    border: 1px solid #ccc;
    border-radius: 20%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;

}
.toggle-container{
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}
.containerr.activer .toggle-container{
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;

}
.toggle{
    background: #512da8;
    height: 100%;
    background: linear-gradient(to right, #5c6bc0, #512da8);
    color: #fff;
    position: relative;
    left: -100%;
    width: 200%;
    height: 100%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}
.containerr.activer .toggle{
    transform: translateX(50%);
}
.toggle-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    top: 0;
    text-align: center;
    transform: translateX(0);
    padding: 0 30px;
    transition: all 0.6s ease-in-out;
}
.toggle-left{
    transform: translateX(-200%);
}
.toggle-right{
    right: 0;
    transform: translateX(0);
}
.containerr.activer .toggle-left{
    transform: translateX(0);
}
.containerr.activer .toggle-right{
    transform: translateX(200%);
}

.upload{
    position: relative;
    width: 100px;
    margin: 50px;
}
.upload img{
    border-radius: 50%;
    border: 6px solid #eaeaea;
}
.upload .round{
    position: absolute;
    bottom: 0;
    right: 0;
    background: #512da8;
    width: 32px;
    height: 32px;
    line-height: 33px;
    text-align: center;
    border-radius: 50%;
    overflow: hidden;
}

.upload .round input[type='file']{
    position: absolute;
    transform: scale(2);
    opacity: 0;
}
input[type=file]::-webkit-file-upload-button{
    cursor: pointer;
}

.nav-bar{
    position: absolute;
    display: flex;
    width: 2100px;
    top: 0;
    left: 0;
    align-items: center;
    margin-left: 0px;
    justify-content: space-between;
}
#search{
  position: absolute;
  right: 320px;
}
</style>
