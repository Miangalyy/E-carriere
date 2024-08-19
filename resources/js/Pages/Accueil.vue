<template>
    <section class="nav-bar" id="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="images/METFP.png" class="mr-2" alt="" style="width: 60px; height: 60px; border-radius: 50%;">
              <a class="navbar-brand" href="#" style="font-weight: 500; color: #fff;">Mon App</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-align-justify" aria-hidden="true"></i>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link ml-4" aria-current="page" href="#banner">Accueil</a>
                  </li>
                  <li class="nav-item" id="connecter">
                    <a class="nav-link ml-4" href="#services">Liste opportunité</a>
                  </li>
                  <li class="nav-item" id="inscrire">
                    <a class="nav-link ml-4" href="/login">Se connecter</a>
                  </li>
                  <li class="nav-item" id="inscrire">
                    <a class="nav-link ml-4" href="#about-us">Aide</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link ml-4" href="#footer">
                      Contact
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link ml-4">Desactiver</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </section> 
        <section id="banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="promo-title">BEST PLATFORMS</p>
                        <p>La gestion de carrières concourt donc à maintenir la productivité et la compétitivité de l’entreprise, de l’accompagner dans 
                            son développement et de grandir avec ses salariés.
                        </p>
                        <a href="#services" class="play-btn"><img src="images/play.png" alt=""> Liste des opportunités</a>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="images/home2.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <img src="images/wave1.png" alt="" class="bottom-img">
        </section>
        <section id="services" class="text-center">
            <h1 class="title mb-10" style="margin-top: -30px;">La liste des opportunités</h1>
            <div class="slide-container swiper">
                <div class="slide-content accueil">   
                    <div class="card-wrapper swiper-wrapper">
                        <div class="cardee swiper-slide" :key="test.id" v-for="test in props.opportunite">
                            <div class="card-content text-center">
                                <h2 class="name">{{ test.titre }}</h2>
                                <p class="description">C'est une poste {{ test.description }}</p>
                                <p class="description">Les compétences requis sont : {{ test.competence }}</p>
                                <p class="description">La date limite fin de candidature est en {{ test.date }}</p>
                                <button @click="openEditModal(test.id)" class="bouttons">Postuler</button>
                            </div>
                        </div>   
                        <div class="cardee swiper-slide">
                            <div class="card-content text-center">
                                <h2 class="name">Mon titre</h2>
                                <p class="description">C'est une poste ma description</p>
                                <p class="description">Les compétences requis sont :  mes compétences</p>
                                <p class="description">La date limite fin de candidature est en 2018</p>
                                <button class="bouttons">Postuler</button>
                            </div>
                        </div>                                                               
                    </div>
                </div>
                <div class="swiper-button-next swiper-navBtn ml-4"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-pagination"></div>
               </div>
            <!--<div class="container text-center">
                <h1 class="title">WHAT I DO ?</h1>
                <div class="row text-center">
                    <div class="col-md-4 services">
                        <img src="images/service1.png" alt="" class="service-img">
                        <h4>Growth Marketing</h4>
                        <p>Suscribe esy tutorial youtube to watch more videos on website development, 
                            Digital Marketing, Wordpress and graphics designing.
                        </p>
                    </div>
                    <div class="col-md-4 services">
                        <img src="images/service2.png" alt="" class="service-img">
                        <h4>Online Branding</h4>
                        <p>Suscribe esy tutorial youtube to watch more videos on website development, 
                            Digital Marketing, Wordpress and graphics designing.
                        </p>
                    </div>
                    <div class="col-md-4 services">
                        <img src="images/service3.png" alt="" class="service-img">
                        <h4>Animated Adds</h4>
                        <p>Suscribe esy tutorial youtube to watch more videos on website development, 
                            Digital Marketing, Wordpress and graphics designing.
                        </p>
                    </div>
                    
                </div>
                <button class="btn btn-primary">View All</button>
            </div>-->
        </section>
        <section id="about-us">
            <div class="container">
                <h1 class="title text-center">AIDE </h1>
                <div class="row">
                    <div class="col-md-6 about-us">
                        <p class="about-title">Les étapes a suivre</p>
                        <ul>
                            <li>Cliquez liste des opportunités pour les voirs.</li>
                            <li>Cliquez sur postuler pour s'inscrire au concours.</li>
                            <li>Cliquez sur se connecter, si vous etes admin.</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="images/network.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        <section id="social-media">
            <div class="container text-center">
                <h1>FIND US ON SOCIAL MEDIA</h1>
                <div class="social-icons">
                    <a href="#"><img src="images/facebook-icon.png" alt=""></a>
                    <a href="#"><img src="images/instagram-icon.png" alt=""></a>
                    <a href="#"><img src="images/twitter-icon.png" alt=""></a>
                    <a href="#"><img src="images/linkedin-icon.png" alt=""></a>
                    <a href="#"><img src="images/whatsapp-icon.png" alt=""></a>
                </div>
            </div>
        </section>
        <section id="footer">
            <img src="images/wave2.png" alt="" class="footer-img">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-box">
                        <img src="images/METFP.png" alt="" style="width: 60px; height: 60px; border-radius: 25px;">
                        <p>La gestion de carrières concourt donc à maintenir la productivité et la compétitivité de l’entreprise, de l’accompagner dans son développement 
                            et de grandir avec ses salariés.
                        </p>
                    </div>
                    <div class="col-md-4 footer-box">
                        <p><b>CONTACT US</b></p>
                        <p><i class="fa-solid fa-location-dot"></i> Complexe scolaire Ampefiloha</p>
                        <p><i class="fa-solid fa-envelope"></i> miantsoramiara2452@gmail.com</p>
                        <p><i class="fa-solid fa-phone"></i> 034 10 094 47</p>
                    </div>
                    <div class="col-md-4 footer-box">
                        <p><b>CONTACT US</b></p>
                        <input type="email" class="form-control" placeholder="Your email">
                        <button class="btn btn-primary">Suscribe</button>
                    </div>
                </div>
                <hr>
                <p class="copyright">Site de METFP</p>
            </div>
        </section>
        <EditDirection
        :direction-id="editingElementId"
        :show="showModal"
        @modal-closed="modalClosed"
        />
