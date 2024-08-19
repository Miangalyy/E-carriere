<template>
    <div class="slidee-container">
        <div class="row filtreR">
            <div class="col-3">
                <div class="search" style="width: 300px;">
                    <label>
                        <input @keyup="recherche" v-model="searchService" type="text" placeholder="Search Here">
                        <i class="fa fa-search"></i>
                    </label>
                </div>
            </div>
            <div class="col-3 select-container3 secondo">
                <select @change="recherche" v-model="filtreService" class="select-box3">
                    <option value="">Filtrer par service</option>
                    <option :key="Service.id" :value="Service.id" v-for="Service in props.Services">{{ Service.titre }}</option>               
                </select>
                <div class="icon-container3 Isecondo">
                    <i class="fa-solid fa-caret-down"></i>
                </div>
            </div>
            <div class="col-3 select-container1">
                <select @change="recherche" v-model="filtreFonction" class="select-box1">
                    <option value="">Filtrer par direction</option>
                    <option :key="Fonction.id" :value="Fonction.id" v-for="Fonction in props.Fonctions">{{ Fonction.titre }}</option>        
                </select>
                <div class="icon-container1 Iprimo">
                    <i class="fa-solid fa-caret-down"></i>
                </div>
            </div>
            <div class="col-3 select-container2 secondo">
                <Link :href="route('employer.create')" class="btn btn-primary">Ajouter un nouveau</Link>
                <div class="icon-container2 Isecondo">
                    <i class="fa fa-plus"></i>
                </div>
            </div>
        </div>
        <div class="slidee-content">
            <div class="carde-wrapper">
                <div class="cardeee" :key="Employer.id" v-for="Employer in props.Employers.data">
                    <div class="imagee-content">
                        <span class="overlaye"></span>
                        <div class="carde-image">
                            <img :src="showPic(Employer)" alt="" class="card-img">
                        </div>
                    </div>
                    <div class="carde-content">
                        <h2 class="name">{{ Employer.nom }} {{ Employer.prenom }}
                        </h2>
                        <p class="description">{{ Employer.fonction.titre }} dans le service {{ Employer.service.titre }} sous le direction {{ Employer.service.direction.titre }}
                            </p>
                            <button @click="openEditModal(Employer.numero_employer)" class="bouttons">Voir plus</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-tools page">
            <Pagination
            :links="props.Employers.links"
            :prev="props.Employers.prev_page_url"
            :next="props.Employers.next_page_url"
            />
        </div>
       </div>
   <!---- <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                <div class="cardee swiper-slide" v-for="test in props.Directions">
                    <div class="iconBx">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="card-content">
                        <h2 class="name">{{ test.titre }}</h2>
                        <p class="description">Possede {{ test.employer_count }} employés
                            </p>
                    </div>
                </div>                         
            </div>
        </div>
        <i class=" arrow arrow-next"><img src="images/right.png" alt="" style="width:35px; height:35px ;border-radius:100%;"></i>
        <i class="arrow arrow-prev"><img src="images/left.png" alt="" style="width:35px; height:35px ;border-radius:100%;"></i>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next swiper-navBtn ml-4"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
       </div>
        <div class="detail">
            <div class="recentsOrder">
                <div class="carde">
                    <div class="cardHeader">
                        <h2 class="title ml-4">Liste des services</h2>
                        <div class="card-tools">
                            <Pagination
                            :links="props.Employers.links"
                            :prev="props.Employers.prev_page_url"
                            :next="props.Employers.next_page_url"
                            />
                        </div>
                    </div>
                    <div class="ext mt-4 mb-3">
                       <Link :href="route('employer.create')" class="btn btn-primary boutton ml-4">
                        <i class="fa fa-plus"> Ajouter</i>
                    </Link>
                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Numero_Employer</th>
                                    <th>Fonction</th>
                                    <th>Service</th>
                                    <th>Direction</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr :key="Employer.id" v-for="Employer in props.Employers.data">
                                        
                                   <td>
                                     <div class="justify-items-center" style="margin-top: -8px;">
                                         <img :src="showPic(Employer)" alt="" style="width: 45px; height: 45px; border-radius: 25px;">
                                     </div>          
                                   </td>
                                    <td>{{ Employer.nom }}</td>
                                    <td>{{ Employer.prenom }}</td>
                                    <td>{{ Employer.numero_employer }}</td>
                                    <td>{{ Employer.fonction.titre }}</td>
                                    <td>{{ Employer.service.titre }}</td>
                                    <td>{{ Employer.service.direction.titre }}</td>
                                    <td>
                                        <div class="justify-items-center" style="margin-top: -5px;">
                                            <Link :href="route('employer.edit', {numeroEmployer: Employer.numero_employer})" class="mr-2 status delivered"><i class="fas fa-pen"></i></Link>
                                            <button @click="openEditModal(Employer.numero_employer)" class="mr-2 status return"><i class="fas fa-eye"></i></button>
                                            <button @click="deleteConfirmation(Employer)" class="status pending"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        
        
            </div>
        
            <div class="recentCustomers">
                <div class="carde">
                    <div class="cardHeader">
                        <h2>Filtrer ici </h2>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                                <div class="search" style="width: 250px;">
                                    <label>
                                        <input @keyup="recherche" v-model="searchService" type="text" placeholder="Search Here">
                                        <i class="fa fa-search"></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="">Par Direction :</label>
                                        <select @change="recherche" v-model="filtreFonction" class="form-control">
                                            <option value=""></option>
                                            <option :key="Fonction.id" :value="Fonction.id" v-for="Fonction in props.Fonctions">{{ Fonction.titre }}</option>
                                            
                                        </select>
                                    </div>
                                </td>
        
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="">Par service :</label>
                                        <select @change="recherche" v-model="filtreService" class="form-control">
                                            <option value=""></option>
                                            <option :key="Service.id" :value="Service.id" v-for="Service in props.Services">{{ Service.titre }}</option>
                                            
                                        </select>
                                    </div>
                                </td>
        
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="">Nombre de page :</label>
                                        <select @change="recherche" v-model="per_page" class="form-control">
                                            <option selected disabled value="par page">Par page</option>
                                            <option value="5"></option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                </td>
        
                            </tr>
                        
                    </table>
                </div>
        
            </div>
            <Vue
            :direction-id="editingElementId"
            :show="showModal"
            @modal-closed="modalClosed"
            />
        </div>-->
        <Vue
        :direction-id="editingElementId"
        :show="showModal"
        @modal-closed="modalClosed"
        />
    </template>
    
    
    <script setup>
      import { Inertia } from '@inertiajs/inertia';
      import Pagination from "../../Shared/Pagination";
      import { ref } from "vue";
      import { useSwalConfirm, useSwalSuccess, useSwalError } from '../../Composables/alert';
      import EditService from "./Edit.vue"
      import Vue from "./Vue.vue"
      //import Card from "../../Layouts/Partials/Card.vue"
      import Card from "../Card.vue"