</template>
<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref } from "vue";
import { useSwalConfirm, useSwalSuccess, useSwalError } from '../Composables/alert';
import EditDirection from "./Post.vue"


const editingElementId = ref(0)
 const showModal = ref(false)

 const modalClosed = ()=>{
    editingElementId.value = 0
     showModal.value = false
 }

const openEditModal = (id)=>{
     editingElementId.value = id
     showModal.value = true

 }
const props = defineProps({
  opportunite: Array,
})
</script>
<script>
import AuthLayout from "../Layouts/AuthLayout.vue";
 export default{
    layout: AuthLayout
 }

</script>
<style>

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

#banner{
    background-image: linear-gradient(to right, #5c6bc0, #512da8);
    color: #fff;
    padding-top: 5%;
}
.promo-title{
    font-size: 40px;
    font-weight: 600;
    margin-top: 100px;
}
.play-btn img{
    margin: 20px;
    width: 45px;
    border-radius: 50%;
}
#banner a{
    text-decoration: none;
    color: #fff;
}
.bottom-img{
    width: 100%;
}

#services{
    padding: 80px 0;
}
.service-img{
    width: 100px;
    margin-top: 25px;
}
.services{
    padding: 20px;
}
.services h4{
    padding: 5px;
    margin-top: 25px;
    text-transform: uppercase;
}

.title::before{
    content: '';
    margin-left: auto;
    margin-right: auto;
    display: block;
    background:  #512da8;
    height: 5px;
    width: 500px;
    transform: translateY(63px);
}
.title::after{
    content: '';
    margin-left: auto;
    margin-right: auto;
    display: block;
    background: #512da8;
    height: 10px;
    width: 50px;
    transform: translateY(8px);
}

#services .btn-primary{
    box-shadow: none;
    padding: 8px 25px;
    border: none;
    border-radius: 20px;
    background-image: linear-gradient(to right, #5c6bc0, #512da8);

}

#about-us{
    padding-bottom: 20px;
    padding-top: 20px;
    background: #f8f9fa;
}
.about-title{
    font-size: 40px;
    font-weight: 600;
    margin-top: 8%;
}
#about-us ul li{
    margin: 10px 0px;
}
#about-us ul{
    margin-left: 20px;
}


#social-media{
    background: #f8f9fa;
    padding: 100px 0;
}
#social-media p{
    font-size: 36px;
    font-weight: 600;
    margin-bottom: 30px;
}

.social-icons img{
    width: 60px;
    transition: all 0.5s ease-in-out;
}
.social-icons a:hover img{
    transform: translateY(-10px);
}

#footer{
    background-image: linear-gradient(to right, #5c6bc0, #512da8);
    color: #fff;
}
#footer img{
    width: 100%;
}
.footer-box{
    padding: 20px;
}
.footer-box img{
    width: 30px;
    height: 60px;
    border-radius: 50%;
    margin-bottom: 20px;
}
.footer-box .fa-solid{
    margin-right: 8px;
    font-size: 25px;
    width: 40px;
    height: 40px;
    padding-top: 7px;
    text-align: center;
    border-radius: 2px;
    background-image: linear-gradient(to right, #5c6bc0, #512da8);
}
.footer-box .form-control{
    border: none;
    box-shadow: none;
    margin-top: 25px;
    border-radius: 0;
    max-width: 250px;

}
.footer-box .btn-primary{
    border: none !important;
    box-shadow: none;
    margin-top: 30px;
    background-image: linear-gradient(to right, #5c6bc0, #512da8);
}
hr{
    background: #fff;
}
.copyright{
    margin-bottom: 0;
    padding-bottom: 20px;
    text-align: center;
}




.slide-container{
  max-width: 2000px;
  width: 100%;
  padding: 40px 0;
}
.cardee{
  height: 300px;
  background: #f8f9fa;
  border-radius: 25px;
  margin-right: 100px;
}
.card-wrapper{
    width: 100%;
}
.slide-content{  
  margin: 0 40px;
  border-radius: 25px;
  overflow: hidden;
}
.overlay{
  position:absolute;
  top: 0;
  left: 0;
  background: #4070F4;
  height: 100%;
  width: 100%;
  border-radius: 25px 25px 0 25px;
}
.overlay::before,
.overlay::after{
  content: '';
  border: none;
  position: absolute;
  width: 40px;
  height: 40px;
  right: 0;
  bottom: -40px;
  background: #4070F4;
}
.overlay::after{
  border-radius: 0 25px 0 0;
  background: #fff;
}
.image-content{
  row-gap: 5px;
  position: relative;
}
.image-content,
.card-content{
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 10px 14px;
}
.card-image{
  position: relative;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  background: #FFF;
  padding: 3px;
}
.card-image .card-img{
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  border: 4px solid #4070F4;
}
.name{
  font-size: 18px;
  font-weight: 500;
  color: #333;
}
.description{
  font-size: 14px;
  color: #707070;
  text-align: center;
}
.bouttons{
  border: none;
  background: #4070F4;
  color: #FFF;
  font-size: 16px;
  padding: 8px 16px;
  cursor: pointer;
  transition: all 0.3s ease;
  border-radius: 6px;
}
.bouttons:hover{
  background: #265df2;
}
.swiper-navBtn{
  color: #6e93f7;
  transition: color 0.3s ease;
}
.swiper-navBtn:hover{
  color: #4070f4;
}
.swiper-navBtn::before,
.swiper-navBtn::after{
  font-size: 40px;
}
.swiper-button-next{
  right: 0;
}
.swiper-button-prev{
  left: 0;
}
.swiper-pagination-bullet{
  background: #6e93f7;
  opacity: 1;
}
.swiper-pagination-bullet-active{
  background: var(--blue);
}

@media screen and (max-width: 768px){
  .slide-content{
      margin: 0 10px;
  }
  .swiper-navBtn{
      display: none;
  }
}
</style>