const showModale = ref(false);
const modalClosede = ()=>{
           showModal.value = false
       }
    
const openEditModale = ()=>{
    showModale.value = true
    
}
    
      const props = defineProps({
        Employers: Object,
        Directions: Array,
        Fonctions: Array,
        Services: Array,
        filtres: Object
      })
      const editingElementId = ref(0)
       const showModal = ref(false)
      const searchService = ref(props.filtres.search ?? "")
      const filtreService = ref(props.filtres.filterS ?? "")
      const filtreFonction = ref(props.filtres.filterF ?? "")
      const per_page = ref(props.filtres.per_page ?? 5)
    
      const modalClosed = ()=>{
          editingElementId.value = 0
           showModal.value = false
       }
    
      const openEditModal = (id)=>{
           editingElementId.value = id
           showModal.value = true
    
       }
       const deleteService = (id)=>{
        Inertia.delete(route("employer.delete", {numeroEmployer: id}), {
          onSuccess: (response)=>{
              useSwalSuccess("Service supprimé avec success .")
              closeModal()
          },
          onError: (error)=>{
             
              useSwalError(error.message ?? "Une erreur s'est produite :)")
          }
          });
       }
       const deleteConfirmation = (Service)=>{
          const message = `Vous etes sur le point de supprimer le service numero : "${Service.numero_employer}", voulez vous continuez ?`
          useSwalConfirm(message, ()=>{
             deleteService(Service.numero_employer)
          })
       }

 const showPic = (Employer)=>{
    if(Employer.photo){
      return 'storage/'+Employer.photo
    }
    return Employer.sexe == "M" ? "images/man.jpg" : "images/woman.jpg"
  }
    
      const recherche = _.throttle(function(){
        
    
        Inertia.get(route("employer", {search: searchService.value, filterF: filtreFonction.value, per_page: per_page.value, filterS: filtreService.value}), {}, {
          replace: true,
          preserveState: true
        })
      })
    </script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

  .slidee-container{
    width: 100%;
    padding: 20px 0;
    margin-top: -10px;
  }
  .filtreR{
    margin-left: 50px;
    margin-right: 85px;
  }
  .select-container1{

    display: flex;
    position: relative;
    
  }
  .select-container2{
    display: flex;
    position: relative;
    
  }
  .select-container2 .btn{
    font-size: 20px;
    width: 100%;
  }
  .select-container3{
    display: flex;
    position: relative;
    
  }
  .select-container1 .icon-container1{
    width: 50px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    right: 0;
    position: absolute;
    background-color: #e9b10a;
    
  }
  .select-container3 .icon-container3{
    width: 50px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    right: 0;
    position: absolute;
    background-color: #3a5308;

  }
  .select-container2 .icon-container2{
    width: 50px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    right: 0;
    position: absolute;
    background-color: rgb(51, 22, 238);

  }
  .icon-container1 i{
    font-size: 30px;
    color: #fff;
    font-weight: bold;
  }
  .icon-container2 i{
    font-size: 30px;
    color: #fff;
    font-weight: bold;
  }
  .icon-container3 i{
    font-size: 30px;
    color: #fff;
    font-weight: bold;
  }
  .select-box1{
    color: #fff;
    text-align: center;
    width: 100%;
    font-size: 20px;
    appearance: none;
    border: none;
    padding: 0 30px 0 15px;
    background: #f1c94e;
  }
  .select-box2{
    color: #fff;
    text-align: center;
    width: 100%;
    font-size: 20px;
    appearance: none;
    border: none;
    padding: 0 30px 0 15px;
    background: #6B8E23;
  }
  .select-box3{
    color: #fff;
    text-align: center;
    width: 100%;
    font-size: 20px;
    appearance: none;
    border: none;
    padding: 0 30px 0 15px;
    background: #6B8E23;
  }

  .carde-wrapper{
    position: relative;
    width: 100%;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    padding: 20px;
  }
  .cardeee{
    width: 320px;
    background: #f7f3f2;
    border-radius: 25px;
    margin-bottom: 30px;
  }
  .slidee-content{
    margin: 0 40px;
    border-radius: 25px;
  }
  .overlaye{
    position:absolute;
    top: 0;
    left: 0;
    background: var(--blue);
    height: 100%;
    width: 100%;
    border-radius: 25px 25px 0 25px;
  }
  .overlaye::before,
  .overlaye::after{
    content: '';
    border: none;
    position: absolute;
    width: 40px;
    height: 40px;
    right: 0;
    bottom: -40px;
    background: var(--blue);
  }
  .overlaye::after{
    border-radius: 0 25px 0 0;
    background: #f7f3f2;
  }
  .imagee-content{
    row-gap: 5px;
    position: relative;
  }
  .imagee-content,
  .carde-content{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 14px;
  }

  .carde-image{
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: #FFF;
    padding: 3px;
  }
  .carde-image .card-img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid var(--blue);
  }
  .name{
    text-align: center;
    font-size: 18px;
    font-weight: 500;
    color: #333;
    width: 250px;
    text-align-last: center;
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
    margin: 14px;
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
.page{
    position: absolute;
    bottom: 10px;
    left: 700px;
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